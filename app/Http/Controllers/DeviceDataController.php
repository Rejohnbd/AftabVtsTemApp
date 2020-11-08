<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
    public function deviceApiPostData(Request $request)
    {
        // dd($request->all());
        // $device_data_json = json_encode($request->all());
        $device_data_json = trim(file_get_contents("php://input"));;

        $saveData = DeviceData::create([
            'device_id'         => 1,
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
