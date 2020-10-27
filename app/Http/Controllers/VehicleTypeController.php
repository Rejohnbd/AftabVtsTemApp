<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiceType\StoreVehicleTypeRequest;
use App\Http\Requests\VehiceType\UpdateVehicleTypeRequest;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = VehicleType::all();
        return view('admin.pages.vehicle-type.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.vehicle-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleTypeRequest $request)
    {
        $newVehicleType = new VehicleType;
        $newVehicleType->vehicle_type_name  = $request->vehicle_type_name;
        $newVehicleType->status             = $request->status;
        $saveNewVehicleType = $newVehicleType->save();

        if ($saveNewVehicleType) {
            session()->flash('success', 'Vehicle Type Added Successfully');
            return redirect()->route('vehicle-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('vehicle-type.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleType $vehicleType)
    {
        return view('admin.pages.vehicle-type.edit', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $updateVehicleType = $vehicleType->update([
            'vehicle_type_name' => $request->vehicle_type_name,
            'status' => $request->status,
        ]);

        if ($updateVehicleType) {
            session()->flash('success', 'Vehicle Type Update Successfully');
            return redirect()->route('vehicle-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('vehicle-type.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicleType)
    {
        //
    }
}
