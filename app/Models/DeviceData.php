<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{
    protected $table = 'device_data';
    protected $primaryKey = 'data_id';
    protected $guarded = [];
}
