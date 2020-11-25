<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\VehicleDevice;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Vehicle::all();
        return view('admin.pages.vehicle.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allActiveVehicleType = VehicleType::where('status', 1)->get();
        $allCustomer = Customer::all();
        return view('admin.pages.vehicle.create')->with('allActiveVehicleType', $allActiveVehicleType)->with('allCustomer', $allCustomer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        $newVehicle = new Vehicle;
        $newVehicle->vehicle_type_id                    = $request->vehicle_type_id;
        $newVehicle->customer_user_id                   = $request->customer_user_id;
        $newVehicle->vehicle_plate_number               = $request->vehicle_plate_number;
        $newVehicle->vehicle_kpl                        = $request->vehicle_kpl;
        $newVehicle->vehicle_brand                      = $request->vehicle_brand;
        $newVehicle->vehicle_model                      = $request->vehicle_model;
        $newVehicle->vehicle_model_year                 = $request->vehicle_model_year;
        $newVehicle->vehicle_insurance_expire_date      = date('Y-m-d', strtotime($request->vehicle_insurance_expire_date));
        $newVehicle->vehicle_registration_expire_date   = date('Y-m-d', strtotime($request->vehicle_registration_expire_date));
        $newVehicle->vehicle_tax_token_expire_date      = date('Y-m-d', strtotime($request->vehicle_tax_token_expire_date));
        $saveNewVehicle = $newVehicle->save();

        if ($saveNewVehicle) {
            session()->flash('success', 'Vehicle Added Successfully');
            return redirect()->route('vehicles.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('vehicles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $usedDevice = VehicleDevice::where('vehicle_id', $vehicle->vehicle_id)->get();
        return view('admin.pages.vehicle.show')->with('vehicle', $vehicle)->with('usedDevice', $usedDevice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $allActiveVehicleType = VehicleType::where('status', 1)->get();
        $allCustomer = Customer::all();
        return view('admin.pages.vehicle.edit')->with('vehicle', $vehicle)->with('allActiveVehicleType', $allActiveVehicleType)->with('allCustomer', $allCustomer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $updateVehile = $vehicle->update([
            'vehicle_type_id'                    => $request->vehicle_type_id,
            'customer_user_id'                   => $request->customer_user_id,
            'vehicle_plate_number'               => $request->vehicle_plate_number,
            'vehicle_kpl'                        => $request->vehicle_kpl,
            'vehicle_brand'                      => $request->vehicle_brand,
            'vehicle_model'                      => $request->vehicle_model,
            'vehicle_model_year'                 => $request->vehicle_model_year,
            'vehicle_insurance_expire_date'      => date('Y-m-d', strtotime($request->vehicle_insurance_expire_date)),
            'vehicle_registration_expire_date'   => date('Y-m-d', strtotime($request->vehicle_registration_expire_date)),
            'vehicle_tax_token_expire_date'      => date('Y-m-d', strtotime($request->vehicle_tax_token_expire_date))
        ]);

        if ($updateVehile) {
            session()->flash('success', 'Vehicle Update Successfully');
            return redirect()->route('vehicles.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('vehicles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    public function destroyVehicle(Request $request)
    {
        if (VehicleDevice::where('vehicle_id', $request->vehicleId)->count() > 0) {
            return response(['result' => false]);
        } else {
            Vehicle::where('vehicle_id', $request->vehicleId)->delete();
            return response(['result' => true]);
        }
    }

    public function navReports()
    {
        $datas = Vehicle::all();
        return view('admin.pages.nav-reports.index', compact('datas'));
    }
}
