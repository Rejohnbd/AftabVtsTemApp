@extends('layouts.admin-master')

@section('title', 'Edit Helper')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Helper</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Helper</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('helpers.update', $helper->helper_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Helper Name</label>
                                        <input type="text" class="form-control @error('helper_name') is-invalid @enderror" name="helper_name" placeholder="Helper Name" value="{{ old('helper_name', $helper->helper_name) }}" required>
                                        @error('helper_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Helper NID</label>
                                        <input type="number" class="form-control @error('helper_NID') is-invalid @enderror" name="helper_NID" placeholder="Helper NID" value="{{ old('helper_NID', $helper->helper_NID) }}" required>
                                        @error('helper_NID')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Helper Age</label>
                                        <input type="number" class="form-control @error('helper_age') is-invalid @enderror" name="helper_age" placeholder="Helper Age" value="{{ old('helper_age', $helper->helper_age) }}" required>
                                        @error('helper_age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Helper Mobile</label>
                                        <input type="number" class="form-control @error('helper_mobile') is-invalid @enderror" name="helper_mobile" placeholder="Helper Mobile" value="{{ old('helper_mobile', $helper->helper_mobile) }}" required>
                                        @error('helper_mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Helper Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="1" @if($helper->status == 1) selected @endif>Active</option>
                                            <option value="0" @if($helper->status == 0) selected @endif>Inactive</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Update Helper</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('helpers.index') }}" class="btn btn-warning btn-block">Cancel</a>
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