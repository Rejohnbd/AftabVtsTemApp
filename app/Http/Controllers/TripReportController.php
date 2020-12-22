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
        if ($request->tripType == null && $request->tripStatus == null) {
            $datas = Trip::where('vehicle_id', $request->vehicleId)->whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])->get();
            return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
        }

        if ($request->tripType == null) {
            $datas = Trip::where('vehicle_id', $request->vehicleId)->where('trip_status', $request->tripStatus)->whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])->get();
            return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
        }

        if ($request->tripStatus == null) {
            $datas = Trip::where('vehicle_id', $request->vehicleId)->where('trip_type_id', $request->tripType)->whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])->get();
            return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
        }

        if ($request->tripType != null && $request->tripStatus != null) {
            $datas = Trip::where('vehicle_id', $request->vehicleId)->where('trip_type_id', $request->tripType)->where('trip_status', $request->tripStatus)->whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])->get();
            return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
        }
    }
}
