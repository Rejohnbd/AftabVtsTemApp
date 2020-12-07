@extends('layouts.admin-master')

@section('title', 'Trip List')

@section('content')
<div class="container  content-area">
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
                        <table class="table card-table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Trip Date</th>
                                    <th>Vehicle Regi. No.</th>
                                    <th>Company Name</th>
                                    <th>Driver Name</th>
                                    <th>Helper Name</th>
                                    <th>Trip Location</th>
                                    <th>Trip Details</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="tripId-{{ $data->trip_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ date('d/m/Y', strtotime($data->trip_date)) }}</td>
                                    <td>{{ $data->vehicle->vehicle_plate_number }}</td>
                                    <td>@if($data->company_id){{ $data->company->company_name }}@endif</td>
                                    <td>{{ $data->driver->driver_first_name }} {{ $data->driver->driver_last_name }}</td>
                                    <td>
                                        <?php
                                        if ($data->helper_id) {
                                            $helperIds = explode(',', $data->helper_id);
                                            foreach ($helperIds as $helperId) {
                                                echo $allHelper[$helperId]->helper_name . '<br/>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $data->trip_from }} to {{ $data->trip_to }}</td>
                                    <td>{{ $data->trip_details }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>@if($data->trip_status == 1) Yet to Start @elseif($data->trip_status == 2) Started @else Completed @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('trips.edit', $data->trip_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Trip"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{ $data->trip_id }}" class="btn btn-icon btn-danger btn-sm delete-trip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Trip"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="10" class="text-center">No Trips Added Now.</th>
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