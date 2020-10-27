<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';
    protected $primaryKey = 'device_id';
    protected $guarded = [];

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id', 'device_type_id');
    }
}
