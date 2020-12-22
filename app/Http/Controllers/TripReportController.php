<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripReportController extends Controller
{
    public function index()
    {
        $allVehicle = Vehicle::all();
        $allTripTypes = TripType::all();
        $firstRow = Trip::first();
        $lastRow = Trip::orderBy('created_at', 'desc')->first();
        return view('admin.pages.reports.trip-report-index')
            ->with('allTripTypes', $allTripTypes)
            ->with('allVehicle', $allVehicle)
            ->with('firstRow', $firstRow)
            ->with('lastRow', $lastRow);
    }

    public function reportByVehicle(Request $request)
    {
        $datas = Trip::whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->where('vehicle_id', 'LIKE', $request->vehicleId)
            ->where('trip_status', 'LIKE', $request->tripStatus)
            ->where('trip_type_id', 'LIKE', $request->tripType)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
    }
}
