@extends('layouts.admin-master')

@section('title', 'Current Trip')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/driver-dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Current Trip</li>
            </ol>

        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trip Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Trip Date</th>
                                    <th>Vehicle No</th>
                                    <th>Vehicle Info</th>
                                    <th>Trip Start Location</th>
                                    <th>Trip End Location</th>
                                    <th>Trip Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($datas->trip_date)) }}</td>
                                    <td>{{ $vehicle_info->vehicle_plate_number }}</td>
                                    <td>{{ $vehicle_info->vehicle_brand }} {{ $vehicle_info->vehicle_model }} {{ $vehicle_info->vehicle_model_year }}</td>
                                    <td>{{ $datas->trip_from }}</td>
                                    <td>{{ $datas->trip_to }}</td>
                                    <td>{{ $datas->trip_details }}</td>
                                    <td>
                                        <div class="btn-list">
                                            {{-- <a href="{{ route('trip-start', $datas->trip_id) }}" class="btn btn-icon btn-success btn-sm @if($datas->trip_status == 2) disabled @endif" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start Trip">START</a>
                                            <a href="{{ route('trip-stop', $datas->trip_id) }}" class="btn btn-icon btn-danger btn-sm @if($datas->trip_status == 1) disabled @endif" data-toggle="tooltip" data-placement="top" title="" data-original-title="Stop Trip">STOP</a> --}}
                                            <button type="button" class="btn btn-icon btn-success btn-sm @if($datas->trip_status == 2) disabled @endif" @if($datas->trip_status == 1) data-toggle="modal" data-target="#startTripModal" @endif data-toggle="tooltip" data-placement="top" title="Start Trip" data-original-title="Start Trip">START</button>
                                            <button type="button" class="btn btn-icon btn-danger btn-sm @if($datas->trip_status == 1) disabled @endif" @if($datas->trip_status == 2) data-toggle="modal" data-target="#endTripModal" @endif data-toggle="tooltip" data-placement="top" title="End Trip" data-original-title="Stop Trip">STOP</button>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <th colspan="7" class="text-center">No Trip Added Now.</th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($datas != null)
<div class="modal fade" id="startTripModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Trip Start Kilometer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label">Trip Start Kilometer:</label>
                    <input type="hidden" name="trip_id" value="{{ $datas->trip_id }}">
                    <input type="number" class="form-control" name="trip_start_kilometer" required>
                    <span class="invalid-feedback start-km" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnStartTrip" type="submit" class="btn btn-success">Start</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="endTripModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Trip End Kilometer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label">Trip End Kilometer:</label>
                    <input type="hidden" name="trip_id" value="{{ $datas->trip_id }}">
                    <input type="number" class="form-control" name="trip_end_kilometer" required>
                    <span class="invalid-feedback end-km" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnEndTrip" type="submit" class="btn btn-success">Stop</button>
            </div>
        </div>
    </div>
</div>
@endif
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

<script>
    $(document).ready(function(){
        $('#btnStartTrip').on('click', function(){
            $('#startTripErrorText').remove();
            $('input[name=trip_start_kilometer]').removeClass('is-invalid');
            if(!$('input[name=trip_start_kilometer]').val()){
                $('input[name=trip_start_kilometer]').addClass('is-invalid');
                $('.start-km').append('<strong id="startTripErrorText">Please Give Trip Start Kilometer</strong>');
            } else {
                var tripId = $('input[name=trip_id]').val();
                var tripStartKm = $('input[name=trip_start_kilometer]').val();
                $.ajax({
                    url: "{{ url('trip-start') }}",
                    method: 'POST',
                    data: {
                        tripId: tripId,
                        tripStartKm: tripStartKm,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        if (response.result) {
                            $('#startTripModal').modal({show: false});
                            Swal.fire({
                                icon: 'success',
                                title: 'Trip Start Successfully',
                                showConfirmButton: false,
                                timer: 700
                            });
                            location.reload();
                        }
                        if (!response.result) {
                            Swal.fire({
                                title: "Alert",
                                text: "Something Happend Wrong",
                                icon: "error",
                                showCancelButton: true,
                                confirmButtonText: 'Exit',
                                cancelButtonText: 'Stay on the page'
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        });

        $('#btnEndTrip').on('click', function(){
            $('#endTripErrorText').remove();
            $('input[name=trip_end_kilometer]').removeClass('is-invalid');
            if(!$('input[name=trip_end_kilometer]').val()){
                $('input[name=trip_end_kilometer]').addClass('is-invalid');
                $('.end-km').append('<strong id="endTripErrorText">Please Give Trip End Kilometer</strong>');
            } else {
                var tripId = $('input[name=trip_id]').val();
                var tripEndkm = $('input[name=trip_end_kilometer]').val();
                $.ajax({
                    url: "{{ url('trip-stop') }}",
                    method: 'POST',
                    data: {
                        tripId: tripId,
                        tripEndkm: tripEndkm,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        if (response.result) {
                            $('#startTripModal').modal({show: false});
                            Swal.fire({
                                icon: 'success',
                                title: 'Trip End Successfully',
                                showConfirmButton: false,
                                timer: 700
                            });
                            location.reload();
                        }
                        if (!response.result) {
                            Swal.fire({
                                title: "Alert",
                                text: "Something Happend Wrong",
                                icon: "error",
                                showCancelButton: true,
                                confirmButtonText: 'Exit',
                                cancelButtonText: 'Stay on the page'
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        });


    });
</script>

@endsection