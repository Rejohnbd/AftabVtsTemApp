<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';
    protected $primaryKey = 'maintenance_id';
    protected $guarded = [];

    public function maintenanceTypeName()
    {
        return $this->belongsTo(MaintenanceType::class, 'maintenance_type_id', 'maintenance_type_id');
    }

    public function vehicleName()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id');
    }
}
