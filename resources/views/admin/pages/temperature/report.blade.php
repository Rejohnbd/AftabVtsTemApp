@extends('layouts.admin-master')

@section('title', $data['title'])

@section('content')
<div class="container content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">{{ $data['title'] }}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">Select Report Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input type="text" id="dataDate" data-provide="datepicker" name="driver_dob" class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required>
                                        <button id="btnShowData" class="btn btn-primary btn-icon">
                                            <div><i class="fa fa-eye"></i></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label">Select Start Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                                <input type="text" id="dataStartDate" data-provide="datepicker" class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label">Select End Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                                <input type="text" id="dataEndDate" data-provide="datepicker" class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Export Option:</label>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" id="excelExport" href="#">Excell Export</a>
                                                <a class="dropdown-item" href="#">Pdf Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="deviceDataTable">
                        @include('admin.pages.temperature.report-single')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection