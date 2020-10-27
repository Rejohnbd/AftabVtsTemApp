<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpensesType\StoreExpensesTypeRequest;
use App\Http\Requests\ExpensesType\UpdateExpensesTypeRequest;
use App\Models\ExpensesType;
use Illuminate\Http\Request;

class ExpensesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = ExpensesType::all();
        return view('admin.pages.expenses-type.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.expenses-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesTypeRequest $request)
    {
        $newExpensesType = new ExpensesType();
        $newExpensesType->expense_type_name  = $request->expense_type_name;
        $newExpensesType->status             = $request->status;
        $saveNewExpensesType = $newExpensesType->save();

        if ($saveNewExpensesType) {
            session()->flash('success', 'Expenses Type Added Successfully');
            return redirect()->route('expenses-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('expenses-type.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesType  $expensesType
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesType $expensesType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesType  $expensesType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensesType $expensesType)
    {
        return view('admin.pages.expenses-type.edit', compact('expensesType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesType  $expensesType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesTypeRequest $request, ExpensesType $expensesType)
    {
        $updateExpenseType = $expensesType->update([
            'expense_type_name' => $request->expense_type_name,
            'status' => $request->status,
        ]);

        if ($updateExpenseType) {
            session()->flash('success', 'Expenses Type Updated Successfully');
            return redirect()->route('expenses-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('expenses-type.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesType  $expensesType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesType $expensesType)
    {
        //
    }
}
