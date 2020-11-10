@extends('layouts.admin-master')

@section('title', 'Assign Device List')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Assign Device List</li>
            </ol>
            {{-- <div class="ml-auto">
                <a href="{{ route('expenses-type.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
            <span>
                <i class="fe fe-plus"></i>
            </span> Add Expenses Type
            </a>
        </div> --}}
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Assign Device Table</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Vehicle Registration No.</th>
                                <th>Device Unique Id</th>
                                <th>Device Type</th>
                                <th>Assign Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datas as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->vehicle->vehicle_plate_number }}</td>
                                <td>{{ $data->device->device_unique_id }}</td>
                                <td>{{ $data->findUsedDeviceType($data->device->device_type_id) }}</td>
                                <td>{{ date('d/m/Y', strtotime($data->device_assign_date)) }}</td>
                                <td>@if($data->status == 1) {{ 'Active' }} @else {{ 'Inactive' }} @endif</td>
                                <td>
                                    <div class="btn-list">
                                        @if($data->findUsedDeviceType($data->device->device_type_id) == 'VTS Device')
                                        <a href="{{ route('device-location',$data->device->device_id) }}" class="btn btn-icon btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Vehicle Location"><i class="fa fa-map-marker"></i></a>
                                        @else
                                        <a href="{{ route('device-temp-data', $data->device->device_id) }}" class="btn btn-icon btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Device Tempareture Info"><i class="wi wi-thermometer"></i></a>
                                        @endif
                                        {{-- <a href="{{ route('vehicle-device-edit', $data->vehicle_device_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Vehicle"><i class="fe fe-edit"></i></a>
                                        <button type="button" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Vehicle Device"><i class="fe fe-trash"></i></button> --}}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="4" class="text-center">No Expenses Added Now.</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/sweet-alert/sweetalert.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('plugins/sweet-alert/sweetalert.min.js') }}"></script>
@if(session('success'))
<script>
    $(document).ready(function() {
        swal('Congratulations!', "{{ session('success') }}", 'success');
    });
</script>
@endif
@if(session('error'))
<script>
    $(document).ready(function() {
        swal({
            title: "Alert",
            text: "{{ session('error') }}",
            type: "error",
            showCancelButton: true,
            confirmButtonText: 'Exit',
            cancelButtonText: 'Stay on the page'
        });
    });
</script>
@endif
@endsection