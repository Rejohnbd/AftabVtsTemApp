@extends('layouts.admin-master')

@section('title', 'Create Expenses')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Create Expenses</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Expenses</h3>
                    </div>
                    <div class="card-body">
                        <form id="expensesAddForm" method="POST" action="javascript:void(0)">
                            @csrf
                            <div id="errorResult"></div>
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Expense Category</label>
                                        <select id="expenseCategory" name="expense_category" class="form-control @error('expense_category') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            <option value="general">General</option>
                                            <option value="trip">Trip</option>
                                        </select>
                                        @error('expense_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 select-trip">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Trip</label>
                                        <select id="tripChange" name="trip_id" class="form-control @error('trip_id') is-invalid @enderror select2-show-search" data-placeholder="Choose one" required>
                                            <option value="0">Choose one</option>
                                            @foreach($allTrip as $trip)
                                            <option value="{{ $trip->trip_id }}"> {{ findVehicleById($trip->vehicle_id) }}
                                                -::- {{ $trip->trip_from }} to {{ $trip->trip_to }}
                                                -::- Trip Date: {{ date('d/m/Y', strtotime($trip->trip_date)) }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('trip_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 select-vehicle">
                                    <div class="form-group">
                                        <label class="form-label mt-0">Select Vehicle</label>
                                        <select name="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                            <option label="Choose one" value="0"></option>
                                            @foreach($allVehicles as $vehicle)
                                            <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vehicle_plate_number  }}</option>
                                            @endforeach
                                        </select>
                                        @error('expense_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="addExpenses">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Expenses Type</label>
                                            <select name="expense_type_id[]" class="form-control @error('expense_type_id') is-invalid @enderror select2 custom-select" data-placeholder="Choose one" required>
                                                <option label="Choose one"></option>
                                                @foreach($allExpensesType as $expensesType)
                                                <option value="{{ $expensesType->expense_type_id }}">{{ $expensesType->expense_type_name }}</option>
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
                                            <input type="number" class="form-control @error('expense_amount') is-invalid @enderror" name="expense_amount[]" placeholder="Expenses Amount" value="{{ old('expense_amount[]') }}" required>
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
                                                </div><input class="form-control fc-datepicker" name="expense_date[]" value="{{ old('expense_date[]') }}" placeholder="MM/DD/YYYY" type="date" required>
                                            </div>
                                            @error('expense_date')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex  justify-content-end">
                                    <div class="btn-list ">
                                        <button type="button" id="btnAddExpense" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add More Expenses"><i class="fa fa-plus"></i></button>
                                        <!-- <button type="button" id="btnRemoveExpense" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove One"><i class="fe fe-trash"></i></button> -->
                                    </div>
                                </div>
                            </div>

                            <div id="newExpense">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <div class="form-group">
                                            <label class="form-label mt-0">Expenses Description</label>
                                            <textarea class="form-control  @error('expense_description') is-invalid @enderror" name="expense_description" rows="4" placeholder="Expenses Description" required>{{ old('expense_description') }}</textarea>
                                            @error('expense_description')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Save Expenses</button>
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
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.select2-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.select-trip').hide();
        $('.select-vehicle').hide();

        $('#expenseCategory').on('change', function() {
            if (this.value === 'general') {
                $('.select-trip').hide();
                $('.select-vehicle').show();
            } else if (this.value === 'trip') {
                $('.select-trip').show();
                $('.select-vehicle').hide();
            } else {
                $('.select-trip').hide();
                $('.select-vehicle').hide();
            }
        });

        $('#btnAddExpense').on('click', function() {
            $('.addExpenses').clone().appendTo('#newExpense').removeClass('addExpenses').append("<button type='button' class='btn btn-icon btn-danger rmv-div' data-toggle='tooltip' data-placement='top' data-original-title='Remove One'><i class='fe fe-trash'></i></button>");
        });

        $('#newExpense').on('click', '.rmv-div', function() {
            console.log('clicked')
            $(this).parent().remove()
        })

        $('#btnRemoveExpense').on('click', function() {
            $('#newExpense > div').last().remove();
        });
        // Add for temporary
        $('#tripChange').on('change', function() {
            let tripId = this.value;
            if (tripId == 0) {
                Swal.fire({
                    title: "Alert",
                    text: "Please Select Proper Trip",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                console.log(tripId)
                $.ajax({
                    method: 'POST',
                    url: "{{ route('all-expenses-check-expense') }}",
                    data: {
                        tripId: tripId,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        if (response.result) {
                            window.location.href = response.url;
                            Swal.fire({
                                title: "Alert",
                                text: "This Trip Already Added Expenses",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    }
                });
            }
        });

        $('#expensesAddForm').submit(function() {
            $('.alert-danger').hide();
            $('.alert-danger').html('');
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('all-expenses.store') }}",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    console.log(response.status)
                    if (response.status === 200) {
                        Swal.fire('Congratulations!', "Expenses Added Successfully", 'success');
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