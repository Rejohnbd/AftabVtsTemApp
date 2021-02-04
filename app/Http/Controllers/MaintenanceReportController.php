<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\MaintenanceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceReportController extends Controller
{
    public function index()
    {
        $maintenanceTypes = MaintenanceType::all();
        $firstDate =  Maintenance::first();
        $lastDate = Maintenance::orderBy('created_at', 'desc')->first();
        return view('admin.pages.reports.maintenance-report-index')
            ->with('maintenanceTypes', $maintenanceTypes)
            ->with('firstDate', $firstDate)
            ->with('lastDate', $lastDate);
    }

    public function maintenanceReportGenerate(Request $request)
    {
        $query = DB::table('maintenance');
        $query->join('maintenance_types', 'maintenance.maintenance_type_id', '=', 'maintenance_types.maintenance_type_id');
        $query->join('vehicles', 'maintenance.vehicle_id', '=', 'vehicles.vehicle_id');
        if ($request->maintenanceTypeId) {
            $query->where('maintenance.maintenance_type_id', $request->maintenanceTypeId);
        }
        $datas = $query->whereBetween('maintenance.created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->select('maintenance_types.maintenance_type_name', 'vehicles.vehicle_plate_number', 'maintenance.maintenance_date', 'maintenance.maintenance_details', 'maintenance.maintenance_next_date')
            ->orderBy('maintenance.created_at', 'desc')
            ->get();
        return response()->view('admin.pages.reports.maintenance-report-web', compact('datas'));
    }

    public function maintenanceReportDownload(Request $request)
    {
        $query = DB::table('maintenance');
        $query->join('maintenance_types', 'maintenance.maintenance_type_id', '=', 'maintenance_types.maintenance_type_id');
        $query->join('vehicles', 'maintenance.vehicle_id', '=', 'vehicles.vehicle_id');
        if ($request->maintenanceTypeId) {
            $query->where('maintenance.maintenance_type_id', $request->maintenanceTypeId);
        }
        $datas = $query->whereBetween('maintenance.created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->select('maintenance_types.maintenance_type_name', 'vehicles.vehicle_plate_number', 'maintenance.maintenance_date', 'maintenance.maintenance_details', 'maintenance.maintenance_next_date')
            ->orderBy('maintenance.created_at', 'desc')
            ->get();
        return response()->json($datas);
    }
}
