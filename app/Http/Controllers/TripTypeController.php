<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripType\StoreTripTypeRequest;
use App\Http\Requests\TripType\UpdateTripTypeRequest;
use App\Models\TripType;
use Illuminate\Http\Request;

class TripTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TripType::all();
        return view('admin.pages.trip-type.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.trip-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripTypeRequest $request)
    {
        $newTripType = new TripType();
        $newTripType->trip_type_name    = $request->trip_type_name;
        $newTripType->status            = $request->status;
        $saveNewTripType = $newTripType->save();

        if ($saveNewTripType) {
            session()->flash('success', 'Trip Type Added Successfully');
            return redirect()->route('trip-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('trip-type.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TripType  $tripType
     * @return \Illuminate\Http\Response
     */
    public function show(TripType $tripType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TripType  $tripType
     * @return \Illuminate\Http\Response
     */
    public function edit(TripType $tripType)
    {
        return view('admin.pages.trip-type.edit', compact('tripType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TripType  $tripType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripTypeRequest $request, TripType $tripType)
    {
        // dd($request->all(), $tripType->trip_type_id);
        $checkExistance = TripType::select('trip_type_name')->where('trip_type_id', '!=', $tripType->trip_type_id)->where('trip_type_name', $request->trip_type_name)->first();
        if ($checkExistance == null) {
            $updateTripType = $tripType->update([
                'trip_type_name' => $request->trip_type_name,
                'status' => $request->status,
            ]);

            if ($updateTripType) {
                session()->flash('success', 'Trip Type Updated Successfully');
                return redirect()->route('trip-type.index');
            } else {
                session()->flash('error', 'Something Happend Wrong');
                return redirect()->route('trip-type.index');
            }
        } else {
            session()->flash('error', 'Duplicate Trip Type Exist');
            return redirect()->route('trip-type.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TripType  $tripType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripType $tripType)
    {
        //
    }
}
