@extends('layouts.admin-master')

@section('title', 'Create Device')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Create Device</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Device </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('devices.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Device Type</label>
                                        <select name="device_type_id" class="form-control @error('device_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allDeviceType as $deviceType)
                                            <option value="{{ $deviceType->device_type_id }}">{{ $deviceType->device_type_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('device_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Device Unique Id</label>
                                        <input type="text" class="form-control @error('device_unique_id') is-invalid @enderror" name="device_unique_id" placeholder="Device Unique Id" value="{{ old('device_unique_id') }}" required>
                                        @error('device_unique_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Device Model</label>
                                        <input type="text" class="form-control @error('device_model') is-invalid @enderror" name="device_model" placeholder="Device Model" value="{{ old('device_model') }}" required>
                                        @error('device_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Device SIM Number</label>
                                        <input type="number" class="form-control @error('device_sim_number') is-invalid @enderror" name="device_sim_number" placeholder="Device SIM Number" value="{{ old('device_sim_number') }}" required>
                                        @error('device_sim_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Device SIM Type</label>
                                        <select name="device_sim_type" class="form-control @error('device_sim_type') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="pre-paid">Pre-Paid</option>
                                            <option value="post-paid">Post-Paid</option>
                                        </select>
                                        @error('device_sim_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Device Status</label>
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
                                    <button type="submit" class="btn btn-success btn-block">Save Device</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('devices.index') }}" class="btn btn-warning btn-block">Cancel</a>
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
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
@endsection