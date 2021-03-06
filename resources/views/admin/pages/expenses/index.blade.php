@extends('layouts.admin-master')

@section('title', 'Expenses List')

@section('content')
<div class="container-fluid  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Expenses List</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('all-expenses.create') }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
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
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th width="5%">Sl.</th>
                                    <th width="5%">Expense Category</th>
                                    <th width="10%">Vehicle No</th>
                                    <th width="10%">Trip Date</th>
                                    <th width="30%">Trip Location</th>
                                    <th width="15%">Expenses Description</th>
                                    <th width="5%">Expenses Amount</th>
                                    <th width="5%">Expenses Added By</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $data)
                                <tr id="expensesId-{{ $data->expense_id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ ucfirst($data->expense_category) }}</td>
                                    <td>@if($data->trip_id) {{ findVehileForExpense($data->trip_id) }} @else {{ findVehicleById($data->vehicle_id) }} @endif</td>
                                    <td>@if($data->trip_id) {{ date('d/m/Y', strtotime($data->trip->trip_date)) }} @endif</td>
                                    <td>@if($data->trip_id) {{ str_replace(',', ', ', $data->trip->trip_from) }} to {{ str_replace(',', ', ', $data->trip->trip_to) }} @endif</td>
                                    <td>{{ $data->expense_description }}</td>
                                    <td>{{ $data->total_expense_amount }}</td>
                                    <td>{{ ucfirst($data->user->type) }}</td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('all-expenses.edit', $data->expense_id) }}" class="btn btn-icon btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Expenses"><i class="fe fe-edit"></i></a>
                                            <a href="{{ route('all-expenses-view', $data->expense_id) }}" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Expenses Details"><i class="fa fa-eye"></i></a>
                                            <button type="button" data-id="{{ $data->expense_id }}" class="btn btn-icon btn-danger btn-sm delete-all-expenses" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Expenses"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="7" class="text-center">No Expenses Added Now.</th>
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
        $('.delete-all-expenses').on('click', function() {
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
                        url: "{{ url('all-expenses-delete') }}",
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