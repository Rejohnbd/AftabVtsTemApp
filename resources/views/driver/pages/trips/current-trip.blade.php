@extends('layouts.admin-master')

@section('title', 'Current Trip')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/driver-dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Current Trip</li>
            </ol>

        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trip Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Trip Date</th>
                                    <th>Vehicle No</th>
                                    <th>Vehicle Info</th>
                                    <th>Trip Start Location</th>
                                    <th>Trip End Location</th>
                                    <th>Trip Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($datas->trip_date)) }}</td>
                                    <td>{{ $vehicle_info->vehicle_plate_number }}</td>
                                    <td>{{ $vehicle_info->vehicle_brand }} {{ $vehicle_info->vehicle_model }} {{ $vehicle_info->vehicle_model_year }}</td>
                                    <td>{{ $datas->trip_from }}</td>
                                    <td>{{ $datas->trip_to }}</td>
                                    <td>{{ $datas->trip_details }}</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('trip-start', $datas->trip_id) }}" class="btn btn-icon btn-success btn-sm @if($datas->trip_status == 2) disabled @endif" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start Trip">START</a>
                                            <a href="{{ route('trip-stop', $datas->trip_id) }}" class="btn btn-icon btn-danger btn-sm @if($datas->trip_status == 1) disabled @endif" data-toggle="tooltip" data-placement="top" title="" data-original-title="Stop Trip">STOP</a>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <th colspan="7" class="text-center">No Trip Added Now.</th>
                                </tr>
                                @endif

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

@endsection