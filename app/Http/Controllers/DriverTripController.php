<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverTripController extends Controller
{
    public function currentTrip()
    {
        $datas = Trip::where('driver_user_id', Auth::user()->id)->where('trip_status', '!=', 3)->first();
        // dd($datas);
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

    public function startTrip($id)
    {
        Trip::findOrFail($id);
        $startTrip = Trip::where('trip_id', $id)->update(['trip_status' => 2, 'trip_start_datetime' => date('Y-m-d H:m:s')]);
        if ($startTrip == 1) {
            session()->flash('success', 'Trip Started Successfully');
            return redirect()->route('trip-current');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('trip-current');
        }
    }

    public function stopTrip($id)
    {
        Trip::findOrFail($id);
        $startTrip = Trip::where('trip_id', $id)->update(['trip_status' => 3, 'trip_end_datetime' => date('Y-m-d H:m:s')]);
        if ($startTrip == 1) {
            session()->flash('success', 'Trip Stoped Successfully');
            return redirect()->route('trip-current');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('trip-current');
        }
    }
}
