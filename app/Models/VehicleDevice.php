<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleDevice extends Model
{
    protected $table = 'vehicle_devices';
    protected $primaryKey = 'vehicle_device_id';
    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id', 'device_id');
    }

    public function findUsedDeviceType($deviceTypeId)
    {
        $deviceTypeName = DeviceType::select('device_type_name')->where('device_type_id', $deviceTypeId)->first();
        return $deviceTypeName->device_type_name;
    }
}
