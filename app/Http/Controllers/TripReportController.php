<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $q = Trip::query();
        $q->with('driver');

        if ($request->vehicleId) {
            $q->where('vehicle_id',  $request->vehicleId);
        }

        if ($request->tripStatus) {
            $q->where('trip_status',  $request->tripStatus);
        }

        if ($request->tripType) {
            $q->where('trip_type_id',  $request->tripType);
        }

        $datas = $q->whereBetween('created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->view('admin.pages.reports.trip-report-web', compact('datas'));
    }

    public function trpReportDownload(Request $request)
    {
        $datas = array();
        $q = DB::table('trips');
        if ($request->vehicleId) {
            $q->where('vehicle_id',  $request->vehicleId);
        }
        if ($request->tripStatus) {
            $q->where('trip_status',  $request->tripStatus);
        }
        if ($request->tripType) {
            $q->where('trip_type_id',  $request->tripType);
        }
        $tripDatas = $q->join('drivers', 'trips.driver_user_id', '=', 'drivers.driver_user_id')
            ->whereBetween('trips.created_at', [$request->fromDate . ' 00:00:00', $request->toDate . ' 23:59:59'])
            ->select('trips.trip_date', 'drivers.driver_first_name', 'drivers.driver_last_name', 'trips.helper_id', 'trips.trip_from', 'trips.trip_to', 'trips.trip_details', 'trips.trip_start_datetime', 'trips.trip_start_kilometer', 'trips.trip_end_datetime', 'trips.trip_end_kilometer', 'trips.trip_status')
            ->orderBy('trips.created_at', 'desc')
            ->get();

        for ($i = 0; $i < count($tripDatas); $i++) {
            $helperName = '';
            $trip_start_datetime = '';
            $trip_end_datetime = '';
            if (!is_null($tripDatas[$i]->helper_id)) {
                $helperName = findHelperNameForTripReport($tripDatas[$i]->helper_id);
            }
            if (!is_null($tripDatas[$i]->trip_start_datetime)) {
                $trip_start_datetime = date('d/m/Y g:i a', strtotime($tripDatas[$i]->trip_start_datetime));
            }
            if (!is_null($tripDatas[$i]->trip_end_datetime)) {
                $trip_end_datetime = date('d/m/Y g:i a', strtotime($tripDatas[$i]->trip_end_datetime));
            }

            $datas[$i] = ([
                'trip_date'             => $tripDatas[$i]->trip_date,
                'driver_name'           => $tripDatas[$i]->driver_first_name . ' ' . $tripDatas[$i]->driver_last_name,
                'helper_name'           => $helperName,
                'trip_from'             => $tripDatas[$i]->trip_from,
                'trip_to'               => $tripDatas[$i]->trip_to,
                'trip_details'          => $tripDatas[$i]->trip_details,
                'trip_start_datetime'   => $trip_start_datetime,
                'trip_start_kilometer'  => $tripDatas[$i]->trip_start_kilometer,
                'trip_end_datetime'     => $trip_end_datetime,
                'trip_end_kilometer'    => $tripDatas[$i]->trip_end_kilometer,
                'trip_status'           => $tripDatas[$i]->trip_status,
            ]);
        }

        return response()->json($datas);
    }
}
