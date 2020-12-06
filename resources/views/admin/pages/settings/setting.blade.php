@extends('layouts.admin-master')

@section('title', 'Settings')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Settings</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Settings</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Min Temperature</label>
                                        <input type="number" class="form-control @error('alert_min_temp') is-invalid @enderror" name="alert_min_temp" placeholder="Min Temperature" value="{{ old('alert_min_temp', $datas['alert_min_temp'] ) }}" required>
                                        @error('alert_min_temp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Max Temperature</label>
                                        <input type="number" class="form-control @error('alert_max_temp') is-invalid @enderror" name="alert_max_temp" placeholder="Max Temperature" value="{{ old('alert_max_temp', $datas['alert_max_temp']) }}" required>
                                        @error('alert_max_temp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Min Humidity</label>
                                        <input type="number" class="form-control @error('alert_min_humidity') is-invalid @enderror" name="alert_min_humidity" placeholder="Min Humidity" value="{{ old('alert_min_humidity', $datas['alert_min_humidity']) }}" required>
                                        @error('alert_min_humidity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Max Humidity</label>
                                        <input type="number" class="form-control @error('alert_max_humidity') is-invalid @enderror" name="alert_max_humidity" placeholder="Max Humidity" value="{{ old('alert_max_humidity', $datas['alert_max_humidity']) }}" required>
                                        @error('alert_max_humidity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Email From</label>
                                        <input type="email" class="form-control @error('email_from') is-invalid @enderror" name="email_from" placeholder="Email From" value="{{ old('alert_max_humidity', $datas['email_from']) }}" required>
                                        @error('email_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Notification Email</label>
                                            <textarea class="form-control  @error('notification_emails') is-invalid @enderror" name="notification_emails" rows="4" placeholder="Notification Email" required>{{ old('notification_emails', $datas['notification_emails']) }}</textarea>
                                            @error('notification_emails')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block">Update Settings</button>
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