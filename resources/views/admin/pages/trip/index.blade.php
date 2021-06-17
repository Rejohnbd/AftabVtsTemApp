@extends('layouts.admin-master')

@section('title', 'Trip List')

@section('content')
<div class="container-fluid content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Trip List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('trips.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Trip
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trip List Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th width="2%">Sl.</th>
                                    <th width="5%">Trip Date</th>
                                    <th width="5%">Trip Type</th>
                                    <th width="5%">Vehicle Regi. No.</th>
                                    <th width="5%">Company Name</th>
                                    <th width="5%">Driver Name</th>
                                    <th width="5%">Helper Name</th>
                                    <th width="14%">Trip From</th>
                                    <th width="14%">Trip To</th>
                                    <th width="10%">Trip Details</th>
                                    <th width="5%">Start Time</th>
                                    <th width="5%">End Time</th>
                                    <th width="5%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="tripId-{{ $data->trip_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ date('d/m/Y', strtotime($data->trip_date)) }}</td>
                                    <td>@if($data->trip_type_id){{ $data->tripType->trip_type_name }}@endif</td>
                                    <td>{{ $data->vehicle->vehicle_plate_number }}</td>
                                    <td>@if($data->company_id){{ $data->company->company_name }}@endif</td>
                                    <td>{{ $data->driver->driver_first_name }} {{ $data->driver->driver_last_name }}</td>
                                    <td>
                                        <?php
                                        if ($data->helper_id) {
                                            $helperIds = explode(',', $data->helper_id);
                                            foreach ($helperIds as $helperId) {
                                                echo $allHelper[$helperId]->helper_name . ',<br/>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>{{ str_replace(',', ', ', $data->trip_from) }}</td>
                                    <td>{{ str_replace(',', ', ', $data->trip_to) }}</td>
                                    <td>{{ str_replace(',', ', ', $data->trip_details) }}</td>
                                    <td>@if($data->trip_start_datetime) {{ date('d/m/Y  H:i:s A', strtotime($data->trip_start_datetime)) }} @endif</td>
                                    <td>@if($data-> trip_end_datetime) {{ date('d/m/Y H:i:s A', strtotime($data->	trip_end_datetime)) }} @endif</td>
                                    <td>@if($data->trip_status == 1) Start @elseif($data->trip_status == 2) Started @elseif($data->trip_status == 3) Completed @else Wait for Start @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('trips.edit', $data->trip_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Trip"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{ $data->trip_id }}" class="btn btn-icon btn-danger btn-sm delete-trip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Trip"><i class="fe fe-trash"></i></button>
                                            @if($data->trip_start_kilometer === NULL)
                                            <button class="btn btn-icon btn-success btn-sm start-trip" data-toggle="modal" data-id="{{ $data->trip_id }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Trip Start">Start</button>
                                            @endif
                                            @if($data->trip_start_kilometer !== NULL && $data->trip_end_kilometer === NULL)
                                            <button class="btn btn-icon btn-danger btn-sm end-trip" data-toggle="modal" data-id="{{ $data->trip_id }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Trip Stop">Stop</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan=" 10" class="text-center">No Trips Added Now.</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="m-2 d-flex justify-content-center">
                        {!! $datas->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="startTripModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <input type="hidden" name="trip_id" value="">
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

<div class="modal fade" id="endTripModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <input type="hidden" name="trip_id" value="">
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
    $(document).ready(function() {
        $('.start-trip').on('click', function() {
            var tripId = $(this).data('id');
            $('#startTripModal').modal('show');
            $('#startTripModal input[name="trip_id"]').val(tripId)
        });

        $('#btnStartTrip').on('click', function() {
            $('#startTripErrorText').remove();
            $('input[name=trip_start_kilometer]').removeClass('is-invalid');
            if (!$('input[name=trip_start_kilometer]').val()) {
                $('input[name=trip_start_kilometer]').addClass('is-invalid');
                $('.start-km').append('<strong id="startTripErrorText">Please Give Trip Start Kilometer</strong>');
            } else {
                var tripId = $('#startTripModal input[name=trip_id]').val();
                var tripStartKm = $('input[name=trip_start_kilometer]').val();
                $.ajax({
                    url: "{{ url('admin-trip-start') }}",
                    method: 'POST',
                    data: {
                        tripId: tripId,
                        tripStartKm: tripStartKm,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        if (response.result) {
                            $('#startTripModal').modal({
                                show: false
                            });
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

        $('.end-trip').on('click', function() {
            var tripId = $(this).data('id');
            $('#endTripModal').modal('show');
            $('#endTripModal input[name="trip_id"]').val(tripId)
        });

        $('#btnEndTrip').on('click', function() {
            $('#endTripErrorText').remove();
            $('input[name=trip_end_kilometer]').removeClass('is-invalid');
            if (!$('input[name=trip_end_kilometer]').val()) {
                $('input[name=trip_end_kilometer]').addClass('is-invalid');
                $('.end-km').append('<strong id="endTripErrorText">Please Give Trip End Kilometer</strong>');
            } else {
                var tripId = $('#endTripModal input[name=trip_id]').val();
                var tripEndkm = $('input[name=trip_end_kilometer]').val();
                $.ajax({
                    url: "{{ url('admin-trip-stop') }}",
                    method: 'POST',
                    data: {
                        tripId: tripId,
                        tripEndkm: tripEndkm,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        if (response.result) {
                            $('#endTripModal').modal({
                                show: false
                            });
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



        $('.delete-trip').on('click', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('trips-delete') }}",
                        method: 'POST',
                        data: {
                            tripId: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function(response) {
                            if (response.result) {
                                $('#tripId-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Trip Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            if (!response.result) {
                                Swal.fire({
                                    title: "Alert",
                                    text: "This Trip Info Used in System",
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
                    });
                }
            });
        });
    });
</script>
@endsection