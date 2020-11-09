<?php

namespace App\Http\Controllers;

use App\DeviceType as AppDeviceType;
use App\Http\Requests\DeviceType\StoreDeviceTypeRequest;
use App\Http\Requests\DeviceType\UpdateDeviceTypeRequest;
use App\Models\Device;
use App\Models\DeviceType;
use Illuminate\Http\Request;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allDeviceType = DeviceType::all();
        return view('admin.pages.device-type.index', compact('allDeviceType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.device-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeviceTypeRequest $request)
    {
        DeviceType::create($request->all());
        session()->flash('success', 'Device Type Added Successfully');
        return redirect()->route('device-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceType $deviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceType $deviceType)
    {
        return view('admin.pages.device-type.edit')->with('deviceType', $deviceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceTypeRequest $request, DeviceType $deviceType)
    {
        $deviceType->update([
            'device_type_name' => $request->device_type_name,
            'status' => $request->status,
        ]);

        session()->flash('success', 'Device Type Updated Successfully');
        return redirect()->route('device-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceType $deviceType)
    {
        //
    }

    public function destroDeviceType(Request $request)
    {
        if (Device::where('device_type_id', $request->deviceTypeId)->count() > 0) {
            return response(['result' => false]);
        } else {
            DeviceType::where('device_type_id', $request->deviceTypeId)->delete();
            return response(['result' => true]);
        }
    }
}
