<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expenses\StoreExpensesRequest;
use App\Http\Requests\Expenses\UpdateExpensesRequest;
use App\Http\Requests\ExpensesType\StoreExpensesTypeRequest;
use App\Models\Expenses;
use App\Models\ExpensesType;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Expenses::all();
        return view('admin.pages.expenses.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allTrip = Trip::where('trip_status', '!=', 3)->orderBy('created_at', 'desc')->get();
        $allVehicles = Vehicle::all();
        $allExpensesType = ExpensesType::all();
        return view('admin.pages.expenses.create')->with('allTrip', $allTrip)->with('allExpensesType', $allExpensesType)->with('allVehicles', $allVehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expenseCategoryRules = $this->expenseCategoryRules();
        $validator = $this->checkValidity($request, $expenseCategoryRules);
        if ($request->expense_category == 'general') {
            $vehicleSelectRules = $this->vehicleSelectRules();
            $validator = $this->checkValidity($request, $vehicleSelectRules);

            $expenseTypeAmountDateRules = $this->expenseTypeAmountDateRules();
            $validator = Validator::make($request->all(), $expenseTypeAmountDateRules);
            $validator->setAttributeNames($this->expenseTypeAmountDateAttribues());
            $validator->validate();

            $saveGeneralExp = $this->saveGeneralExpense($request);
            if ($saveGeneralExp) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        } else if ($request->expense_category == 'trip') {
            $tripSelectRules = $this->tripSelectRules();
            $validator = $this->checkValidity($request, $tripSelectRules);

            $expenseTypeAmountDateRules = $this->expenseTypeAmountDateRules();
            $validator = Validator::make($request->all(), $expenseTypeAmountDateRules);
            $validator->setAttributeNames($this->expenseTypeAmountDateAttribues());
            $validator->validate();

            $saveTripExp = $this->saveTripExpense($request);
            if ($saveTripExp) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        } else {
            return response()->json(['status' => 400]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expenses::findOrFail($id);
        $expenseItems = DB::table('expenses_items')->where('expense_id', $expense->expense_id)->get();
        $allExpenseTypes = array_column(ExpensesType::all()->toArray(), 'expense_type_name', 'expense_type_id');
        // dd($allExpenseTypes);
        return view('admin.pages.expenses.show')
            ->with('expense', $expense)
            ->with('expenseItems', $expenseItems)
            ->with('allExpenseTypes', $allExpenseTypes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenses = Expenses::findOrFail($id);
        $allTrip = Trip::where('trip_status', '!=', 3)->orderBy('created_at', 'desc')->get();
        $allExpensesType = ExpensesType::all();
        $expensesItems = DB::table('expenses_items')->where('expense_id', $id)->get();
        $allVehicles = Vehicle::all();
        return view('admin.pages.expenses.edit')
            ->with('expenses', $expenses)
            ->with('allTrip', $allTrip)
            ->with('allExpensesType', $allExpensesType)
            ->with('expensesItems', $expensesItems)
            ->with('allVehicles', $allVehicles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $expenseCategoryRules = $this->expenseCategoryRules();
        $validator = $this->checkValidity($request, $expenseCategoryRules);

        if ($request->expense_category == 'general') {
            $vehicleSelectRules = $this->vehicleSelectRules();
            $validator = $this->checkValidity($request, $vehicleSelectRules);

            $expenseTypeAmountDateRules = $this->expenseTypeAmountDateRules();
            $validator = Validator::make($request->all(), $expenseTypeAmountDateRules);
            $validator->setAttributeNames($this->expenseTypeAmountDateAttribues());
            $validator->validate();

            $updateGeneralExp = $this->updateGeneralExpense($request);
            if ($updateGeneralExp) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        } else if ($request->expense_category == 'trip') {
            $tripSelectRules = $this->tripSelectRules();
            $validator = $this->checkValidity($request, $tripSelectRules);

            $expenseTypeAmountDateRules = $this->expenseTypeAmountDateRules();
            $validator = Validator::make($request->all(), $expenseTypeAmountDateRules);
            $validator->setAttributeNames($this->expenseTypeAmountDateAttribues());
            $validator->validate();

            $updateTripExp = $this->updateTripExpense($request);
            if ($updateTripExp) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        } else {
            return response()->json(['status' => 400]);
        }

        // Changed from here
        if (count($request->expense_type_id) == count($request->expense_amount) && count($request->expense_amount) == count($request->expense_date)) {
            $updateExpense = Expenses::where('expense_id', $request->expense_id)
                ->update([
                    'trip_id'               => $request->trip_id,
                    'expense_description'   => $request->expense_description,
                    'expense_added_by'      => Auth::user()->id
                ]);
            DB::table('expenses_items')->where('expense_id', $request->expense_id)->delete();
            $totalExpenses = null;
            for ($i = 0; $i < count($request->expense_type_id); $i++) {
                DB::table('expenses_items')->insert([
                    'expense_id'        => $request->expense_id,
                    'expense_type_id'   => $request->expense_type_id[$i],
                    'expense_amount'    => $request->expense_amount[$i],
                    'expense_date'      => date('Y-m-d', strtotime($request->expense_date[$i]))
                ]);
                $totalExpenses += $request->expense_amount[$i];
            }
            $updateExpense =  Expenses::where('expense_id', $request->expense_id)->update(['total_expense_amount' => $totalExpenses]);
            if ($updateExpense) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);
            }
        } else {
            return response()->json(['status' => 400]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }

    public function destroyAllExpenses(Request $request)
    {
        if (Expenses::where('expense_id', $request->expensesId)->delete()) {
            return response(['result' => true]);
        }
    }

    public function expenseCategoryRules()
    {
        $rules['expense_category']      = 'required|in:general,trip';
        $rules['expense_description']   = 'required|string';
        return $rules;
    }

    public function tripSelectRules()
    {
        $rules['trip_id']  = 'required|numeric|gt:0';
        return $rules;
    }

    public function expenseTypeAmountDateRules()
    {
        $rules['expense_type_id.*'] = 'required|numeric';
        $rules['expense_amount.*']  = 'required|numeric|min:0';
        $rules['expense_date.*']    = 'required|date_format:Y-m-d';
        return $rules;
    }

    public function expenseTypeAmountDateAttribues()
    {
        $attributeNames['expense_type_id.*']   = 'Expense Type';
        $attributeNames['expense_amount.*']    = 'Expense Amount';
        $attributeNames['expense_date.*']      = 'Expense Date';
        return $attributeNames;
    }

    public function vehicleSelectRules()
    {
        $rules['vehicle_id'] = 'required|numeric|gt:0';
        return $rules;
    }

    public function setErrorMessage()
    {
        $message = [
            'expense_category.required'     => 'Please Select Expenses Category',
            'expense_category.in'           => 'Please Select Proper Expenses Category',
            'trip_id.required'              => 'Trip Select is Required',
            'trip_id.numeric'               => 'Provide Valid Trip',
            'trip_id.gt'                    => 'Please Provide Valid Trip',
            'expense_type_id.required.*'    => 'Expenses Type is Required',
            'expense_type_id.numeric.*'     => 'Provide Valid Expenses Type',
            'expense_amount.required.*'     => 'Expenses Amount is Required',
            'expense_amount.numeric.*'      => 'Expenses Amount is Numeric',
            'expense_amount.min.*'          => 'Provide Valid Expenses Amount',
            'expense_date.required.*'       => 'Expenses Date is Required',
            'expense_date.date_format.*'    => 'Provide Valid Expenses Date',
            'expense_description.required'  => 'Expenses Description is Required',
            'expense_description.string'    => 'Provide Valid Expenses Description',
            'vehicle_id.required'           => 'Vehicle Select is Required',
            'vehicle_id.numeric'            => 'Please Provide Proper Vehicle',
            'vehicle_id.gt'                 => 'Please Provide Proper Vehicle',
        ];
        return $message;
    }

    public function checkValidity($request, $rules)
    {
        $validator = Validator::make($request->all(), $rules, $this->setErrorMessage());
        $validator->validate();
    }

    public function findVehicleId($tripId)
    {
        $tripInfo = Trip::select('vehicle_id')->where('trip_id', $tripId)->first();
        return $tripInfo->vehicle_id;
    }

    public function saveGeneralExpense($request)
    {
        if (count($request->expense_type_id) == count($request->expense_amount) && count($request->expense_amount) == count($request->expense_date)) {
            $saveExpenses = Expenses::create([
                'trip_id'               => null,
                'expense_category'      => 'general',
                'expense_description'   => $request->expense_description,
                'vehicle_id'            => $request->vehicle_id,
                'expense_added_by'      => Auth::user()->id
            ]);
            $expense_id = $saveExpenses->expense_id;
            $totalExpenses = null;
            for ($i = 0; $i < count($request->expense_type_id); $i++) {
                DB::table('expenses_items')->insert([
                    'expense_id'        => $expense_id,
                    'expense_type_id'   => $request->expense_type_id[$i],
                    'expense_amount'    => $request->expense_amount[$i],
                    'expense_date'      => date('Y-m-d', strtotime($request->expense_date[$i]))
                ]);
                $totalExpenses += $request->expense_amount[$i];
            }
            $saveInfo =  Expenses::where('expense_id', $expense_id)->update(['total_expense_amount' => $totalExpenses]);
            if ($saveInfo) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function saveTripExpense($request)
    {
        $vehicleId = $this->findVehicleId($request->trip_id);
        if (count($request->expense_type_id) == count($request->expense_amount) && count($request->expense_amount) == count($request->expense_date)) {
            $saveExpenses = Expenses::create([
                'trip_id'               => $request->trip_id,
                'expense_category'      => 'trip',
                'expense_description'   => $request->expense_description,
                'vehicle_id'            => $vehicleId,
                'expense_added_by'      => Auth::user()->id
            ]);
            $expense_id = $saveExpenses->expense_id;
            $totalExpenses = null;
            for ($i = 0; $i < count($request->expense_type_id); $i++) {
                DB::table('expenses_items')->insert([
                    'expense_id'        => $expense_id,
                    'expense_type_id'   => $request->expense_type_id[$i],
                    'expense_amount'    => $request->expense_amount[$i],
                    'expense_date'      => date('Y-m-d', strtotime($request->expense_date[$i]))
                ]);
                $totalExpenses += $request->expense_amount[$i];
            }
            $saveInfo =  Expenses::where('expense_id', $expense_id)->update(['total_expense_amount' => $totalExpenses]);
            if ($saveInfo) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateGeneralExpense($request)
    {
        if (count($request->expense_type_id) == count($request->expense_amount) && count($request->expense_amount) == count($request->expense_date)) {
            $updateExpense = Expenses::where('expense_id', $request->expense_id)
                ->update([
                    'trip_id'               => null,
                    'expense_category'      => 'general',
                    'expense_description'   => $request->expense_description,
                    'vehicle_id'            => $request->vehicle_id,
                    'expense_added_by'      => Auth::user()->id
                ]);
            DB::table('expenses_items')->where('expense_id', $request->expense_id)->delete();
            $totalExpenses = null;
            for ($i = 0; $i < count($request->expense_type_id); $i++) {
                DB::table('expenses_items')->insert([
                    'expense_id'        => $request->expense_id,
                    'expense_type_id'   => $request->expense_type_id[$i],
                    'expense_amount'    => $request->expense_amount[$i],
                    'expense_date'      => date('Y-m-d', strtotime($request->expense_date[$i]))
                ]);
                $totalExpenses += $request->expense_amount[$i];
            }
            $updateExpense =  Expenses::where('expense_id', $request->expense_id)->update(['total_expense_amount' => $totalExpenses]);
            if ($updateExpense) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateTripExpense($request)
    {
        $vehicleId = $this->findVehicleId($request->trip_id);
        if (count($request->expense_type_id) == count($request->expense_amount) && count($request->expense_amount) == count($request->expense_date)) {
            $updateExpense = Expenses::where('expense_id', $request->expense_id)
                ->update([
                    'trip_id'               => $request->trip_id,
                    'expense_category'      => 'trip',
                    'expense_description'   => $request->expense_description,
                    'vehicle_id'            => $vehicleId,
                    'expense_added_by'      => Auth::user()->id
                ]);
            DB::table('expenses_items')->where('expense_id', $request->expense_id)->delete();
            $totalExpenses = null;
            for ($i = 0; $i < count($request->expense_type_id); $i++) {
                DB::table('expenses_items')->insert([
                    'expense_id'        => $request->expense_id,
                    'expense_type_id'   => $request->expense_type_id[$i],
                    'expense_amount'    => $request->expense_amount[$i],
                    'expense_date'      => date('Y-m-d', strtotime($request->expense_date[$i]))
                ]);
                $totalExpenses += $request->expense_amount[$i];
            }
            $updateExpense =  Expenses::where('expense_id', $request->expense_id)->update(['total_expense_amount' => $totalExpenses]);
            if ($updateExpense) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
