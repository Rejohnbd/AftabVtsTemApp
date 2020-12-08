@extends('layouts.admin-master')

@section('title', 'Edit Expenses')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Expenses</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Expenses</h3>
                    </div>
                    <div class="card-body">
                        <form id="expensesUpdateForm" method="POST" action="javascript:void(0)">
                            @csrf

                            <div id="errorResult"></div>
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="expense_id" type="hidden" value="{{  $expenses->expense_id}}" />
                                        <label class="form-label mt-0">Select Trip</label>
                                        <select name="trip_id" class="form-control @error('trip_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach($allTrip as $trip)
                                            <option value="{{ $trip->trip_id }}" @if($expenses->trip_id == $trip->trip_id) selected @endif>{{ $trip->trip_from }} to {{ $trip->trip_to }} {{ date('d/m/Y', strtotime($trip->trip_date)) }}</option>
                                            @endforeach
                                        </select>
                                        @error('trip_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                @foreach($expensesItems as $key => $item)
                                @if($key == 0)
                                <div class="row addExpenses">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Expenses Type</label>
                                            <select name="expense_type_id[]" class="form-control @error('expense_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                                <option label="Choose one"></option>
                                                @foreach($allExpensesType as $expensesType)
                                                <option value="{{ $expensesType->expense_type_id }}" @if($item->expense_type_id == $expensesType->expense_type_id) selected @endif>{{ $expensesType->expense_type_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('expense_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Expenses Amount</label>
                                            <input type="number" class="form-control @error('expense_amount') is-invalid @enderror" name="expense_amount[]" placeholder="Expenses Amount" value="{{ old('expense_amount[]', $item->expense_amount) }}" required>
                                            @error('expense_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Expenses Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" name="expense_date[]" value="{{ old('expense_date[]', date('Y-m-d', strtotime($item->expense_date))) }}" placeholder="MM/DD/YYYY" type="date" required>
                                            </div>
                                            @error('expense_date')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div id="newExpense">
                                @foreach($expensesItems as $key => $item)
                                @if($key > 0)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Expenses Type</label>
                                            <select name="expense_type_id[]" class="form-control @error('expense_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                                <option label="Choose one"></option>
                                                @foreach($allExpensesType as $expensesType)
                                                <option value="{{ $expensesType->expense_type_id }}" @if($item->expense_type_id == $expensesType->expense_type_id) selected @endif>{{ $expensesType->expense_type_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('expense_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Expenses Amount</label>
                                            <input type="number" class="form-control @error('expense_amount') is-invalid @enderror" name="expense_amount[]" placeholder="Expenses Amount" value="{{ old('expense_amount[]', $item->expense_amount) }}" required>
                                            @error('expense_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Expenses Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" name="expense_date[]" value="{{ old('expense_date[]', date('Y-m-d', strtotime($item->expense_date))) }}" placeholder="MM/DD/YYYY" type="date" required>
                                            </div>
                                            @error('expense_date')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex  justify-content-end">
                                    <div class="btn-list ">
                                        <button type="button" id="btnAddExpense" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add More Expenses"><i class="fa fa-plus"></i></button>
                                        <button type="button" id="btnRemoveExpense" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove One"><i class="fe fe-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Expenses Description</label>
                                            <textarea class="form-control  @error('expense_description') is-invalid @enderror" name="expense_description" rows="4" placeholder="Expenses Description" required>{{ old('expense_description', $expenses->expense_description) }}</textarea>
                                            @error('expense_description')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Update Expenses</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('all-expenses.index') }}" class="btn btn-warning btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/sweet-alert/sweetalert.css') }}" />
<!-- <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" /> -->
<!-- <link rel="stylesheet" href="{{ asset('plugins/date-picker/date-picker.css') }}" /> -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- <script src="{{ asset('plugins/date-picker/date-picker.js') }}"></script> -->
<!-- <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script> -->
<!-- <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/select2.js') }}"></script> -->
<script>
    $(document).ready(function() {
        // $('.fc-datepicker').datepicker({
        //     altFormat: "dd-mm-yy",
        //     showOtherMonths: true,
        //     selectOtherMonths: true,
        //     changeYear: true,
        //     changeMonth: true
        // });

        $('#btnAddExpense').on('click', function() {
            $('.addExpenses').clone().appendTo('#newExpense').removeClass('addExpenses');
        });

        $('#btnRemoveExpense').on('click', function() {
            $('#newExpense > div').last().remove();
        });

        $('#expensesUpdateForm').submit(function() {
            $('.alert-danger').hide();
            $('.alert-danger').html('');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('all-expenses-update') }}",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    console.log(response)
                    if (response.status === 200) {
                        Swal.fire('Congratulations!', "Expenses Update Successfully", 'success');
                    }
                    if (response.status === 400) {
                        Swal.fire({
                            title: "Alert",
                            text: "Some Thing Happend wrong. Try Again.",
                            icon: "error",
                            showCancelButton: true,
                            confirmButtonText: 'Exit',
                            cancelButtonText: 'Stay on the page'
                        });
                    }
                    location.reload();
                },
                error: function(request) {
                    json = request.responseJSON.errors;
                    $.each(json, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append("<p style='margin-bottom: 5px'>" + value + '</p>');
                    });
                    $('#errorResult').html('');
                }
            })
        });
    });
</script>
@endsection