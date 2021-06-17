<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripBill\StoreTripBillRequest;
use App\Models\Trip;
use App\Models\TripBill;
use Illuminate\Http\Request;

class TripBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TripBill::orderBy('bill_id', 'desc')->paginate(10);
        return view('admin.pages.trip-bill.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Trip::orderBy('created_at', 'desc')->where('trip_status', 3)->get();
        return view('admin.pages.trip-bill.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripBillRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TripBill  $tripBill
     * @return \Illuminate\Http\Response
     */
    public function show(TripBill $tripBill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TripBill  $tripBill
     * @return \Illuminate\Http\Response
     */
    public function edit(TripBill $tripBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TripBill  $tripBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TripBill $tripBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TripBill  $tripBill
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripBill $tripBill)
    {
        //
    }

    public function getTripInfo(Request $request )
    {
        $data = Trip::where('trip_id', $request->tripId)->first();
        // dd($data);
        return response()->view('admin.pages.trip-bill.trip-info', compact('data'));
    }
}
