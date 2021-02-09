@extends('layouts.admin-master')

@section('title', 'Users List')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">User List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add User
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>User Email</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="UserId-{{ $data->id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->email }}</td>
                                    <td>@if($data->type == 'expense_trip') Expense/Trip @elseif($data->type == 'maintenance') Maintenance @elseif($data->type == 'dashboard_report') Dashboard/Report @else Super Admin @endif</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('users.edit', $data->id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit User"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{ $data->id }}" class="btn btn-icon btn-danger btn-sm delete-user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete User"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="4" class="text-center">No User Added Now.</th>
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
            type: "error",
            showCancelButton: true,
            confirmButtonText: 'Exit',
            cancelButtonText: 'Stay on the page'
        });
    });
</script>
@endif

<script>
    $(document).ready(function() {
        $('.delete-user').on('click', function() {
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
                        url: "{{ url('user-delete') }}",
                        method: 'POST',
                        data: {
                            userId: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function(response) {
                            if (response.result) {
                                $('#UserId-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'User Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            if (!response.result) {
                                Swal.fire({
                                    title: "Alert",
                                    text: "Something Happend Wrong! Try again",
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