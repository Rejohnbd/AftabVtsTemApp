<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expenses\StoreExpensesRequest;
use App\Http\Requests\Expenses\UpdateExpensesRequest;
use App\Models\Expenses;
use App\Models\ExpensesType;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $allTrip = Trip::all();
        $allExpensesType = ExpensesType::all();
        return view('admin.pages.expenses.create')->with('allTrip', $allTrip)->with('allExpensesType', $allExpensesType);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesRequest $request)
    {
        if (count($request->expense_type_id) == count($request->expense_amount) && count($request->expense_amount) == count($request->expense_date)) {
            $saveExpenses = Expenses::create([
                'trip_id'               => $request->trip_id,
                'expense_description'   => $request->expense_description,
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
    public function show(Expenses $expenses)
    {
        //
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
        $allTrip = Trip::all();
        $allExpensesType = ExpensesType::all();
        $expensesItems = DB::table('expenses_items')->where('expense_id', $id)->get();
        return view('admin.pages.expenses.edit')->with('expenses', $expenses)->with('allTrip', $allTrip)->with('allExpensesType', $allExpensesType)->with('expensesItems', $expensesItems);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request)
    {
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
}
