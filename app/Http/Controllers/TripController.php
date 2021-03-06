<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trips\StoreTripsRequest;
use App\Http\Requests\Trips\UpdateTripsRequest;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Expenses;
use App\Models\Helper;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\Vehicle;
use Carbon\Carbon;
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
        $datas = Trip::orderBy('trip_id', 'desc')->paginate(10);
        $allHelper = Helper::all();
        $helpers = array();
        foreach ($allHelper as $value) {
            $helpers[$value->helper_id] = $value;
        }
        // dd($datas);
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
        $allTripTypes = TripType::all();
        $allCompanies = Company::where('status', 1)->get();
        return view('admin.pages.trip.create')
            ->with('allTripTypes', $allTripTypes)
            ->with('allFreeVehicle', $allFreeVehicle)
            ->with('allFreeDriver', $allFreeDriver)
            ->with('allFreeHelper', $allFreeHelper)
            ->with('allCompanies', $allCompanies);
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
        $newTrip->trip_type_id      = $request->trip_type_id;
        $newTrip->vehicle_id        = $request->vehicle_id;
        $newTrip->company_id        = $request->company_id;
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
        $allTripTypes = TripType::all();
        $allCompanies = Company::where('status', 1)->get();
        return view('admin.pages.trip.edit')
            ->with('trip', $trip)
            ->with('allTripTypes', $allTripTypes)
            ->with('allFreeVehicle', $allFreeVehicle)
            ->with('allFreeDriver', $allFreeDriver)
            ->with('allFreeHelper', $allFreeHelper)
            ->with('allCompanies', $allCompanies);
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
            'trip_type_id'      => $request->trip_type_id,
            'vehicle_id'        => $request->vehicle_id,
            'company_id'        => $request->company_id,
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
