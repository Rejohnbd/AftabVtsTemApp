<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripBill extends Model
{
    protected $table = 'trip_bills';
    protected $primaryKey = 'bill_id';
    protected $guarded = [];                                        
}
