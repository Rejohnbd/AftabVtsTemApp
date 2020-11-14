<?php

use Illuminate\Support\Facades\DB;

function countDeviceTypeStatus($status)
{
    return DB::table('device_types')->where('status', $status)->count();
}

function countVehicleTypeStatus($status)
{
    return DB::table('vehicle_types')->where('status', $status)->count();
}

function countExpensesTypeStatus($status)
{
    return DB::table('expense_types')->where('status', $status)->count();
}

function countDeviceStatus($status)
{
    return DB::table('devices')->where('status', $status)->count();
}

function countDriverStatus($status)
{
    return DB::table('drivers')->where('status', $status)->count();
}

function countHelperStatus($status)
{
    return DB::table('helpers')->where('status', $status)->count();
}

function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;
    $r = 6372.797; // mean radius of Earth in km 
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;
    //echo ' '.$km; 
    return $km;
}


// function findTemp