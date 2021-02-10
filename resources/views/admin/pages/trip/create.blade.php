@extends('layouts.admin-master')

@section('title', 'Create Trips')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Create Trips</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Trips</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('trips.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Trip Type</label>
                                        <select name="trip_type_id" class="form-control @error('trip_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allTripTypes as $tripType)
                                            <option value="{{ $tripType->trip_type_id}}">{{ $tripType->trip_type_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('trip_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Vehicle</label>
                                        <select name="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allFreeVehicle as $freeVehicle)
                                            <option value="{{ $freeVehicle->vehicle_id }}">{{ $freeVehicle->vehicle_plate_number }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Company</label>
                                        <select name="company_id" class="form-control @error('company_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allCompanies as $company)
                                            <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
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
                                        <label class="form-label mt-0">Select Driver</label>
                                        <select name="driver_user_id" class="form-control @error('driver_user_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allFreeDriver as $freeDriver)
                                            <option value="{{ $freeDriver->driver_user_id }}">{{ $freeDriver->driver_first_name }} {{ $freeDriver->driver_last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('driver_user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Helper</label>
                                        <select name="helper_id[]" class="form-control @error('driver_user_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" multiple>
                                            <option label="Choose one"></option>
                                            @foreach($allFreeHelper as $freeHelper)
                                            <option value="{{ $freeHelper->helper_id }}">{{ $freeHelper->helper_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('helper_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Trip From</label>
                                        <input type="text" class="form-control @error('trip_from') is-invalid @enderror" name="trip_from" placeholder="Trip From" value="{{ old('trip_from') }}" required>
                                        @error('trip_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Trips To</label>
                                        <input type="text" class="form-control @error('trip_to') is-invalid @enderror" name="trip_to" placeholder="Trips To" value="{{ old('trip_to') }}" required>
                                        @error('trip_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Trips Details</label>
                                            <textarea class="form-control  @error('trip_details') is-invalid @enderror" name="trip_details" rows="4" placeholder="Trips Details" required>{{ old('trip_details') }}</textarea>
                                            @error('trip_details')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Trips Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="trip_date" value="{{ old('trip_date') }}" placeholder="MM/DD/YYYY" type="text" required>
                                        </div>
                                        @error('trip_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Trip Status</label>
                                        <select name="trip_status" class="form-control @error('trip_status') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="0">Wait for Start</option>
                                            <option value="1">Start</option>
                                            <option value="2">Started</option>
                                            <option value="3">Completed</option>
                                        </select>
                                        @error('trip_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Save Trip</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('trips.index') }}" class="btn btn-warning btn-block">Cancel</a>
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