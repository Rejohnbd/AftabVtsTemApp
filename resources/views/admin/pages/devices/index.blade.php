@extends('layouts.admin-master')

@section('title', 'All Device')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">All Device List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('devices.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Device
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Device</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Device Type</th>
                                    <th>Device Id</th>
                                    <th>Device Model</th>
                                    <th>SIM Number</th>
                                    <th>SIM Type</th>
                                    <th>Device Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allDevices as $device)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $device->deviceType->device_type_name }}</td>
                                    <td>{{ $device->device_unique_id }}</td>
                                    <td>{{ $device->device_model }}</td>
                                    <td>{{ $device->device_sim_number }}</td>
                                    <td>{{ strtoupper($device->device_sim_type) }}</td>
                                    <td>@if($device->status == 1) Active @else Intactive @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('devices.edit', $device->device_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Device"><i class="fe fe-edit"></i></a>
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Device"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="7" class="text-center">No Device Added Now.</th>
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