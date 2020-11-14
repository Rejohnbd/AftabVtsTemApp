@extends('layouts.admin-master')

@section('title', 'Device Types')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Device Type List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('device-type.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Device Type
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Device Type Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Device Type Name</th>
                                    <th>Device Type Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allDeviceType as $deviceType)
                                <tr id="deviceTypeId-{{ $deviceType->device_type_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $deviceType->device_type_name }}</td>
                                    <td>@if($deviceType->status == 1) {{ 'Active' }} @else {{ 'Inactive' }} @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('device-type.edit', $deviceType->device_type_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Device Type"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{ $deviceType->device_type_id }}" class="btn btn-icon btn-danger btn-sm delete-device-type" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Device Type"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="4" class="text-center">No Device Added Now.</th>
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

<script>
    $(document).ready(function() {
        $('.delete-device-type').on('click', function() {
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
                        url: "{{ url('device-type-delete') }}",
                        method: 'POST',
                        data: {
                            deviceTypeId: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function(response) {
                            if (response.result) {
                                $('#deviceTypeId-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Device Type Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            if (!response.result) {
                                Swal.fire({
                                    title: "Alert",
                                    text: "This Device Type Info Used in System",
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