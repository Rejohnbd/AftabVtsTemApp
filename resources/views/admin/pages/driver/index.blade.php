@extends('layouts.admin-master')

@section('title', 'All Driver')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">All Driver List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Driver
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Driver</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Driver Name</th>
                                    <th>Driver Email</th>
                                    <th>Driver License</th>
                                    <th>Driver Mobile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="driverId-{{ $data->driver_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->driver_first_name }} {{ $data->driver_last_name }}</td>
                                    <td>{{ $data->user->email }}</td>
                                    <td>{{ $data->driver_license }}</td>
                                    <td>{{ $data->driver_mobile }}, {{ $data->driver_mobile_opt }}</td>
                                    <td>@if($data->status == 1) Active @else Intactive @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Driver Details"><i class="fa fa-eye"></i></button>
                                            <a href="{{ route('drivers.edit', $data->driver_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Driver"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{ $data->driver_id }}" class="btn btn-icon btn-danger btn-sm delete-driver" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Driver"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="7" class="text-center">No Driver Added Now.</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
        $('.delete-driver').on('click', function() {
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
                        url: "{{ url('driver-delete') }}",
                        method: 'POST',
                        data: {
                            driverId: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function(response) {
                            // $('#videoId-' + id).remove();
                            console.log(response.response);
                            if (response.result) {
                                $('#driverId-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Driver Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            if (!response.result) {
                                Swal.fire({
                                    title: "Alert",
                                    text: "This Driver Info Used in System",
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
    });
</script>
@endsection