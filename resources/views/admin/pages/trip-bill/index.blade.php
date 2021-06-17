@extends('layouts.admin-master')

@section('title', 'Trip Types')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Trip Bill List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('trip-bill.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Trip Bill
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trip Bill Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Trip Type Name</th>
                                    <th>Trip Type Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="TripTypeId-{{ $data->trip_type_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->trip_type_name }}</td>
                                    <td>@if($data->status == 1) {{ 'Active' }} @else {{ 'Inactive' }} @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('trip-type.edit', $data->trip_type_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Trip Type"><i class="fe fe-edit"></i></a>
                                            {{-- <button type="button" data-id="{{ $data->trip_type_id }}" class="btn btn-icon btn-danger btn-sm delete-device-type" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Trip Type"><i class="fe fe-trash"></i></button> --}}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="4" class="text-center">No Trip Bill Added Now.</th>
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