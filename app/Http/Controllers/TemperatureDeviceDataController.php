<?php

namespace App\Http\Controllers;

use App\Mail\TempNotificationMail;
use App\Models\Device;
use App\Models\Settings;
use App\Models\TemperatureDeviceData;
use App\Models\Trip;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TemperatureDeviceDataController extends Controller
{
    public function tempDevice($id)
    {
        $tempDeviceInfo = Device::findOrFail($id);
        $tempDeviceLastData = TemperatureDeviceData::where('device_id', $tempDeviceInfo->device_unique_id)->orderBy('created_at', 'desc')->first();
        if ($tempDeviceLastData == null) :
            session()->flash('error', 'No Data Found');
            return redirect()->back();
        else :
            return view('admin.pages.temperature.index')->with('tempDeviceInfo', $tempDeviceInfo)->with('tempDeviceLastData', $tempDeviceLastData);
        endif;
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

    public function vehicleTempReport($id)
    {
        $vehicleInfo = Vehicle::findOrFail($id);
        // dd($vehicleInfo);
        $today = date('Y-m-d');
        $reports = TemperatureDeviceData::where('vehicle_id', $vehicleInfo->vehicle_id)->whereDate('created_at', $today)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.reportbyvehicle')->with('vehicleInfo', $vehicleInfo)->with('reports', $reports);
    }

    public function vehicleTempDataPaginate(Request $request)
    {
        $deviceInfo = Vehicle::findOrFail($request->vehicleId);
        $date = $request->selectedDate;
        $reports = TemperatureDeviceData::where('vehicle_id', $deviceInfo->vehicle_id)->whereDate('created_at', $date)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.report-single', compact('reports'))->render();
    }

    public function vehicleTempDatedData(Request $request)
    {
        $deviceInfo = Vehicle::findOrFail($request->vehicleId);
        $date = $request->selectedDate;
        $reports = TemperatureDeviceData::where('vehicle_id', $deviceInfo->vehicle_id)->whereDate('created_at', $date)->orderBy('created_at', 'desc')->paginate(60);
        return view('admin.pages.temperature.report-single', compact('reports'))->render();
    }

    public function vehicleTempDataExcelExport(Request $request)
    {

        $deviceInfo = Vehicle::findOrFail($request->vehicleId);
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $vehicleNumber = $deviceInfo->vehicle_plate_number;
        $datas = TemperatureDeviceData::select('temperature', 'humidity', 'comp_status', 'created_at AS date', 'created_at AS time')->where('vehicle_id', $deviceInfo->vehicle_id)->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        $info['vehicleNumber']  = $vehicleNumber;
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

        $settingsData = array_column(Settings::all()->toArray(), 'value', 'name');
        $vehicleInfo = findVehicleRegiNo($device_id);

        if ($temperature < $settingsData['alert_min_temp'] || $temperature > $settingsData['alert_max_temp'] ||  $humidity < $settingsData['alert_min_humidity'] || $humidity > $settingsData['alert_max_humidity']) {


            $tripInfo = Trip::where('vehicle_id', $vehicleInfo->vehicle_id)->orderBy('created_at', 'desc')->first();

            if ($tripInfo->trip_status == 1 || $tripInfo->trip_status == 2) {
                $deviceInfo = Device::select('device_id')->where('device_unique_id', $device_id)->first();
                $deviceLastData = DB::table('notification')->where('device_id', $deviceInfo->device_id)->orderBy('notification_id', 'desc')->first();

                if ($deviceLastData) {
                    $lastDataTime = strtotime($deviceLastData->notification_datetime);
                    $prsentTime = strtotime(Carbon::now());
                    $interval = abs($prsentTime - $lastDataTime);
                    $minutes   = round($interval / 60);
                }

                if ($deviceLastData == null || ($minutes > 20)) {
                    $vehicle_regi_no = $vehicleInfo->vehicle_plate_number;
                    $mailData['vehicle_regi_no'] = $vehicle_regi_no;
                    $mailData['device_id'] = $device_id;
                    $mailData['temperature'] = $temperature;
                    $mailData['humidity'] = $humidity;
                    $mailData['date_time'] = Carbon::now();
                    $mailData['settings_data'] = $settingsData;
                    Mail::send(new TempNotificationMail($mailData));

                    $notification_type = null;
                    if ($temperature < $settingsData['alert_min_temp']) {
                        $notification_type = 'Low Temp';
                    } elseif ($temperature > $settingsData['alert_max_temp']) {
                        $notification_type = 'High Temp';
                    } elseif ($humidity < $settingsData['alert_min_humidity']) {
                        $notification_type = 'Low Humidity';
                    } else {
                        $notification_type = 'High Humidity';
                    }

                    DB::table('notification')->insert([
                        'vehicle_id' => $vehicleInfo->vehicle_id,
                        'device_id' => $deviceInfo->device_id,
                        'notification_type' => $notification_type,
                        'notification_body' => '',
                        'notification_datetime' => Carbon::now()
                    ]);
                }
            }
        }

        $saveData = TemperatureDeviceData::create([
            'dev_id'        => $vehicleInfo->device_id,
            'vehicle_id'    => $vehicleInfo->vehicle_id,
            'device_id'     => $device_id,
            'temperature'   => $temperature,
            'humidity'      => $humidity,
            'comp_status'   => $comp_status,
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

    public function iotDeviceApiData($id, $temp, $comp, $status)
    {
        $deviceInfo = Device::select('device_id')->where('device_unique_id', $id)->first();
        $vehicleInfo = findVehicleRegiNo($id);

        if ($vehicleInfo) {

            if ($comp == 0.00) {
                $comp_status = 0;
            } else {
                $comp_status = 1;
            }
            $device_id      = $id;
            $voltage        = $comp;
            $temperature    = $temp;
            $humidity       = NULL;
            $status         = $status;

            $saveData = TemperatureDeviceData::create([
                'dev_id'        => $deviceInfo->device_id,
                'vehicle_id'    => $vehicleInfo->vehicle_id,
                'device_id'     => $device_id,
                'voltage'       => $voltage,
                'temperature'   => $temperature,
                'humidity'      => $humidity,
                'comp_status'   => $comp_status,
                'status'        => $status,
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
        } else {
            if ($comp == 0.00) {
                $comp_status = 0;
            } else {
                $comp_status = 1;
            }

            $device_id      = $id;
            $voltage        = $comp;
            $temperature    = $temp;
            $humidity       = NULL;
            $status         = $status;

            $saveData = TemperatureDeviceData::create([
                'dev_id'        => 0,
                'vehicle_id'    => 0,
                'device_id'     => $device_id,
                'voltage'       => $voltage,
                'temperature'   => $temperature,
                'humidity'      => $humidity,
                'comp_status'   => $comp_status,
                'status'        => $status,
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

    public function deviceDataWithFailData(Request $request)
    {
        $device_data_json = trim(file_get_contents("php://input"));
        DB::table('test_data')->insert([
            'test_data'     => json_encode($device_data_json),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $dataArray = explode(';', $device_data_json);

        if (isset($dataArray[0]) && isset($dataArray[1]) && isset($dataArray[2]) && isset($dataArray[3]) && isset($dataArray[4])) {
            $id     = $dataArray[0];
            $temp   = $dataArray[1];
            $comp   = $dataArray[2];
            $status = $dataArray[4];
            $date   = $dataArray[3];

            $deviceInfo = Device::select('device_id')->where('device_unique_id', $id)->first();
            $vehicleInfo = findVehicleRegiNo($id);

            if ($vehicleInfo) {

                if ($comp == 0.00) {
                    $comp_status = 0;
                } else {
                    $comp_status = 1;
                }
                $device_id      = $id;
                $voltage        = $comp;
                $temperature    = $temp;
                $humidity       = NULL;
                $status         = $status;

                $saveData = TemperatureDeviceData::create([
                    'dev_id'        => $deviceInfo->device_id,
                    'vehicle_id'    => $vehicleInfo->vehicle_id,
                    'device_id'     => $device_id,
                    'voltage'       => $voltage,
                    'temperature'   => $temperature,
                    'humidity'      => $humidity,
                    'comp_status'   => $comp_status,
                    'status'        => $status,
                    'created_at'    => $date
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
            } else {

                if ($comp == 0.00) {
                    $comp_status = 0;
                } else {
                    $comp_status = 1;
                }

                $device_id      = $id;
                $voltage        = $comp;
                $temperature    = $temp;
                $humidity       = NULL;
                $status         = $status;

                $saveData = TemperatureDeviceData::create([
                    'dev_id'        => 0,
                    'vehicle_id'    => 0,
                    'device_id'     => $device_id,
                    'voltage'       => $voltage,
                    'temperature'   => $temperature,
                    'humidity'      => $humidity,
                    'comp_status'   => $comp_status,
                    'status'        => $status,
                    'created_at'    => $date
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
        } else {
            $data = array(
                'status' => 304,
                'message' => 'Failed'
            );
            return response()->json($data);
        }
    }
}
