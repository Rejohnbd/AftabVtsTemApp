@extends('layouts.admin-master')

@section('title', 'Edit Maintenance')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Maintenance</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Maintenance</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('maintenance.update', $maintenance->maintenance_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Maintenance Type</label>
                                        <select name="maintenance_type_id" class="form-control @error('maintenance_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allActiveMaintenanceTypes as $maintenanceType)
                                            <option value="{{ $maintenanceType->maintenance_type_id }}" @if($maintenance->maintenance_type_id == $maintenanceType->maintenance_type_id) selected @endif >{{ $maintenanceType->maintenance_type_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('maintenance_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Vehicle</label>
                                        <select name="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one">
                                            <option label="Choose one"></option>
                                            @foreach($allVehicles as $vehicle)
                                            <option value="{{ $vehicle->vehicle_id }}" @if($maintenance->vehicle_id == $vehicle->vehicle_id) selected @endif>{{ $vehicle->vehicle_plate_number }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Maintenance Details</label>
                                            <textarea class="form-control  @error('maintenance_details') is-invalid @enderror" name="maintenance_details" rows="4" placeholder="Maintenance Details">{{ old('maintenance_details', $maintenance->maintenance_details) }}</textarea>
                                            @error('maintenance_details')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Maintenance Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="maintenance_date" value="{{ old('maintenance_date', date('m/d/Y', strtotime($maintenance->maintenance_date))) }}" placeholder="MM/DD/YYYY" type="text">
                                        </div>
                                        @error('maintenance_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Maintenance Next Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="maintenance_next_date" value="{{ old('maintenance_next_date', date('m/d/Y', strtotime($maintenance->maintenance_next_date))) }}" placeholder="MM/DD/YYYY" type="text">
                                        </div>
                                        @error('maintenance_next_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Update Maintenance</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('maintenance.index') }}" class="btn btn-warning btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/date-picker/date-picker.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('plugins/date-picker/date-picker.js') }}"></script>
<script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.fc-datepicker').datepicker({
            altFormat: "dd-mm-yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            changeYear: true,
            changeMonth: true
        });
    });
</script>
@endsection