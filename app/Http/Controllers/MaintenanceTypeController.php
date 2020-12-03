<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceType\StoreMaintenanceTypeRequest;
use App\Http\Requests\MaintenanceType\UpdateMaintenanceTypeRequest;
use App\Models\MaintenanceType;
use Illuminate\Http\Request;

class MaintenanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = MaintenanceType::paginate(10);
        return view('admin.pages.maintenance-type.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.maintenance-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenanceTypeRequest $request)
    {
        $newMaintenanceType = new MaintenanceType();
        $newMaintenanceType->maintenance_type_name  = $request->maintenance_type_name;
        $newMaintenanceType->status                 = $request->status;
        $saveNewType = $newMaintenanceType->save();

        if ($saveNewType) {
            session()->flash('success', 'Maintenance Type Added Successfully');
            return redirect()->route('maintenance-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('maintenance-type.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function show(MaintenanceType $maintenanceType)
    {
    //    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenanceType $maintenanceType)
    {
        return view('admin.pages.maintenance-type.edit', compact('maintenanceType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenanceTypeRequest $request, MaintenanceType $maintenanceType)
    {
        $updateMaintenanceType = $maintenanceType->update([
            'maintenance_type_name' => $request->maintenance_type_name,
            'status' => $request->status,
        ]);

        if ($updateMaintenanceType) {
            session()->flash('success', 'Maintenance Type Updated Successfully');
            return redirect()->route('maintenance-type.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('maintenance-type.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceType $maintenanceType)
    {
        //
    }
}
