<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\StoreSettingRequest;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = array_column(Settings::all()->toArray(), 'value', 'name');
        return view('admin.pages.settings.setting')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingRequest $request)
    {
        $datas = array_column(Settings::all()->toArray(), 'value', 'name');
        $diffResult = array_diff($request->all(), $datas);
        $updateSetting = false;
        foreach ($diffResult as $name => $value) {
            $result =  DB::table('settings')->where('name', $name)->update(['value' => $value]);
            if ($result) {
                $updateSetting = true;
            }
        }
        if ($updateSetting) {
            session()->flash('success', 'Setting Update Successfully');
            return redirect()->route('settings.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('settings.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
