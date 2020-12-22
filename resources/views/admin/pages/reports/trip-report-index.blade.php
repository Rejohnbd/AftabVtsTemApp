@extends('layouts.admin-master')

@section('title', 'Trip Reports')

@section('content')
<div class="container-fluid  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Trip Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trip Report</h3>
                    <div class="card-options">
                        <div class="input-group">
                            <select class="form-control mr-2" id="vehicleId">
                                <option value="" label="Choose Vehicle"></option>
                                @foreach($allVehicle as $vehicle)
                                <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vehicle_plate_number }}</option>
                                @endforeach
                            </select>
                            <select class="form-control mr-2" id="tripType">
                                <option value="" label="Trip Type"></option>
                                @foreach($allTripTypes as $tripType)
                                <option value="{{ $tripType->trip_type_id }}">{{ $tripType->trip_type_name }}</option>
                                @endforeach
                            </select>
                            <select class="form-control mr-2" id="tripStatus">
                                <option value="" label="Trip Status"></option>
                                <option value="1">Yet to Start</option>
                                <option value="2">Started</option>
                                <option value="3">Completed</option>
                            </select>
                            <input id="fromDate" data-provide="datepicker" type="text" class="form-control fc-datepicker mr-2" placeholder="From Date">
                            <input id="toDate" data-provide="datepicker" type="text" class="form-control fc-datepicker" placeholder="To Date">
                            <span class="input-group-btn ml-2">
                                <button id="btnExpensesReport" class="btn btn-sm btn-primary">
                                    <span class="fa fa-eye"></span>
                                </button>
                                {{-- <button id="btnEngineStatusReportDownload" class="btn btn-sm btn-primary">
                                    <span class="fa fa-download"></span>
                                </button> --}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div id="expenseReportTable" class="table-responsive">
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
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#fromDate").flatpickr({
            dateFormat: "Y-m-d",
            minDate: "{{ $firstRow->created_at->format('Y-m-d') }}",
            maxDate: "{{ $lastRow->created_at->format('Y-m-d') }}"
        });
        $("#toDate").flatpickr({
            dateFormat: "Y-m-d",
            minDate: "{{ $firstRow->created_at->format('Y-m-d') }}",
            maxDate: "{{ $lastRow->created_at->format('Y-m-d') }}"
        });

        $('#btnExpensesReport').on('click', function() {
            var fromDate = null;
            var toDate = null;
            var vehicleId = null;
            var tripType = null;
            var tripStatus = null;
            // $('#vehicleId').removeClass('is-invalid');
            $('#fromDate').removeClass('is-invalid');
            $('#toDate').removeClass('is-invalid');

            $('#vehicleId').on('change', function() {
                vehicleId = this.value;
            });

            $('#tripType').on('change', function() {
                tripType = this.value;
            });

            $('#tripStatus').on('change', function() {
                tripStatus = this.value;
            });

            if (!$("#fromDate").val()) {
                $('#fromDate').addClass('is-invalid');
            } else if (!$("#toDate").val()) {
                $('#toDate').addClass('is-invalid');
            } else {
                fromDate = $("#fromDate").val();
                toDate = $("#toDate").val();
                vehicleId = $("#vehicleId").val();
                tripType = $("#tripType").val();
                tripStatus = $("#tripStatus").val();

                $.ajax({
                    url: "{{ route('trip-reports-by-vehicle') }}",
                    method: 'POST',
                    data: {
                        vehicleId: vehicleId,
                        fromDate: fromDate,
                        toDate: toDate,
                        tripType: tripType,
                        tripStatus: tripStatus,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        $('#expenseReportTable').html(response);
                    }
                })
            }

        });
    });
</script>
@endsection