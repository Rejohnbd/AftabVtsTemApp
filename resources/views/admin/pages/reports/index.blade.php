@extends('layouts.admin-master')

@section('title', 'Vehicle Reports')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Report of: {{ $vehicleInfo->vehicle_plate_number}}</li>
            </ol>
            <div class="ml-auto">
                <a href="#" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-eye"></i>
                    </span> Temperature Info
                </a>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Select Report Type</h3>
                </div>
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <ul class="nav panel-tabs">
                                    <li><a href="#tab51" class="active" data-toggle="tab">Daily Report</a></li>
                                    <li><a href="#tab52" data-toggle="tab">Engine Status Reports</a></li>
                                    <li><a href="#tab53" data-toggle="tab">Monthly Reports</a></li>
                                    <li><a href="#tab54" data-toggle="tab">Expense Reports</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab51">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Show Distance Report by Date</h3>
                                            <div class="card-options">
                                                <div class="input-group">
                                                    <input id="dataDate" data-provide="datepicker" type="text" class="form-control fc-datepicker">
                                                    <span class="input-group-btn ml-2">
                                                        <button id="btnDailyReport" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-eye"></span>
                                                        </button>
                                                        <button id="btnDailyReportDownload" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-download"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="dailyReportTable" class="table-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab52">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Show Engine Status Report by Date</h3>
                                            <div class="card-options">
                                                <div class="input-group">
                                                    <input id="engineStatusDate" data-provide="datepicker" type="text" class="form-control fc-datepicker">
                                                    <span class="input-group-btn ml-2">
                                                        <button id="btnEngineStatusReport" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-eye"></span>
                                                        </button>
                                                        <button id="btnEngineStatusReportDownload" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-download"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="dailyEngineStatusTable" class="table-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab53">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Show Monthly Report</h3>
                                            <div class="card-options">
                                                <div class="input-group">
                                                    <input id="vehicleMonthly" data-provide="datepicker" type="text" class="form-control fc-datepicker">
                                                    <span class="input-group-btn ml-2">
                                                        <button id="vehicleMonthlyReport" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-eye"></span>
                                                        </button>
                                                        <button id="vehicleMonthlyReportDownload" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-download"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="vehicleMonthlyTable" class="table-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tab54">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Show Expense Report</h3>
                                            <div class="card-options">
                                                <div class="input-group">
                                                    <input data-provide="datepicker" type="text" class="form-control fc-datepicker">
                                                    <span class="input-group-btn ml-2">
                                                        <button class="btn btn-sm btn-primary">
                                                            <span class="fa fa-eye"></span>
                                                        </button>
                                                        <button class="btn btn-sm btn-primary">
                                                            <span class="fa fa-download"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script>
    $(document).ready(function() {
        //Daily Report Start Here
        $("#dataDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $vehicleInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });

        $('#btnDailyReport').on('click', function() {
            selectedDate = $("#dataDate").val();
            $.ajax({
                url: "{{ route('vehicle-daily-report') }}",
                method: 'POST',
                data: {
                    vehicleId: "{{ $vehicleInfo->vehicle_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    $('#dailyReportTable').html(response);
                }
            })
        });

        $('#btnDailyReportDownload').on('click', function() {
            selectedDate = $("#dataDate").val();
            $.ajax({
                url: "{{ route('vehicle-daily-report-download') }}",
                method: 'POST',
                data: {
                    vehicleId: "{{ $vehicleInfo->vehicle_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response, status, xhr) {
                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }
                    var linkelem = document.createElement('a');
                    try {
                        var blob = new Blob([response], {
                            type: 'application/octet-stream'
                        });
                        if (typeof window.navigator.msSaveBlob !== 'undefined') {
                            //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                            window.navigator.msSaveBlob(blob, filename);
                        } else {
                            var URL = window.URL || window.webkitURL;
                            var downloadUrl = URL.createObjectURL(blob);
                            if (filename) {
                                // use HTML5 a[download] attribute to specify filename
                                var a = document.createElement("a");
                                // safari doesn't support this yet
                                if (typeof a.download === 'undefined') {
                                    window.location = downloadUrl;
                                } else {
                                    a.href = downloadUrl;
                                    a.download = filename;
                                    document.body.appendChild(a);
                                    a.target = "_blank";
                                    a.click();
                                }
                            } else {
                                window.location = downloadUrl;
                            }
                        }
                    } catch (ex) {
                        console.log(ex);
                    }
                }
            })
        });

        // Engine Status Reports Here
        $("#engineStatusDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $vehicleInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });

        $('#btnEngineStatusReport').on('click', function() {
            selectedDate = $("#engineStatusDate").val();
            $.ajax({
                url: "{{ route('vehicle-daily-status-report') }}",
                method: 'POST',
                data: {
                    vehicleId: "{{ $vehicleInfo->vehicle_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    $('#dailyEngineStatusTable').html(response);
                }
            })
        });

        $('#btnEngineStatusReportDownload').on('click', function() {
            selectedDate = $("#engineStatusDate").val();
            $.ajax({
                url: "{{ route('vehicle-daily-status-report-download') }}",
                method: 'POST',
                data: {
                    vehicleId: "{{ $vehicleInfo->vehicle_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response, status, xhr) {
                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }
                    var linkelem = document.createElement('a');
                    try {
                        var blob = new Blob([response], {
                            type: 'application/octet-stream'
                        });
                        if (typeof window.navigator.msSaveBlob !== 'undefined') {
                            //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                            window.navigator.msSaveBlob(blob, filename);
                        } else {
                            var URL = window.URL || window.webkitURL;
                            var downloadUrl = URL.createObjectURL(blob);
                            if (filename) {
                                // use HTML5 a[download] attribute to specify filename
                                var a = document.createElement("a");
                                // safari doesn't support this yet
                                if (typeof a.download === 'undefined') {
                                    window.location = downloadUrl;
                                } else {
                                    a.href = downloadUrl;
                                    a.download = filename;
                                    document.body.appendChild(a);
                                    a.target = "_blank";
                                    a.click();
                                }
                            } else {
                                window.location = downloadUrl;
                            }
                        }
                    } catch (ex) {
                        console.log(ex);
                    }
                }
            })
        });

        // Monthly Reports Here
        $("#vehicleMonthly").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $vehicleInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });

        $('#vehicleMonthlyReport').on('click', function() {
            selectedDate = $("#vehicleMonthly").val();
            $.ajax({
                url: "{{ route('vehicle-monthly-report') }}",
                method: 'POST',
                data: {
                    vehicleId: "{{ $vehicleInfo->vehicle_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    $('#vehicleMonthlyTable').html(response);
                }
            })
        });

        $('#vehicleMonthlyReportDownload').on('click', function() {
            selectedDate = $("#vehicleMonthly").val();
            $.ajax({
                url: "{{ route('vehicle-monthly-report-download') }}",
                method: 'POST',
                data: {
                    vehicleId: "{{ $vehicleInfo->vehicle_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response, status, xhr) {
                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }
                    var linkelem = document.createElement('a');
                    try {
                        var blob = new Blob([response], {
                            type: 'application/octet-stream'
                        });
                        if (typeof window.navigator.msSaveBlob !== 'undefined') {
                            //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                            window.navigator.msSaveBlob(blob, filename);
                        } else {
                            var URL = window.URL || window.webkitURL;
                            var downloadUrl = URL.createObjectURL(blob);
                            if (filename) {
                                // use HTML5 a[download] attribute to specify filename
                                var a = document.createElement("a");
                                // safari doesn't support this yet
                                if (typeof a.download === 'undefined') {
                                    window.location = downloadUrl;
                                } else {
                                    a.href = downloadUrl;
                                    a.download = filename;
                                    document.body.appendChild(a);
                                    a.target = "_blank";
                                    a.click();
                                }
                            } else {
                                window.location = downloadUrl;
                            }
                        }
                    } catch (ex) {
                        console.log(ex);
                    }
                }
            })
        });
    })
</script>
@endsection