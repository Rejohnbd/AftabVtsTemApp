@extends('layouts.admin-master')

@section('title', 'All Helper')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">All Helper List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('helpers.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Helper
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Helper</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Helper Name</th>
                                    <th>Helper NID</th>
                                    <th>Helper Age</th>
                                    <th>Helper Mobile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->helper_name }}</td>
                                    <td>{{ $data->helper_NID }}</td>
                                    <td>{{ $data->helper_age }}</td>
                                    <td>{{ $data->helper_mobile }}</td>
                                    <td>@if($data->status == 1) Active @else Intactive @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('helpers.edit', $data->helper_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Helper"><i class="fe fe-edit"></i></a>
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Helper"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="7" class="text-center">No Helper Added Now.</th>
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