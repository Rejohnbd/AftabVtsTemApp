@extends('layouts.admin-master')

@section('title', 'Vehicle Details')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">All Vehicle List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('vehicle-device-create', $vehicle->vehicle_id) }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Device
                </a>
            </div>
        </div>

        <div class="row" id="user-profile">
            <div class="col-lg-12">
                <div class="card">
                    <div class="border-top">
                        <div class="wideget-user-tab">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu1">
                                    <ul class="nav">
                                        <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Vehicle Infromation</a></li>
                                        <li><a href="#tab-61" data-toggle="tab" class="">Vehicle Devices</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="border-0">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tab-51">
                                    <div id="profile-log-switch">
                                        <div class="media-heading">
                                            <h5 class="text-uppercase"><strong>Customer Information</strong></h5>
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table row table-borderless">
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Customer Name :</strong> {{ $vehicle->customer->customer_first_name }} {{ $vehicle->customer->customer_last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Customer NID :</strong> {{ $vehicle->customer->customer_NID }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Customer Company :</strong> {{ $vehicle->customer->company_name }}</td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Customer Phone :</strong> {{ $vehicle->customer->customer_mobile }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Customer Address :</strong> {{ $vehicle->customer->customer_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Customer Join Date :</strong> {{ date('d/m/Y', strtotime($vehicle->customer->customer_join_date)) }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="media-heading mt-3">
                                            <h5 class="text-uppercase"><strong>Vehicle Information</strong></h5>
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table row table-borderless">
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Vehicle Brand :</strong> {{ $vehicle->vehicle_brand }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Vehicle Model :</strong> {{ $vehicle->vehicle_model }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Vehicle Model Year :</strong> {{ $vehicle->vehicle_model_year }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Vehice Fuel Consumption :</strong> {{ $vehicle->hourly_fuel_consumption }}</td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Insurance Expire Date :</strong> {{ date('d/m/Y', strtotime($vehicle->vehicle_insurance_expire_date)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Registration Expire Date :</strong> {{ date('d/m/Y', strtotime($vehicle->vehicle_registration_expire_date)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tax Token Expire Date :</strong> {{ date('d/m/Y', strtotime($vehicle->vehicle_tax_token_expire_date)) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-61">
                                    <ul class="widget-users row">
                                        @forelse($usedDevice as $device)
                                        <li class="col-lg-3  col-md-6 col-sm-12 col-12">
                                            <div class="card border-0">
                                                <div class="card-body text-center">
                                                    <h4 class="h4 mb-0 mt-3">{{ $device->device->device_model }}</h4>
                                                    <p class="card-text">{{ $device->device->device_unique_id }}</p>
                                                    <p class="card-text">{{ $device->device->device_sim_number }}</p>
                                                    <p class="card-text">{{ $device->device->device_sim_type }}</p>
                                                    @if($device->device->device_type_id == 5)
                                                    <a href="{{ route('vehicle-location', $vehicle->vehicle_id) }}" class="btn btn-primary btn-block">View GPS Data</a>
                                                    @else
                                                    <a href="{{ route('device-temp-data', $device->device->device_id) }}" class="btn btn-primary btn-block">View Temp Data</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <li class=" col-12">
                                            <div class="card border-0">
                                                <div class="card-body text-center">
                                                    <h4 class="h4 mb-0 mt-3">No Device Added Yet.</h4>
                                                </div>
                                            </div>
                                        </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection