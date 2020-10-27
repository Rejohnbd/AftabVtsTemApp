@extends('layouts.admin-master')

@section('title', 'Edit Expenses')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
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
                        <form method="POST" action="{{ route('all-expenses.update', $expenses->expense_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="expense_id" value="{{ $expenses->expense_id }}">
                                        <label class="form-label mt-0">Select Expenses Type</label>
                                        <select name="expense_type_id" class="form-control @error('expense_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one">
                                            <option label="Choose one"></option>
                                            @foreach($allExpensesType as $expensesType)
                                            <option value="{{ $expensesType->expense_type_id }}" @if($expenses->expense_type_id == $expensesType->expense_type_id) selected @endif >{{ $expensesType->expense_type_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('expense_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Trip</label>
                                        <select name="trip_id" class="form-control @error('trip_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Expenses Amount</label>
                                        <input type="number" class="form-control @error('expense_amount') is-invalid @enderror" name="expense_amount" placeholder="Expenses Amount" value="{{ old('expense_amount', $expenses->expense_amount) }}">
                                        @error('expense_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Expenses Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div><input class="form-control fc-datepicker" name="expense_date" value="{{ old('expense_date', date('m/d/Y', strtotime($expenses->expense_date))) }}" placeholder="MM/DD/YYYY" type="text">
                                        </div>
                                        @error('expense_date')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Expenses Description</label>
                                            <textarea class="form-control  @error('expense_description') is-invalid @enderror" name="expense_description" rows="4" placeholder="Expenses Description">{{ old('expense_description', $expenses->expense_description) }}</textarea>
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
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/date-picker/date-picker.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('plugins/date-picker/date-picker.js') }}"></script>
<script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.fc-datepicker').datepicker({
            altFormat: "dd-mm-yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            changeYear: true,
            changeMonth: true
        });
    });
</script>
@endsection