@extends('layouts.admin-master')

@section('title', 'Create Driver')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Create Driver</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Driver </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('drivers.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver First Name</label>
                                        <input type="text" class="form-control @error('driver_first_name') is-invalid @enderror" name="driver_first_name" placeholder="Driver First Name" value="{{ old('driver_first_name') }}" required>
                                        @error('driver_first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Last Name</label>
                                        <input type="text" class="form-control @error('driver_last_name') is-invalid @enderror" name="driver_last_name" placeholder="Driver Last Name" value="{{ old('driver_last_name') }}" required>
                                        @error('driver_last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver NID</label>
                                        <input type="text" class="form-control @error('driver_NID') is-invalid @enderror" name="driver_NID" placeholder="Driver NID" value="{{ old('driver_NID') }}">
                                        @error('driver_NID')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driving License</label>
                                        <input type="text" class="form-control @error('driver_license') is-invalid @enderror" name="driver_license" placeholder="Driving License" value="{{ old('driver_license') }}">
                                        @error('driver_license')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Email</label>
                                        <input type="email" class="form-control @error('driver_email') is-invalid @enderror" name="driver_email" placeholder="Driver Email" value="{{ old('driver_email') }}" required>
                                        @error('driver_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Password</label>
                                        <input type="password" class="form-control @error('driver_password') is-invalid @enderror" name="driver_password" placeholder="Driving Password" value="{{ old('driver_password') }}" required>
                                        @error('driver_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Mobile</label>
                                        <input type="number" class="form-control @error('driver_mobile') is-invalid @enderror" name="driver_mobile" placeholder="Driver Mobile" value="{{ old('driver_mobile') }}" required>
                                        @error('driver_mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Mobile Optional</label>
                                        <input type="number" class="form-control @error('driver_mobile_opt') is-invalid @enderror" name="driver_mobile_opt" placeholder="Driving Mobile Optional" value="{{ old('driver_mobile_opt') }}">
                                        @error('driver_mobile_opt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Driver Gender</label>
                                            <select name="driver_gender" class="form-control @error('driver_gender') is-invalid @enderror select2 custom-select" data-placeholder="Choose one">
                                                <option label="Choose one"></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('driver_gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Join Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="driver_join_date" value="{{ old('driver_join_date') }}" placeholder="MM/DD/YYYY" type="text">
                                        </div>
                                        @error('driver_join_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Driver Address</label>
                                            <textarea class="form-control  @error('driver_address') is-invalid @enderror" name="driver_address" rows="4" placeholder="Driver Address">{{ old('driver_address') }}</textarea>
                                            @error('driver_address')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Driver Photo</label>
                                        <div class="input-group">
                                            <input type="file" name="driver_photo" accept=".jpeg,.jpg,.png" class="dropify" data-height="100"/>
                                        </div>
                                        @error('driver_photo')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Driver Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Save Driver</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('drivers.index') }}" class="btn btn-warning btn-block">Cancel</a>
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