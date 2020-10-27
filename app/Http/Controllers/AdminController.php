<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Driver;
use App\Models\ExpensesType;
use App\Models\Helper;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $allDeviceType  = DeviceType::all();
        $allVehicleType = VehicleType::all();
        $allExpenseType = ExpensesType::all();
        $allDevices = Device::all();
        $allVehicle = Vehicle::all();
        $allDrivers = Driver::all();
        $allHelper = Helper::all();
        return view('admin.pages.dashboard.dashboard')
            ->with('allDeviceType', $allDeviceType)
            ->with('allVehicleType', $allVehicleType)
            ->with('allExpenseType', $allExpenseType)
            ->with('allDevices', $allDevices)
            ->with('allVehicle', $allVehicle)
            ->with('allDrivers', $allDrivers)
            ->with('allHelper', $allHelper);
    }
}
