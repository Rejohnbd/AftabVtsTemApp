@extends('layouts.admin-master')

@section('title', 'Expenses List')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/driver-dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Expenses List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('driver-expenses-create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Expenses
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Expenses Table</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Expenses Type</th>
                                    <th>Trip Date</th>
                                    <th>Trip Location</th>
                                    <th>Expenses Description</th>
                                    <th>Expenses Amount</th>
                                    <th>Expenses Dated</th>
                                    <th>Expenses Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="expensesId-{{ $data->expense_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->expensesType->expense_type_name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->trip->trip_date)) }}</td>
                                    <td>{{ $data->trip->trip_from }} to {{ $data->trip->trip_to }}</td>
                                    <td>{{ $data->expense_description }}</td>
                                    <td>{{ $data->expense_amount }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->expense_date)) }}</td>
                                    <td>{{ ucfirst($data->user->type) }}</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('driver-expenses-edit', $data->expense_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Expenses"><i class="fe fe-edit"></i></a>
                                            <button type="button" data-id="{{ $data->expense_id }}" class="btn btn-icon btn-danger btn-sm delete-driver-expenses" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Expenses"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="9" class="text-center">No Expenses Added Now.</th>
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
        $('.delete-driver-expenses').on('click', function() {
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
                        url: "{{ url('driver-expenses-delete') }}",
                        method: 'POST',
                        data: {
                            expensesId: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function(response) {
                            if (response.result) {
                                $('#expensesId-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Expenses Deleted Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
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