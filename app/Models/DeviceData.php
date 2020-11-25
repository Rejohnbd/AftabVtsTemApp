<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{
    protected $table = 'device_data';
    protected $primaryKey = 'data_id';
    protected $guarded = [];

    public function findDeviceIdFromApi($imei)
    {
        $deviceInfo = Device::select('device_id')->where('device_unique_id', $imei)->first();
        return $deviceInfo->device_id;
    }

    public function findVehicleIdFromApi($deviceId)
    {
        $vehicleInfo = VehicleDevice::select('vehicle_id')->where('device_id', $deviceId)->first();
        return $vehicleInfo->vehicle_id;
    }

    public function findVehicleKplByDeviceId($id)
    {
        $vehileInfo = VehicleDevice::select('vehicle_id')->where('device_id', $id)->first();
        $kpl =  Vehicle::select('vehicle_kpl')->where('vehicle_id', $vehileInfo->vehicle_id)->first();
        return $kpl->vehicle_kpl;
    }
}
