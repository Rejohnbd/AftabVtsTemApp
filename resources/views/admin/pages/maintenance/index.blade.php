@extends('layouts.admin-master')

@section('title', 'Maintenance List')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Maintenance List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('maintenance.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Maintenance
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Maintenance List Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Maintenance Type</th>
                                    <th>Vehicle Regi. No.</th>
                                    <th>Maintenance Date</th>
                                    <th>Maintenance Details</th>
                                    <th>Maintenance Next Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="tripId-{{ $data->maintenance_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->maintenanceTypeName->maintenance_type_name }}</td>
                                    <td>{{ $data->vehicleName->vehicle_plate_number }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->maintenance_date)) }}</td>
                                    <td>{{ $data->maintenance_details }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->maintenance_next_date)) }}</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('maintenance.edit', $data->maintenance_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Maintenance"><i class="fe fe-edit"></i></a>
                                            {{-- <button type="button" data-id="{{ $data->maintenance_id }}" class="btn btn-icon btn-danger btn-sm delete-trip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Maintenance"><i class="fe fe-trash"></i></button> --}}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="10" class="text-center">No Maintenance Added Now.</th>
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
        /*$('.delete-trip').on('click', function() {
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
        });*/
    });
</script>
@endsection