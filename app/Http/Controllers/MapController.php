<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceData;
use App\Models\Map;
use App\Models\TemperatureDeviceData;
use App\Models\Vehicle;
use App\Models\VehicleDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::table('devices')
            ->join('vehicle_devices', 'devices.device_id', '=', 'vehicle_devices.device_id')
            ->join('vehicles', 'vehicle_devices.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('device_type_id', 5)
            ->select('devices.device_id', 'vehicles.vehicle_id', 'vehicles.vehicle_brand', 'vehicles.vehicle_model', 'vehicles.vehicle_model_year', 'vehicles.vehicle_plate_number')
            ->get();
        return view('admin.pages.map.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }

    public function deviceLocation($id)
    {
        $deviceInfo = Device::findOrFail($id);
        $deviceDataInfo = DeviceData::select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed')->where('device_id', $deviceInfo->device_id)->orderBy('created_at', 'desc')->first();
        if ($deviceDataInfo == null) :
            session()->flash('error', 'No Device Data Found');
            return redirect()->route('devices.index');
        else :
            return view('admin.pages.map.device-show')->with('deviceInfo', $deviceInfo)->with('deviceDataInfo', $deviceDataInfo);
        endif;
    }

    public function vehicleLocation($id)
    {
        $vehicleInfo = Vehicle::where('vehicle_id', $id)->first();
        // $vehicleDeviceInfo = VehicleDevice::select('device_id')->where('vehicle_id', $id)->first();
        $gpsDevice = findVehicleAttachGpsDevice($vehicleInfo->vehicle_id);
        $tempDevice = findVehicleAttachTemDevice($vehicleInfo->vehicle_id);
        if (!empty($gpsDevice)) {
            $deviceGpsInfo = Device::where('device_id', $gpsDevice['device_id'])->first();
            $deviceTempInfo = Device::where('device_id', $tempDevice['device_id'])->first();
            // dd($deviceTempInfo);
            $deviceDataInfo = DeviceData::select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed')->where('device_id', $deviceGpsInfo->device_id)->orderBy('created_at', 'desc')->first();
            $deviceTempDataInfo = TemperatureDeviceData::select('device_id', 'temperature', 'humidity', 'comp_status')->where('device_id', $deviceTempInfo->device_unique_id)->orderBy('created_at', 'desc')->first();
            if ($deviceDataInfo == null) :
                session()->flash('error', 'No Data Found');
                return redirect()->back();
            else :
                return view('admin.pages.map.vehicle-show')->with('vehicleInfo', $vehicleInfo)->with('deviceInfo', $deviceGpsInfo)->with('deviceDataInfo', $deviceDataInfo)->with('deviceTempInfo', $deviceTempInfo)->with('deviceTempDataInfo', $deviceTempDataInfo);
            endif;
        } else {
            session()->flash('error', 'No GPS Device Added Yet Now.');
            return redirect()->route('vehicles.index');
        }
    }
}
