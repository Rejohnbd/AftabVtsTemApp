<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\ExpensesType;
use Illuminate\Http\Request;

class ExpensesReportController extends Controller
{
    public function index()
    {
        $activeExpensesTypes = ExpensesType::where('status', 1)->get();
        $firstRow = Expenses::first();
        $lastRow = Expenses::orderBy('created_at','desc')->first();
        return view('admin.pages.reports.expenses-report-index')
            ->with('activeExpensesTypes', $activeExpensesTypes)
            ->with('firstRow', $firstRow)
            ->with('lastRow', $lastRow);
    }

    public function reportByExpenseType(Request $request)
    {
        $expensesTypeId = $request->expensesTypeId;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $datas = Expenses::where('expense_type_id', $expensesTypeId)->whereBetween('created_at', [$fromDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();
        return response()->view('admin.pages.reports.expense-report-web', compact('datas'));
    }
}
