@extends('layouts.admin-master')

@section('title', 'Dashboard')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
            </ol>
        </div>
    </div>
    @include('admin.pages.dashboard.all-type-info')
    @include('admin.pages.dashboard.all-info-summary')

</div>
@endsection