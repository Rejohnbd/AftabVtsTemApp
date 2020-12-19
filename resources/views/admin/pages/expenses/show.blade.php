@extends('layouts.admin-master')

@section('title', 'Expenses Details')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Expenses Details</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Expenses Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Trip Details</h5>
                                </div>
                                <div class="mt-2">
                                    <strong><span class="text-success">Trip Date :</span> {{ date('d/m/Y', strtotime($expense->trip->trip_date)) }}</strong><br />
                                    <strong class="mt-2"><span class="text-success">Trip Location :</span> {{ $expense->trip->trip_from }} <span class="text-success">To</span> {{ $expense->trip->trip_to }}</strong><br />
                                    <strong class="mt-2"><span class="text-success">Trip Status :</span> @if( $expense->trip->trip_status == 1) Yet To Start @elseif ($expense->trip->trip_status == 2) Started @else Completed @endif </strong><br />
                                    <strong class="mt-2"><span class="text-success">Trip Start Date Time :</span> @if($expense->trip->trip_start_datetime) {{ date('d/m/Y H:i:s A', strtotime($expense->trip->trip_start_datetime)) }} @else Not Found @endif <span class="text-success">To Trip End Date Time :</span> @if($expense->trip->trip_end_datetime) {{ date('d/m/Y H:i:s A', strtotime($expense->trip->trip_end_datetime)) }} @else Not Found @endif</strong><br />
                                    <strong class="mt-2"><span class="text-success">Trip Start Km :</span> @if($expense->trip->trip_start_kilometer) {{ $expense->trip->trip_start_kilometer }} @else Not Found @endif <span class="text-success">To Trip End Km :</span> @if($expense->trip->trip_end_kilometer) {{ $expense->trip->trip_end_kilometer }} @else Not Found @endif </strong><br />
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Expense Details</h5>
                                </div>
                                <div class="mt-2">
                                    <strong><span class="text-success">Expense Description :</span> {{ $expense->expense_description }}</strong><br />
                                    <strong class="mt-2"><span class="text-danger">Total Expense :</span> {{ $expense->total_expense_amount }}</strong><br />
                                    <strong class="mt-2"><span class="text-info"><u>Expense Item and Cost:</u></span> </strong> <br />
                                    @foreach($expenseItems as $item)
                                    <strong class="mt-2"><span class="text-danger">{{ $allExpenseTypes[$item->expense_type_id] }} :</span> {{ $item->expense_amount }} </strong><br />
                                    @endforeach
                                </div>
                            </a>


                        </div>
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
@endsection