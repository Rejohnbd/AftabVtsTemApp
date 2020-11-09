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
}
