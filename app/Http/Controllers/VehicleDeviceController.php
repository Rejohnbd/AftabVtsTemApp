<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleDevice\StoreVehicleDeviceRequest;
use App\Models\Device;
use App\Models\Vehicle;
use App\Models\VehicleDevice;
use Illuminate\Http\Request;

class VehicleDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = VehicleDevice::all();
        return view('admin.pages.vehicle-device.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($vechileId)
    {
        $allFreeDevice = Device::where('use_status', 0)->get();
        $findVehicle = Vehicle::findOrFail($vechileId);
        return view('admin.pages.vehicle-device.create')->with('allFreeDevice', $allFreeDevice)->with('vechileId', $findVehicle->vehicle_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleDeviceRequest $request)
    {
        $newVehicleDevice = new VehicleDevice;
        $newVehicleDevice->vehicle_id           = $request->vehicle_id;
        $newVehicleDevice->device_id            = $request->device_id;
        $newVehicleDevice->device_assign_date   = date('Y-m-d', strtotime($request->device_assign_date));
        $newVehicleDevice->status               = $request->status;
        $saveNewVehicleDevice = $newVehicleDevice->save();

        Device::where('device_id', $request->device_id)->update(['use_status' => 1]);

        if ($saveNewVehicleDevice) {
            session()->flash('success', 'Device Assign Successfully');
            return redirect()->route('vehicles.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('vehicles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleDevice  $vehicleDevice
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleDevice $vehicleDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleDevice  $vehicleDevice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicleDevice = VehicleDevice::findOrFail($id);
        dd($vehicleDevice);
        $allFreeDevice = Device::where('use_status', 0)->get();
        return view('admin.pages.vehicle-device.edit')->with('vehicleDevice', $vehicleDevice)->with('allFreeDevice', $allFreeDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleDevice  $vehicleDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleDevice $vehicleDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleDevice  $vehicleDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDevice $vehicleDevice)
    {
        //
    }
}
