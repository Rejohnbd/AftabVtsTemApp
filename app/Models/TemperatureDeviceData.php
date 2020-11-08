<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureDeviceData extends Model
{
    protected $table = 'temperature_device_data';
    protected $primaryKey = 'temp_id';
    protected $guarded = [];
}
