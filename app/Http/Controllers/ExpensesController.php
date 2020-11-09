<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expenses\StoreExpensesRequest;
use App\Http\Requests\Expenses\UpdateExpensesRequest;
use App\Models\Expenses;
use App\Models\ExpensesType;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.pages.expenses.index', compact('datas'));
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
            return redirect()->route('all-expenses.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('all-expenses.index');
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
        return view('admin.pages.expenses.edit')->with('expenses', $expenses)->with('allTrip', $allTrip)->with('allExpensesType', $allExpensesType);
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
            return redirect()->route('all-expenses.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('all-expenses.index');
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
