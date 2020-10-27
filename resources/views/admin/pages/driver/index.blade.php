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
                                <tr>
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
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Driver"><i class="fe fe-trash"></i></button>
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
<script src="{{ asset('plugins/sweet-alert/sweetalert.min.js') }}"></script>
@if(session('success'))
<script>
    $(document).ready(function() {
        swal('Congratulations!', "{{ session('success') }}", 'success');
    });
</script>
@endif

@if(session('error'))
<script>
    $(document).ready(function() {
        swal({
            title: "Alert",
            text: "{{ session('error') }}",
            type: "error",
            showCancelButton: true,
            confirmButtonText: 'Exit',
            cancelButtonText: 'Stay on the page'
        });
    });
</script>
@endif
@endsection