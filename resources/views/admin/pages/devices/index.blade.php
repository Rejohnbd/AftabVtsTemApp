@extends('layouts.admin-master')

@section('title', 'All Device')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
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
                                <tr id="deviceId-{{$device->device_id}}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $device->deviceType->device_type_name }}</td>
                                    <td>{{ $device->device_unique_id }}</td>
                                    <td>{{ $device->device_model }}</td>
                                    <td>{{ $device->device_sim_number }}</td>
                                    <td>{{ strtoupper($device->device_sim_type) }}</td>
                                    <td>@if($device->status == 1) Active @else Intactive @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            @if($device->deviceType->device_type_id == 5)
                                            <a href="{{ route('device-location',$device->device_id) }}" class="btn btn-icon btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Device Location"><i class="fa fa-map-marker"></i></a>
                                            @else
                                            <a href="{{ route('device-temp-data', $device->device_id) }}" class="btn btn-icon btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Device Tempareture Info"><i class="wi wi-thermometer"></i></a>
                                            @endif
                                            <a href="{{ route('devices.edit', $device->device_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Device"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{$device->device_id}}" class="btn btn-icon btn-danger btn-sm delete-device" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Device"><i class="fe fe-trash"></i></button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@if(session('success'))
<script>
    $(document).ready(function() {
        Swal.fire('Congratulations!', "{{ session('success') }}", 'success');
    });
</script>
@endif

@if(session('error'))
<script>
    $(document).ready(function() {
        Swal.fire({
            title: "Alert",
            text: "{{ session('error') }}",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: 'Exit',
            cancelButtonText: 'Stay on the page'
        });
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('.delete-device').on('click', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('devices-delete') }}",
                        method: 'POST',
                        data: {
                            deviceId: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function(response) {
                            if (response.result) {
                                $('#deviceId-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Device Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            if (!response.result) {
                                Swal.fire({
                                    title: "Alert",
                                    text: "This Device Info Used in System",
                                    icon: "error",
                                    showCancelButton: true,
                                    confirmButtonText: 'Exit',
                                    cancelButtonText: 'Stay on the page'
                                });
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection