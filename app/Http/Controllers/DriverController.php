<?php

namespace App\Http\Controllers;

use App\Http\Requests\Driver\StoreDriverRequest;
use App\Http\Requests\Driver\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\Trip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Driver::all();
        return view('admin.pages.driver.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverRequest $request)
    {
        $newUser = User::create([
            'type'      => 'driver',
            'email'     => $request->driver_email,
            'password'  => Hash::make($request->driver_password)
        ]);

        $newDriver = new Driver;
        $newDriver->driver_user_id      = $newUser->id;
        $newDriver->driver_first_name   = $request->driver_first_name;
        $newDriver->driver_last_name    = $request->driver_last_name;
        $newDriver->driver_NID          = $request->driver_NID;
        $newDriver->driver_license      = $request->driver_license;
        $newDriver->driver_mobile       = $request->driver_mobile;
        $newDriver->driver_mobile_opt   = $request->driver_mobile_opt;
        $newDriver->driver_gender       = $request->driver_gender;
        $newDriver->driver_address      = $request->driver_address;
        $newDriver->driver_join_date    = date('Y-m-d', strtotime($request->driver_join_date));
        $newDriver->status              = $request->status;
        // driver Photo
        $currentDate = date('Y_m_d_H_i');
        $file = $request->file('driver_photo');
        $orginalName = $request->file('driver_photo')->getClientOriginalName();
        $driverPhoto = $currentDate . '_' . $orginalName;
        $file->move(storage_path('/app/public/users/drivers') . '/', $currentDate . '_' . $orginalName);
        $newDriver->driver_photo    = $driverPhoto;
        $saveNewDriver = $newDriver->save();

        if ($saveNewDriver) {
            session()->flash('success', 'Driver Added Successfully');
            return redirect()->route('drivers.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('drivers.index');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        return view('admin.pages.driver.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        // dd($request->all());
        $findUserEmail = User::select('email')->where('id', $driver->driver_user_id)->first();
        if ($request->driver_email != $findUserEmail->email) {
            // Need Work after Discusss with Jami Sir
        }

        $updateDriver = false;

        $updateDriver = $driver->update([
            'driver_first_name' => $request->driver_first_name,
            'driver_last_name'  => $request->driver_last_name,
            'driver_NID'        => $request->driver_NID,
            'driver_license'    => $request->driver_license,
            'driver_mobile'     => $request->driver_mobile,
            'driver_mobile_opt' => $request->driver_mobile_opt,
            'driver_gender'     => $request->driver_gender,
            'driver_join_date'  => date('Y-m-d', strtotime($request->driver_join_date)),
            'driver_address'    => $request->driver_address,
            'status'            => $request->status,
        ]);

        if ($request->hasFile('driver_photo')) {
            $currentDate = date('Y_m_d_H_i');
            $file = $request->file('driver_photo');
            $orginalName = $request->file('driver_photo')->getClientOriginalName();
            $driverPhoto = $currentDate . '_' . $orginalName;
            $file->move(storage_path('/app/public/users/drivers') . '/', $currentDate . '_' . $orginalName);
            $updateDriver = $driver->update([
                'driver_photo'  => $driverPhoto
            ]);
        }

        if ($updateDriver) {
            session()->flash('success', 'Driver Updated Successfully');
            return redirect()->route('drivers.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('drivers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }

    public function destroyDriver(Request $request)
    {
        $driverInfo =  Driver::findOrFail($request->driverId);
        if (Trip::where('driver_user_id', $driverInfo->driver_user_id)->count() > 0) {
            return response(['result' => false]);
        } else {
            Driver::where('driver_id', $request->driverId)->delete();
            return response(['result' => true]);
        }
    }
}
