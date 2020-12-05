<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripReportController extends Controller
{
    public function index()
    {
        $allVehicle = Vehicle::all();
        $firstRow = Trip::first();
        $lastRow = Trip::orderBy('created_at','desc')->first();
        return view('admin.pages.reports.trip-report-index')
            ->with('allVehicle', $allVehicle)
            ->with('firstRow', $firstRow)
            ->with('lastRow', $lastRow);
    }

    public function reportByVehicle(Request $request)
    {
        $datas = Trip::where('vehicle_id', $request->vehicleId)->whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])->get();
        return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
    }
}
