<?php

use Illuminate\Support\Facades\DB;

function countDeviceTypeStatus($status)
{
    return DB::table('device_types')->where('status', $status)->count();
}

function countVehicleTypeStatus($status)
{
    return DB::table('vehicle_types')->where('status', $status)->count();
}

function countExpensesTypeStatus($status)
{
    return DB::table('expense_types')->where('status', $status)->count();
}

function countDeviceStatus($status)
{
    return DB::table('devices')->where('status', $status)->count();
}

function countDriverStatus($status)
{
    return DB::table('drivers')->where('status', $status)->count();
}

function countHelperStatus($status)
{
    return DB::table('helpers')->where('status', $status)->count();
}

function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;
    $r = 6372.797; // mean radius of Earth in km 
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;
    //echo ' '.$km; 
    return $km;
}

function findVehicleAttachTemDevice($id)
{
    $deviceInfo = array();
    $vehicleDevices = DB::table('vehicle_devices')->select('device_id')->where('vehicle_id', $id)->get();
    for ($i = 0; $i < count($vehicleDevices); $i++) {
        $deviceId = DB::table('devices')->select('device_id')->where('device_type_id', 6)->where('device_id', $vehicleDevices[$i]->device_id)->first();
        if ($deviceId != null) {
            $deviceInfo = ['exist' => true, 'device_id' =>  $deviceId->device_id];
        }
    }
    return $deviceInfo;
}

function findVehicleAttachGpsDevice($id)
{
    $deviceInfo = array();
    $vehicleDevices = DB::table('vehicle_devices')->select('device_id')->where('vehicle_id', $id)->get();
    for ($i = 0; $i < count($vehicleDevices); $i++) {
        $deviceId = DB::table('devices')->select('device_id')->where('device_type_id', 5)->where('device_id', $vehicleDevices[$i]->device_id)->first();
        if ($deviceId != null) {
            $deviceInfo = ['exist' => true, 'device_id' =>  $deviceId->device_id];
        }
    }
    return $deviceInfo;
}

function findVehicleRegiNo($deviceId)
{
    $vehicleInfo = DB::table('vehicles')
        ->join('vehicle_devices', 'vehicle_devices.vehicle_id', '=', 'vehicles.vehicle_id')
        ->join('devices', 'devices.device_id', '=', 'vehicle_devices.device_id')
        ->where('devices.device_unique_id', $deviceId)
        ->select('vehicles.vehicle_plate_number', 'vehicles.vehicle_id')
        ->first();
    return $vehicleInfo;
}

function findVehicleById($id)
{
    $vehicleNumber = DB::table('vehicles')->select('vehicle_plate_number')->where('vehicle_id', $id)->first();
    return $vehicleNumber->vehicle_plate_number;
}

function findVehileForExpense($id)
{
    $vehicleId = DB::table('trips')->select('vehicle_id')->where('trip_id', $id)->first();
    $vehicleNumber = DB::table('vehicles')->select('vehicle_plate_number')->where('vehicle_id', $vehicleId->vehicle_id)->first();
    return $vehicleNumber->vehicle_plate_number;
}

function findDriverNameForTripReport($id)
{
    $driverName = DB::table('drivers')->select('driver_first_name', 'driver_last_name')->where('driver_user_id', $id)->first();
    return $driverName->driver_first_name . ' ' . $driverName->driver_last_name;
}

function findHelperNameForTripReport($id)
{
    $helpers = array();
    $ids = explode(',', $id);
    for ($i = 0; $i < count($ids); $i++) {
        $helper = DB::table('helpers')->select('helper_name')->where('helper_id', $ids[$i])->first();
        $helpers[$i] = $helper->helper_name;
    }
    return implode(',', $helpers);
}


function findTripDetailsForExpenseReport($id)
{
    $tripDetails = DB::table('trips')->select('trip_details')->where('trip_id', $id)->first();
    return $tripDetails->trip_details;
}

function findCompanyForExpenseReport($id)
{
    $tripCompany = DB::table('trips')->select('company_id')->where('trip_id', $id)->first();
    if (!is_null($tripCompany->company_id)) {
        $company = DB::table('companies')->select('company_name')->where('company_id', $tripCompany->company_id)->first();
        return $company->company_name;
    } else {
        return '';
    }
}

// function findHelperNameForTripInfo($ids)
// {
//     $helpers = array();
//     $helperIds = explode(',', $ids);
//     for ($i = 0; $i < count($helperIds); $i++) {
//         $helper = DB::table('helpers')->select('helper_name')->where('helper_id', $ids[$i])->first();
//         $helpers[$i] = $helper->helper_name;
//     }
//     return implode(',', $helpers);
// }

/**
 * method findVehicleLastGprsDataByVehicleId() use in map.index.blade.php 
 */
function findVehicleLastGprsDataByVehicleId($vehicleId)
{
    $lastGprsData =  DB::table('device_data')->orderBy('data_id', 'desc')->select('latitude', 'longitude', 'status', 'speed')->where('vehicle_id', $vehicleId)->first();
    return $lastGprsData;
}

function findLastTempHumidityDataByVehicleId($vehicleId)
{
    $tempDeviceInfo = DB::table('vehicle_devices')
        ->join('devices', 'vehicle_devices.device_id', '=', 'devices.device_id')
        ->where('vehicle_devices.vehicle_id', $vehicleId)
        ->where('device_type_id', 6)
        ->select('devices.device_id', 'devices.device_unique_id')
        ->first();

    $lastTempData = DB::table('temperature_device_data')->orderBy('id', 'desc')->select('temperature', 'humidity', 'comp_status')->where('device_id', $tempDeviceInfo->device_unique_id)->first();
    $tempData = array(
        'device_id' => $tempDeviceInfo->device_id,
        'temp'      => $lastTempData->temperature,
        'humidity'  => $lastTempData->humidity,
        'comp'      => $lastTempData->comp_status,
    );

    return $tempData;
}
