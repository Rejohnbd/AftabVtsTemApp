<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\TemperatureDeviceData;
use Illuminate\Http\Request;

class TemperatureDeviceDataController extends Controller
{
    public function tempDevice($id)
    {
        $tempDeviceInfo = Device::findOrFail($id);
        $tempDeviceLastData = TemperatureDeviceData::where('device_id', $tempDeviceInfo->device_unique_id)->orderBy('created_at', 'desc')->first();
        return view('admin.pages.temperature.index')->with('tempDeviceInfo', $tempDeviceInfo)->with('tempDeviceLastData', $tempDeviceLastData);
    }

    public function getTempDevice(Request $request)
    {
        $deviceData = TemperatureDeviceData::where('device_id', $request->deviceId)->orderBy('created_at', 'desc')->first();
        return response($deviceData);
    }

    public function tempDeviceReport($id)
    {
        $tempDeviceInfo = Device::findOrFail($id);
        $today = date('Y-m-d');
        $reports = TemperatureDeviceData::where('device_id', $tempDeviceInfo->device_unique_id)->whereDate('created_at', $today)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.report')->with('tempDeviceInfo', $tempDeviceInfo)->with('reports', $reports);
    }

    public function tempDeviceDataPaginate(Request $request)
    {
        $tempDeviceInfo = Device::findOrFail($request->deviceId);
        $date = $request->selectedDate;
        $reports = TemperatureDeviceData::where('device_id', $tempDeviceInfo->device_unique_id)->whereDate('created_at', $date)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.report-single', compact('reports'))->render();
    }

    public function tempDeviceDatedData(Request $request)
    {
        $tempDeviceInfo = Device::findOrFail($request->deviceId);
        $date = $request->selectedDate;
        $reports = TemperatureDeviceData::where('device_id', $tempDeviceInfo->device_unique_id)->whereDate('created_at', $date)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.report-single', compact('reports'))->render();
    }

    public function tempDeviceDataExcelExport(Request $request)
    {
        $tempDeviceInfo = Device::findOrFail($request->deviceId);
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $deviceId = $tempDeviceInfo->device_unique_id;
        $datas = TemperatureDeviceData::select('temperature', 'humidity', 'comp_status', 'created_at AS date', 'created_at AS time')->where('device_id', $tempDeviceInfo->device_unique_id)->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        $info['deviceId']  = $deviceId;
        $info['startDate'] = $startDate;
        $info['endDate']   = $endDate;
        $overAllData['info'] = $info;
        $overAllData['datas'] = $datas;
        return response()->json($overAllData);
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
