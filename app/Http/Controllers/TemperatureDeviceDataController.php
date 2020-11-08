<?php

namespace App\Http\Controllers;

use App\Models\TemperatureDeviceData;
use Illuminate\Http\Request;

class TemperatureDeviceDataController extends Controller
{
    public function tempDevice($id)
    {
        $data = [
            'title'     => 'Temperature Device Details',
            'temp_device_id' => $id
        ];
        return view('admin.pages.temperature.index', compact('data'));
    }

    public function getTempDevice(Request $request)
    {
        $deviceData = TemperatureDeviceData::where('device_id', $request->deviceId)->orderBy('created_at', 'desc')->first();
        return response($deviceData);
    }

    public function tempDeviceReport($id)
    {
        $data = [
            'title'     => 'Temperature Device Report',
            'temp_device_id' => $id
        ];
        $today = date('Y-m-d');
        $reports = TemperatureDeviceData::where('device_id', $id)->whereDate('created_at', $today)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.report')->with('data', $data)->with('reports', $reports);
    }

    public function tempDeviceApiData($id, $temp, $humi, $status)
    {
        $device_id = $id;
        $temperature = $temp;
        $humidity = $humi;
        $comp_status = $status;
        $saveData = TemperatureDeviceData::create([
            'device_id' => $device_id,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'comp_status' => $comp_status,
        ]);

        if ($saveData) {
            $data = array(
                'status' => 201,
                'message' => 'Created Successfully'
            );
            return response($data);
        } else {
            $data = array(
                'status' => 304,
                'message' => 'Failed'
            );
            return response($data);
        }
    }
}
