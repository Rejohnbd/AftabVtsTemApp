<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceData;
use App\Models\Vehicle;
use App\Models\VehicleDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DeviceDataController extends Controller
{

    public function index($id)
    {
        $vehicleInfo = Vehicle::where('vehicle_id', $id)->first();
        $vehicleDeviceInfo = VehicleDevice::select('device_id')->where('vehicle_id', $id)->first();
        $deviceInfo = Device::where('device_id', $vehicleDeviceInfo->device_id)->first();
        $deviceDataInfo = DeviceData::select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed')->where('device_id', $deviceInfo->device_id)->orderBy('created_at', 'desc')->first();
        if ($deviceDataInfo == null) :
            session()->flash('error', 'No Data Found');
            return redirect()->back();
        else :
            return view('admin.pages.reports.index')->with('vehicleInfo', $vehicleInfo)->with('deviceInfo', $deviceInfo)->with('deviceDataInfo', $deviceDataInfo);
        endif;
    }

    public function datedReport(Request $request)
    {
        $date = $request->selectedDate;
        $datas = DB::table('device_data')->select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed', 'distance', 'fuel_use', 'created_at')->where('vehicle_id', $request->vehicleId)->whereDate('created_at', $date)->get();
        return response()->view('admin.pages.reports.daily-distance-report-web', compact('datas'));
    }

    public function datedReportDownload(Request $request)
    {
        $date = $request->selectedDate;
        $datas = DB::table('device_data')->select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed', 'created_at')->where('vehicle_id', $request->vehicleId)->whereDate('created_at', $date)->get();
        $pdf = PDF::loadView('admin.pages.reports.daily-distance-report', [
            'datas' => $datas
        ]);
        $pdf->setPaper('A4');
        return $pdf->download('Daily_Reports.pdf');
    }

    public function datedEngineStatusReport(Request $request)
    {
        $date = $request->selectedDate;
        $datas = DB::table('device_data')->select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed', 'created_at')->where('vehicle_id', $request->vehicleId)->whereDate('created_at', $date)->get();
        return response()->view('admin.pages.reports.daily-status-report-web', compact('datas'));
    }

    public function datedEngineStatusDownload(Request $request)
    {
        $date = $request->selectedDate;
        $datas = DB::table('device_data')->select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed', 'created_at')->where('vehicle_id', $request->vehicleId)->whereDate('created_at', $date)->get();
        $pdf = PDF::loadView('admin.pages.reports.daily-status-report', [
            'datas' => $datas
        ]);
        $pdf->setPaper('A4');
        return $pdf->download('Daily_Status_Reports.pdf');
    }

    public function monthlyReport(Request $request)
    {
        $date = strtotime($request->selectedDate);
        $month = date("m", $date);
        $year = date("Y", $date);
        $datas = DB::table('device_data')->select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed', 'created_at')->where('vehicle_id', $request->vehicleId)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        return response()->view('admin.pages.reports.monthly-report-web', compact('datas'));
    }

    public function monthlyReportDownload(Request $request)
    {
        $date = strtotime($request->selectedDate);
        $month = date("m", $date);
        $year = date("Y", $date);
        $datas = DB::table('device_data')->select('device_id', 'vehicle_id', 'latitude', 'longitude', 'status', 'speed', 'created_at')->where('vehicle_id', $request->vehicleId)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        $pdf = PDF::loadView('admin.pages.reports.monthly-report', [
            'datas' => $datas
        ]);
        $pdf->setPaper('A4');
        return $pdf->download('Monthly_Reports.pdf');
    }


    public function deviceApiPostData(Request $request)
    {
        $device_data_json = trim(file_get_contents("php://input"));
        $data = json_decode($device_data_json);

        $device = new DeviceData();
        $device_id = $device->findDeviceIdFromApi($data->imei);
        $vehicle_id = $device->findVehicleIdFromApi($device_id);
        $vehicle_kpl = $device->findVehicleKplByDeviceId($device_id);

        $lastLatLng = DeviceData::select('latitude', 'longitude')->where('device_id', $device_id)->orderBy('created_at', 'desc')->first();
        if ($lastLatLng == null) {
            $distance = 0;
            $fuel_use = 0;
        } else {
            $distance = calculateDistance($lastLatLng->latitude, $lastLatLng->longitude, $data->lat, $data->lng);
            $fuel_use = (1 / $vehicle_kpl) * $distance;
        }

        $saveData = DeviceData::create([
            'device_id'         => $device_id,
            'vehicle_id'        => $vehicle_id,
            'latitude'          => $data->lat,
            'longitude'         => $data->lng,
            'status'            => $data->status,
            'speed'             => $data->speed,
            'distance'          => $distance,
            'fuel_use'          => $fuel_use,
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
