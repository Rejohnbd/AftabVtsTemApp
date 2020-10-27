<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $table = 'vehicle_types';
    protected $primaryKey = 'vehicle_type_id';
    protected $guarded = [];
}
