<?php

namespace App\Http\Controllers;

use App\Http\Requests\Maintenance\StoreMaintenaceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenaceRequest;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Maintenance::paginate(10);
        return view('admin.pages.maintenance.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allActiveMaintenanceTypes = MaintenanceType::where('status', 1)->get();
        $allVehicles = Vehicle::all();
        return view('admin.pages.maintenance.create')->with('allActiveMaintenanceTypes', $allActiveMaintenanceTypes)->with('allVehicles', $allVehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenaceRequest $request)
    {
        $newMaintenance = new Maintenance();
        $newMaintenance->maintenance_type_id    = $request->maintenance_type_id;
        $newMaintenance->vehicle_id             = $request->vehicle_id;
        $newMaintenance->maintenance_details    = $request->maintenance_details;
        $newMaintenance->maintenance_date       = date('Y-m-d', strtotime($request->maintenance_date));
        $newMaintenance->maintenance_next_date  = date('Y-m-d', strtotime($request->maintenance_next_date));
        $saveNewMaintenance = $newMaintenance->save();

        if ($saveNewMaintenance) {
            session()->flash('success', 'Maintenance Added Successfully');
            return redirect()->route('maintenance.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('maintenance.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        $allActiveMaintenanceTypes = MaintenanceType::where('status', 1)->get();
        $allVehicles = Vehicle::all();
        return view('admin.pages.maintenance.edit')
            ->with('maintenance', $maintenance)
            ->with('allActiveMaintenanceTypes', $allActiveMaintenanceTypes)
            ->with('allVehicles', $allVehicles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenaceRequest $request, Maintenance $maintenance)
    {
        $updateMaintenance = $maintenance->update([
            'maintenance_type_id'   => $request->maintenance_type_id,
            'vehicle_id'            => $request->vehicle_id,
            'maintenance_details'   => $request->maintenance_details,
            'maintenance_date'      => date('Y-m-d', strtotime($request->maintenance_date)),
            'maintenance_next_date' => date('Y-m-d', strtotime($request->maintenance_next_date))
        ]);

        if ($updateMaintenance) {
            session()->flash('success', 'Maintenance Updated Successfully');
            return redirect()->route('maintenance.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('maintenance.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }
}
