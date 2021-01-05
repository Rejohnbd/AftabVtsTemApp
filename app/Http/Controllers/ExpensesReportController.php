<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Expenses;
use App\Models\ExpensesType;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesReportController extends Controller
{
    public function index()
    {
        $activeExpensesTypes = ExpensesType::where('status', 1)->get();
        $firstRow = Expenses::first();
        $lastRow = Expenses::orderBy('created_at', 'desc')->first();
        $allCompanies = Company::all();
        $allVechicles = Vehicle::all();
        return view('admin.pages.reports.expenses-report-index')
            ->with('allCompanies', $allCompanies)
            ->with('allVechicles', $allVechicles)
            ->with('activeExpensesTypes', $activeExpensesTypes)
            ->with('firstRow', $firstRow)
            ->with('lastRow', $lastRow);
    }

    public function reportByExpenseType(Request $request)
    {
        $q = DB::table('expenses_items');
        $q->join('expenses', 'expenses_items.expense_id', '=', 'expenses.expense_id');
        $q->join('expense_types', 'expenses_items.expense_type_id', '=', 'expense_types.expense_type_id');
        if ($request->expensesTypeId) {
            $q->where('expense_types.expense_type_id', $request->expensesTypeId);
        }
        $q->join('trips', 'expenses.trip_id', '=', 'trips.trip_id');
        $q->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id');
        if ($request->vehicleId) {
            $q->where('vehicles.vehicle_id', $request->vehicleId);
        }
        $q->join('companies', 'trips.company_id', '=', 'companies.company_id');
        if ($request->companyId) {
            $q->where('companies.company_id', $request->companyId);
        }
        $datas = $q->whereBetween('expenses.created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->select('companies.company_name', 'vehicles.vehicle_plate_number', 'trips.trip_details', 'expense_types.expense_type_name', 'expenses_items.expense_date', 'expenses.expense_description', 'expenses_items.expense_amount')
            ->orderBy('expenses.created_at', 'desc')
            ->get();

        return response()->view('admin.pages.reports.expense-report-web', compact('datas'));
    }

    public function reportDownload(Request $request)
    {
        $q = DB::table('expenses_items');
        $q->join('expenses', 'expenses_items.expense_id', '=', 'expenses.expense_id');
        $q->join('expense_types', 'expenses_items.expense_type_id', '=', 'expense_types.expense_type_id');
        if ($request->expensesTypeId) {
            $q->where('expense_types.expense_type_id', $request->expensesTypeId);
        }
        $q->join('trips', 'expenses.trip_id', '=', 'trips.trip_id');
        $q->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id');
        if ($request->vehicleId) {
            $q->where('vehicles.vehicle_id', $request->vehicleId);
        }
        $q->join('companies', 'trips.company_id', '=', 'companies.company_id');
        if ($request->companyId) {
            $q->where('companies.company_id', $request->companyId);
        }
        $datas = $q->whereBetween('expenses.created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->select('companies.company_name', 'vehicles.vehicle_plate_number', 'trips.trip_details', 'expense_types.expense_type_name', 'expenses_items.expense_date', 'expenses.expense_description', 'expenses_items.expense_amount')
            ->orderBy('expenses.created_at', 'desc')
            ->get();
    return response()->json($datas);
        return response()->view('admin.pages.reports.expense-report-web', compact('datas'));
    }
}
