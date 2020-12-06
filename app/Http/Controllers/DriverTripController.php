<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverTripController extends Controller
{
    public function currentTrip()
    {
        $datas = Trip::where('driver_user_id', Auth::user()->id)->where('trip_status', '!=', 3)->first();
        if (!$datas == null) {
            $vehicle_info = Vehicle::where('vehicle_id', $datas->vehicle_id)->first();
            return view('driver.pages.trips.current-trip')->with('datas', $datas)->with('vehicle_info', $vehicle_info);
        } else {
            return view('driver.pages.trips.current-trip')->with('datas', $datas);
        }
    }

    public function oldTrip()
    {
        $datas = Trip::where('driver_user_id', Auth::user()->id)->where('trip_status', '=', 3)->get();
        return view('driver.pages.trips.old-trip', compact('datas'));
    }

    public function startTrip(Request $request)
    {
        Trip::findOrFail($request->tripId);
        $presetDateTime = Carbon::now();
        $startTrip = Trip::where('trip_id', $request->tripId)->update(['trip_status' => 2, 'trip_start_kilometer' => $request->tripStartKm, 'trip_start_datetime' => $presetDateTime]);
        if ($startTrip == 1) {
            return response(['result' => true]);
        } else {
            return response(['result' => false]);
        }
    }

    public function stopTrip(Request $request)
    {
        Trip::findOrFail($request->tripId);
        $presetDateTime = Carbon::now();
        $startTrip = Trip::where('trip_id', $request->tripId)->update(['trip_status' => 3, 'trip_end_kilometer' => $request->tripEndkm,  'trip_end_datetime' => $presetDateTime]);
        if ($startTrip == 1) {
            return response(['result' => true]);
        } else {
            return response(['result' => false]);
        }
    }
}
