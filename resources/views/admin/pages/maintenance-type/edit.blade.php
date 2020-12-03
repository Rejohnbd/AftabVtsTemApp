@extends('layouts.admin-master')

@section('title', 'Update Maintenance Types')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Update Maintenance Type</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Maintenance Type</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('maintenance-type.update', $maintenanceType->maintenance_type_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Maintenance Type Name</label>
                                        <input type="text" class="form-control @error('maintenance_type_name') is-invalid @enderror" name="maintenance_type_name" placeholder="Maintenance Type Name" value="{{ old('maintenance_type_name', $maintenanceType->maintenance_type_name) }}" required>
                                        @error('maintenance_type_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Maintenance Type Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="1" @if($maintenanceType->staus == 1) selected @endif>Active</option>
                                            <option value="0" @if($maintenanceType->staus == 0) selected @endif>Inactive</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Update Maintenance Type</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('maintenance-type.index') }}" class="btn btn-warning btn-block">Cancel</a>
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