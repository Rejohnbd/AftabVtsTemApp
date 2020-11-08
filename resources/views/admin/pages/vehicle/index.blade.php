@extends('layouts.admin-master')

@section('title', 'All Vehicle')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">All Vehicle List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Vehicle
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Vehicle</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Vehicle Type</th>
                                    <th>Vehicle Number</th>
                                    <th>Insurance Expire</th>
                                    <th>Registration Expire</th>
                                    <th>Tax Token Expire</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->vehicleType->vehicle_type_name }}</td>
                                    <td>{{ $data->vehicle_plate_number }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->vehicle_insurance_expire_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->vehicle_registration_expire_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->vehicle_tax_token_expire_date)) }}</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="" class="btn btn-icon btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Vehicle Location"><i class="fa fa-map-marker"></i></a>
                                            <a href="{{ route('vehicles.show', $data->vehicle_id) }}" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Vehicle Details"><i class="fa fa-eye"></i></a>
                                            {{-- <a href="{{ route('vehicle-device-create', $data->vehicle_id) }}" class="btn btn-icon btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Device To Vehicle"><i class="fa fa-plus"></i></a> --}}
                                            <a href="{{ route('vehicles.edit', $data->vehicle_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Vehicle"><i class="fe fe-edit"></i></a>
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Vehicle"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="6" class="text-center">No Vehicle Added Now.</th>
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