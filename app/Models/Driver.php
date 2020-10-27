<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $primaryKey = 'driver_id';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'driver_user_id', 'id');
    }
}
