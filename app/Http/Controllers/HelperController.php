<?php

namespace App\Http\Controllers;

use App\Http\Requests\Helper\StoreHelperRequest;
use App\Http\Requests\Helper\UpdateHelperRequest;
use App\Models\Helper;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Helper::all();
        return view('admin.pages.helper.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.helper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHelperRequest $request)
    {
        $newHelper = new Helper;
        $newHelper->helper_name     = $request->helper_name;
        $newHelper->helper_NID      = $request->helper_NID;
        $newHelper->helper_age      = $request->helper_age;
        $newHelper->helper_mobile   = $request->helper_mobile;
        $newHelper->status          = $request->status;
        $saveNewHelper = $newHelper->save();

        if ($saveNewHelper) {
            session()->flash('success', 'Helper Added Successfully');
            return redirect()->route('helpers.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('helpers.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Helper  $helper
     * @return \Illuminate\Http\Response
     */
    public function show(Helper $helper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Helper  $helper
     * @return \Illuminate\Http\Response
     */
    public function edit(Helper $helper)
    {
        return view('admin.pages.helper.edit', compact('helper'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Helper  $helper
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHelperRequest $request, Helper $helper)
    {
        $updateHelper = $helper->update([
            'helper_name'   => $request->helper_name,
            'helper_NID'    => $request->helper_NID,
            'helper_age'    => $request->helper_age,
            'helper_mobile' => $request->helper_mobile,
            'status'        => $request->status
        ]);

        if ($updateHelper) {
            session()->flash('success', 'Helper Updated Successfully');
            return redirect()->route('helpers.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('helpers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Helper  $helper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helper $helper)
    {
        //
    }
}
