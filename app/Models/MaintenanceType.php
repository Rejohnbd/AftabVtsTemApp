<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    protected $table = 'maintenance_types';
    protected $primaryKey = 'maintenance_type_id';
    protected $guarded = [];
}
