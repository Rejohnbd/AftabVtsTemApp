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
