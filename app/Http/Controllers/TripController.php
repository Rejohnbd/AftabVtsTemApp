<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trips\StoreTripsRequest;
use App\Http\Requests\Trips\UpdateTripsRequest;
use App\Models\Driver;
use App\Models\Expenses;
use App\Models\Helper;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Trip::paginate(10);
        $allHelper = Helper::all();
        $helpers = array();
        foreach ($allHelper as $value) {
            $helpers[$value->helper_id] = $value;
        }
        return view('admin.pages.trip.index')->with('datas', $datas)->with('allHelper', $helpers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allFreeVehicle = Vehicle::all();
        $allFreeDriver = Driver::all();
        $allFreeHelper = Helper::all();
        return view('admin.pages.trip.create')->with('allFreeVehicle', $allFreeVehicle)->with('allFreeDriver', $allFreeDriver)->with('allFreeHelper', $allFreeHelper);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripsRequest $request)
    {
        $helperIds = null;
        if ($request->helper_id) {
            $helperIds = implode(',', $request->helper_id);
        }
        $newTrip = new Trip;
        $newTrip->vehicle_id        = $request->vehicle_id;
        $newTrip->driver_user_id    = $request->driver_user_id;
        $newTrip->helper_id         = $helperIds;
        $newTrip->trip_from         = $request->trip_from;
        $newTrip->trip_to           = $request->trip_to;
        $newTrip->trip_details      = $request->trip_details;
        $newTrip->trip_date         = date('Y-m-d', strtotime($request->trip_date));
        $newTrip->trip_status       = $request->trip_status;
        $saveNewTrip = $newTrip->save();

        if ($saveNewTrip) {
            session()->flash('success', 'Trip Added Successfully');
            return redirect()->route('trips.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('trips.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        $allFreeVehicle = Vehicle::all();
        $allFreeDriver = Driver::all();
        $allFreeHelper = Helper::all();
        return view('admin.pages.trip.edit')->with('trip', $trip)->with('allFreeVehicle', $allFreeVehicle)->with('allFreeDriver', $allFreeDriver)->with('allFreeHelper', $allFreeHelper);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripsRequest $request, Trip $trip)
    {
        $helperIds = null;
        if ($request->helper_id) {
            $helperIds = implode(',', $request->helper_id);
        }
        $updateTrip = $trip->update([
            'vehicle_id'        => $request->vehicle_id,
            'driver_user_id'    => $request->driver_user_id,
            'helper_id'         => $helperIds,
            'trip_from'         => $request->trip_from,
            'trip_to'           => $request->trip_to,
            'trip_details'      => $request->trip_details,
            'trip_date'         => date('Y-m-d', strtotime($request->trip_date)),
            'trip_status'       => $request->trip_status
        ]);

        if ($updateTrip) {
            session()->flash('success', 'Trip Update Successfully');
            return redirect()->route('trips.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('trips.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function destroyTrip(Request $request)
    {
        if (Expenses::where('trip_id', $request->tripId)->count() > 0) {
            return response(['result' => false]);
        } else {
            Trip::where('trip_id', $request->tripId)->delete();
            return response(['result' => true]);
        }
    }
}
