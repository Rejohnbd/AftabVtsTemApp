<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceData;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
    public function deviceApiPostData(Request $request)
    {
        $device_data_json = trim(file_get_contents("php://input"));
        $data = json_decode($device_data_json);

        $device = new DeviceData();
        $device_id = $device->findDeviceIdFromApi($data->imei);
        $vehicle_id = $device->findVehicleIdFromApi($device_id);

        $saveData = DeviceData::create([
            'device_id'         => $device_id,
            'vehicle_id'        => $vehicle_id,
            'latitude'          => $data->lat,
            'longitude'         => $data->lng,
            'status'            => $data->status,
            'speed'             => $data->speed,
            'device_time'       => $data->device_time,
            'device_date_json'  => json_encode($data->date),
            'device_data_json'  => $device_data_json,
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
