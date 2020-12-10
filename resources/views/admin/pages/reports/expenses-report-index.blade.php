@extends('layouts.admin-master')

@section('title', 'Expenses Reports')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Expenses Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Expenses Report</h3>
                    <div class="card-options">
                        <div class="input-group">
                            <select class="form-control mr-2" id="expensesType">
                                <option value="" label="Choose Expense Type"></option>
                                @foreach($activeExpensesTypes as $expensesType)
                                <option value="{{ $expensesType->expense_type_id }}">{{ $expensesType->expense_type_name }}</option>
                                @endforeach
                            </select>
                            <input id="fromDate" data-provide="datepicker" type="text" class="form-control fc-datepicker mr-2" placeholder="From Date">
                            <input id="toDate" data-provide="datepicker" type="text" class="form-control fc-datepicker" placeholder="To Date">
                            <span class="input-group-btn ml-2">
                                <button id="btnExpensesReport" class="btn btn-sm btn-primary">
                                    <span class="fa fa-eye"></span>
                                </button>
                                <button id="btnEngineStatusReportDownload" class="btn btn-sm btn-primary">
                                    <span class="fa fa-download"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div id="expenseReportTable" class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#fromDate").flatpickr({
            dateFormat: "Y-m-d",
            minDate: "@if($firstRow){{ $firstRow->created_at->format('Y-m-d') }}@else today @endif",
            maxDate: "@if($lastRow){{ $lastRow->created_at->format('Y-m-d') }}@else today @endif"
        });
        $("#toDate").flatpickr({
            dateFormat: "Y-m-d",
            minDate: "@if($firstRow){{ $firstRow->created_at->format('Y-m-d') }}@else today @endif",
            maxDate: "@if($lastRow){{ $lastRow->created_at->format('Y-m-d') }}@else today @endif"
        });

        $('#btnExpensesReport').on('click', function() {
            var fromDate = null;
            var toDate = null;
            var expensesTypeId = null;
            $('#expensesType').removeClass('is-invalid');
            $('#fromDate').removeClass('is-invalid');
            $('#toDate').removeClass('is-invalid');

            $('#expensesType').on('change', function() {
                expensesTypeId = this.value;
            });

            if (!$("#expensesType").val()) {
                $('#expensesType').addClass('is-invalid');
            } else if (!$("#fromDate").val()) {
                $('#fromDate').addClass('is-invalid');
            } else if (!$("#toDate").val()) {
                $('#toDate').addClass('is-invalid');
            } else {
                fromDate = $("#fromDate").val();
                toDate = $("#toDate").val();
                expensesTypeId = $("#expensesType").val();

                $.ajax({
                    url: "{{ route('expenses-reports-by-expense-type') }}",
                    method: 'POST',
                    data: {
                        expensesTypeId: expensesTypeId,
                        fromDate: fromDate,
                        toDate: toDate,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        $('#expenseReportTable').html(response);
                    }
                })
            }

        });
    });
</script>
@endsection