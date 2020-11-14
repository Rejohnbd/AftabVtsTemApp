<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\ExpensesType;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class DriverExpensesController extends Controller
{
    public function validationRules()
    {
        $rules['expense_type_id']       = 'required|numeric';
        $rules['trip_id']               = 'required|numeric';
        $rules['expense_amount']        = 'required|numeric|min:0';
        $rules['expense_date']          = 'required|date_format:m/d/Y';
        $rules['expense_description']   = 'required|string';
        return $rules;
    }

    public function validationAttributes()
    {
        $attributeNames['expense_type_id.required']      = 'Expenses Type is Required';
        $attributeNames['expense_type_id.numeric']       = 'Provide Valid Expenses Type';
        $attributeNames['trip_id.required']              = 'Trip Select is Required';
        $attributeNames['trip_id.numeric']               = 'Provide Valid Trip';
        $attributeNames['expense_amount.required']       = 'Expenses Amount is Required';
        $attributeNames['expense_amount.numeric']        = 'Expenses Amount is Numeric';
        $attributeNames['expense_amount.min']            = 'Provide Valid Expenses Amount';
        $attributeNames['expense_date.required']         = 'Expenses Date is Required';
        $attributeNames['expense_date.date_format']      = 'Provide Valid Expenses Date';
        $attributeNames['expense_description.required']  = 'Expenses Description is Required';
        $attributeNames['expense_description.string']    = 'Provide Valid Expenses Description';
        return $attributeNames;
    }

    public function index()
    {
        $datas = Expenses::where('expense_added_by', Auth::user()->id)->get();
        return view('driver.pages.expenses.index', compact('datas'));
    }

    public function create()
    {
        $allTrip = Trip::where('driver_user_id', Auth::user()->id)->where('trip_status', '!=', 3)->get();
        $allExpensesType = ExpensesType::all();
        return view('driver.pages.expenses.create')->with('allExpensesType', $allExpensesType)->with('allTrip', $allTrip);
    }

    public function store(Request $request)
    {
        $attributeNames = $this->validationAttributes();
        $rules = $this->validationRules();

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $newExpenses = new Expenses;
        $newExpenses->expense_type_id       = $request->expense_type_id;
        $newExpenses->trip_id               = $request->trip_id;
        $newExpenses->expense_amount        = $request->expense_amount;
        $newExpenses->expense_date          = date('Y-m-d', strtotime($request->expense_date));
        $newExpenses->expense_description   = $request->expense_description;
        $newExpenses->expense_added_by      = Auth::user()->id;
        $saveNewExpenses = $newExpenses->save();

        if ($saveNewExpenses) {
            session()->flash('success', 'Expenses Added Successfully');
            return redirect()->route('driver-expenses');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('driver-expenses');
        }
    }

    public function edit($id)
    {
        $expenses = Expenses::findOrFail($id);
        $allTrip = Trip::where('driver_user_id', Auth::user()->id)->where('trip_status', '!=', 3)->get();
        $allExpensesType = ExpensesType::all();
        return view('driver.pages.expenses.edit')->with('expenses', $expenses)->with('allTrip', $allTrip)->with('allExpensesType', $allExpensesType);
    }

    public function update(Request $request)
    {
        $attributeNames = $this->validationAttributes();
        $rules = $this->validationRules();

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $updateExpense = Expenses::where('expense_id', $request->expense_id)
            ->update([
                'expense_type_id'       => $request->expense_type_id,
                'trip_id'               => $request->trip_id,
                'expense_amount'        => $request->expense_amount,
                'expense_date'          => date('Y-m-d', strtotime($request->expense_date)),
                'expense_description'   => $request->expense_description,
                'expense_added_by'      => Auth::user()->id
            ]);

        if ($updateExpense == 1) {
            session()->flash('success', 'Expenses Updated Successfully');
            return redirect()->route('driver-expenses');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('driver-expenses');
        }
    }

    public function destroyDriverExpenses(Request $request)
    {
        if (Expenses::where('expense_id', $request->expensesId)->delete()) {
            return response(['result' => true]);
        }
    }
}
