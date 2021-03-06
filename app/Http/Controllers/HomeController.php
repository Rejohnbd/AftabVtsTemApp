<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        if (Auth::user()->type == 'super_admin') :
            return redirect()->route('all-vehicle-location');
        elseif (Auth::user()->type == 'expense_trip') :
            return redirect()->route('trips.index');
        elseif (Auth::user()->type == 'maintenance') :
            return redirect()->route('vehicles.index');
        elseif (Auth::user()->type == 'dashboard_report') :
            return redirect()->route('all-vehicle-location');
        else :
            return redirect()->route('driver-dashboard');
        endif;
    }
}
