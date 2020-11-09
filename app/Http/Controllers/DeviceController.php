<?php

namespace App\Http\Controllers;

use App\Http\Requests\Device\StoreDeviceRequest;
use App\Http\Requests\Device\UpdateDeviceRequest;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\VehicleDevice;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allDevices = Device::all();
        return view('admin.pages.devices.index', compact('allDevices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allDeviceType = DeviceType::select('device_type_id', 'device_type_name')->where('status', 1)->get();
        return view('admin.pages.devices.create', compact('allDeviceType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeviceRequest $request)
    {
        $newDevice = new Device;
        $newDevice->device_type_id      = $request->device_type_id;
        $newDevice->device_unique_id    = $request->device_unique_id;
        $newDevice->device_model        = $request->device_model;
        $newDevice->device_sim_number   = $request->device_sim_number;
        $newDevice->device_sim_type     = $request->device_sim_type;
        $newDevice->status              = $request->status;
        $saveNewDevice = $newDevice->save();

        if ($saveNewDevice) {
            session()->flash('success', 'Device Added Successfully');
            return redirect()->route('devices.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('devices.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        $allDeviceType = DeviceType::select('device_type_id', 'device_type_name')->where('status', 1)->get();
        return view('admin.pages.devices.edit')->with('device', $device)->with('allDeviceType', $allDeviceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        $updateDevice = $device->update([
            'device_type_id'      => $request->device_type_id,
            'device_unique_id'    => $request->device_unique_id,
            'device_model'        => $request->device_model,
            'device_sim_number'   => $request->device_sim_number,
            'device_sim_type'     => $request->device_sim_type,
            'status'              => $request->status
        ]);

        if ($updateDevice) {
            session()->flash('success', 'Device Update Successfully');
            return redirect()->route('devices.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('devices.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }

    public function destroyDevice(Request $request)
    {
        // dd($request->all());
        if (VehicleDevice::where('device_id', $request->deviceId)->count() > 0) {
            return response(['result' => false]);
        } else {
            Device::where('device_id', $request->deviceId)->delete();
            return response(['result' => true]);
        }
    }
}
