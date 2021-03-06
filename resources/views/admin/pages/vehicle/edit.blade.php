@extends('layouts.admin-master')

@section('title', 'Edit Vehicle')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Vehicle</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Vehicle </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicles.update', $vehicle->vehicle_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Company</label>
                                        <select name="company_id" class="form-control @error('company_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allCompanies as $company)
                                            <option value="{{ $company->company_id }}" @if($vehicle->company_id == $company->company_id) selected @endif>{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Vehicle Type</label>
                                        <select name="vehicle_type_id" class="form-control @error('vehicle_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allActiveVehicleType as $vehicleType)
                                            <option value="{{ $vehicleType->vehicle_type_id }}" @if($vehicle->vehicle_type_id == $vehicleType->vehicle_type_id ) selected @endif>{{ $vehicleType->vehicle_type_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle System Code</label>
                                        <input type="text" class="form-control" name="vehicle_system_code" placeholder="Vehicle System Code" value="{{ old('vehicle_system_code', $vehicle->vehicle_system_code) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label class="form-label mt-0">Vehicle Ownership Type</label>
                                        <select name="vehicle_ownership_type" class="form-control @error('vehicle_ownership_type') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="1" @if($vehicle->vehicle_ownership_type == 1) selected @endif>Own Vehicle</option>
                                            <option value="2" @if($vehicle->vehicle_ownership_type == 2) selected @endif>Rented Vehicle</option>
                                        </select>
                                        @error('vehicle_ownership_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Registration No</label>
                                        <input type="text" class="form-control @error('vehicle_plate_number') is-invalid @enderror" name="vehicle_plate_number" placeholder="Vehicle Registration No" value="{{ old('vehicle_plate_number', $vehicle->vehicle_plate_number) }}" required>
                                        @error('vehicle_plate_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Fuel Consumption(K.P.L)</label>
                                        <input type="text" class="form-control @error('vehicle_kpl') is-invalid @enderror" name="vehicle_kpl" placeholder="Fuel Consumption" value="{{ old('vehicle_kpl', $vehicle->vehicle_kpl) }}" required>
                                        @error('vehicle_kpl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Fuel Tank Capacity</label>
                                        <input type="number" class="form-control @error('vehicle_fuel_tank_capacity') is-invalid @enderror" name="vehicle_fuel_tank_capacity" placeholder="Vehicle Fuel Tank Capacity" value="{{ old('vehicle_fuel_tank_capacity', $vehicle->vehicle_fuel_tank_capacity) }}" >
                                        @error('vehicle_fuel_tank_capacity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Brand</label>
                                        <input type="text" class="form-control @error('vehicle_brand') is-invalid @enderror" name="vehicle_brand" placeholder="Vehicle Brand" value="{{ old('vehicle_brand', $vehicle->vehicle_brand) }}" required>
                                        @error('vehicle_brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Model</label>
                                        <input type="text" class="form-control @error('vehicle_model') is-invalid @enderror" name="vehicle_model" placeholder="Vehicle Model" value="{{ old('vehicle_model', $vehicle->vehicle_model) }}" required>
                                        @error('vehicle_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Model Year</label>
                                        <input type="number" class="form-control @error('vehicle_model_year') is-invalid @enderror" name="vehicle_model_year" placeholder="Vehicle Model Year" value="{{ old('vehicle_model_year', $vehicle->vehicle_model_year) }}" required>
                                        @error('vehicle_model_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Capacity</label>
                                        <input type="text" class="form-control" name="vehicle_capacity" placeholder="Vehicle Capacity" value="{{ old('vehicle_capacity', $vehicle->vehicle_capacity) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Measurement</label>
                                        <input type="text" class="form-control" name="vehicle_measurement" placeholder="Vehicle Measurement" value="{{ old('vehicle_measurement', $vehicle->vehicle_measurement) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Seat</label>
                                        <input type="text" class="form-control" name="vehicle_seats" placeholder="Vehicle Seats" value="{{ old('vehicle_seats', $vehicle->vehicle_seats) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Insurance Expire Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="vehicle_insurance_expire_date" value="{{ old('vehicle_insurance_expire_date', date('m/d/Y', strtotime($vehicle->vehicle_insurance_expire_date))) }}" placeholder="MM/DD/YYYY" type="text" required>
                                        </div>
                                        @error('vehicle_insurance_expire_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Registration Expire Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="vehicle_registration_expire_date" value="{{ old('vehicle_registration_expire_date', date('m/d/Y', strtotime($vehicle->vehicle_registration_expire_date))) }}" placeholder="MM/DD/YYYY" type="text" required>
                                        </div>
                                        @error('vehicle_registration_expire_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Tax Token Expire Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="vehicle_tax_token_expire_date" value="{{ old('vehicle_tax_token_expire_date', date('m/d/Y', strtotime($vehicle->vehicle_tax_token_expire_date))) }}" placeholder="MM/DD/YYYY" type="text" required>
                                        </div>
                                        @error('vehicle_tax_token_expire_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Update Vehicle</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('vehicles.index') }}" class="btn btn-warning btn-block">Cancel</a>
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
<link rel="stylesheet" href="{{ asset('plugins/fileupload/css/fileupload.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('plugins/date-picker/date-picker.js') }}"></script>
<script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('plugins/fileupload/js/fileupload.min.js') }}"></script>
<script src="{{ asset('plugins/fileupload/js/file-upload.js') }}"></script>
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