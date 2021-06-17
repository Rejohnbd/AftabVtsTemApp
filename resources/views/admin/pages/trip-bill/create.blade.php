@extends('layouts.admin-master')

@section('title', 'Create Trip Types')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Create Trip Type</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Trip Bill</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('trip-bill.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    @error('chalan_no')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('product_weight')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-group">
                                        <label class="form-label mt-0">Please Select Trip</label>
                                        <select id="tripChange" name="trip_id" class="form-control select2 custom-select @error('trip_id') is-invalid @enderror" data-placeholder="Choose one" required>
                                            <option label="Choose one"></option>
                                            @foreach ($datas as $data)
                                            <option value="{{ old('trip_id',$data->trip_id) }}"><b>Trip From: </b> {{ $data->trip_from }}; &nbsp; <b>Trip To: </b> {{ $data->trip_to }}; &nbsp; <b>Trip Date: </b> {{ date('d/m/Y', strtotime($data->trip_date)) }}</option>
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
                            <div id="tripInfoWrapper" class="row"></div>
                            <div id="formWrapper" class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Chalan No. <span class="text-danger">*</span></label>
                                        <input type="text" name="chalan_no" class="form-control"  value="{{ old('chalan_no') }}" placeholder="Chalan No" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Product Quantity <span class="text-danger">*</span></label>
                                        <input type="number" name="product_weight" class="form-control"  value="{{ old('product_weight') }}" placeholder="Product Quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Official Expense <span class="text-danger">*</span></label>
                                        <input type="number" name="official_expense" class="form-control"  value="5.5" placeholder="Official Expense" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Actual Expense</label>
                                        <input type="number" name="actual_expense" class="form-control"  value="" placeholder="Actual Expense" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Select Fuel Type <span class="text-danger">*</span></label>
                                        <select name="fuel_types" class="form-control select2 custom-select" data-placeholder="Choose one" required>
                                            <option value="Quantity of Diesel Buy">Quantity of Diesel Buy</option>
                                            <option value="Quantity of Octane Buy">Quantity of Octane Buy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Quantity in Litre <span class="text-danger">*</span></label>
                                        <input type="number" name="fuel_types_value" class="form-control"  value=""  placeholder="Quantity in Litre" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Fuel Price <span class="text-danger">*</span></label>
                                        <input type="number" name="fuel_price" class="form-control"  value="62.51"  placeholder="Fuel Price" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Select Fuel Type <span class="text-danger">*</span></label>
                                        <select name="fuel_types_two" class="form-control select2 custom-select" data-placeholder="Choose one" required>
                                            <option value="Quantity of Diesel Buy">Quantity of Diesel Buy</option>
                                            <option value="Quantity of Octane Buy">Quantity of Octane Buy</option>
                                            <option value="Quantity of Dipo Diesel Reduse">Quantity of Dipo Diesel Reduse</option>
                                            <option value="Quantity of Dipo Diesel">Quantity of Dipo Diesel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Quantity in Litre <span class="text-danger">*</span></label>
                                        <input type="number" name="fuel_types_two_value" class="form-control"  value=""  placeholder="Quantity in Litre" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Select Fuel Summary <span class="text-danger">*</span></label>
                                        <select name="fuel_summary" class="form-control select2 custom-select" data-placeholder="Choose one" required>
                                            <option value="Quantity of Total Diesel">Quantity of Total Diesel</option>
                                            <option value="Quantity of Octane Buy">Quantity of Octane Buy</option>
                                            <option value="Quantity of Dipo Diesel Reduse">Quantity of Dipo Diesel Reduse</option>
                                            <option value="Quantity of Dipo Diesel">Quantity of Dipo Diesel</option>
                                            <option value="Quantity of Diesel Buy">Quantity of Diesel Buy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Total Fuel in Litre </label>
                                        <input type="number" name="total_fuel" class="form-control"  value=""  placeholder="Total Fuel" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Dipo Chalan No. <span class="text-danger">*</span></label>
                                        <input type="text" name="depo_chalan_no" class="form-control" placeholder="Deipo Chalan No" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Select Extra Fuel Expense <span class="text-danger">*</span></label>
                                        <select name="fuel_extra_expense_type" class="form-control select2 custom-select" data-placeholder="Choose one" required>
                                            <option value="Extra Diesel Expense">Extra Diesel Expense</option>
                                            <option value="For AC-4 Degree">For AC-4 Degree</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Extra Fuel Expense <span class="text-danger">*</span></label>
                                        <input type="number" name="fuel_extra_expense_type_value" class="form-control" value="2" placeholder="Extra Fuel Expense" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Select Fuel Reduse Quantity Type <span class="text-danger">*</span></label>
                                        <select name="fuel_cut_type_name" class="form-control select2 custom-select" data-placeholder="Choose one" required>
                                            <option value="Diesel Reduse Quantity">Diesel Reduse Quantity</option>
                                            <option value="Octane Reduse Quantity">Octane Reduse Quantity</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Fuel Reduse Quantity</label>
                                        <input type="number" name="fuel_cut_type_value" class="form-control" value="" placeholder="Fuel Reduse Quantity" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Write Note</label>
                                        <input type="text" name="note" class="form-control" value="Reduce 02 litres or extra -0.34 litres for making temperature of vehicle 04 degree before and after vehicle loaded" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Driver Expense</label>
                                        <input type="number" name="driver_expense" class="form-control" placeholder="Driver Expense" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Delivery Expense</label>
                                        <input type="number" name="delivery_expense" class="form-control" placeholder="Delivery Expense" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Feri/Bridge/Toll Expense</label>
                                        <input type="number" name="feri_bridge_toll" class="form-control" placeholder="Feri/Bridge/Toll Expense" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Police Expense</label>
                                        <input type="number" name="police" class="form-control" placeholder="Police Expense" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Telephone Expense</label>
                                        <input type="number" name="telephone" class="form-control" placeholder="Telephone Expense" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Repair Expense</label>
                                        <input type="number" name="repair" class="form-control" placeholder="Repair Expense" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Others Expense</label>
                                        <input type="number" name="other" class="form-control" placeholder="Others Expense" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">Save Trip Bill</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('trip-bill.index') }}" class="btn btn-warning btn-block">Cancel</a>
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
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#formWrapper').hide();
        $('#tripChange').on('change', function() {
            let tripId = this.value;
            $.ajax({
                method: 'POST',
                url: "{{ route('trip-info') }}",
                data: {
                    tripId: tripId,
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    $('#tripInfoWrapper').html(response);
                    $('#formWrapper').show();
                }
            });
        });

        $('input[name="fuel_types_value"]').keyup( function(){
            calculateFuelQuantity();
        });

        $('input[name="fuel_types_two_value"]').keyup( function(){
            calculateFuelQuantity();
        });

        $('input[name="fuel_extra_expense_type_value"]').keyup( function(){
            calculateFuelQuantity();
        });

        function calculateFuelQuantity(){
            let fuelTypesVale = parseFloat($('input[name="fuel_types_value"]').val());
            let fuelTypesTwoVale = parseFloat($('input[name="fuel_types_two_value"]').val());
            if(!fuelTypesVale){
                fuelTypesVale = 0;
            }
            if(!fuelTypesTwoVale){
                fuelTypesTwoVale = 0;
            }
            let fuelQuantity = fuelTypesVale + fuelTypesTwoVale;
            $('input[name="total_fuel"]').val(fuelQuantity.toFixed(2));
            actualCost(fuelQuantity);
            calculateFuelReduseQuantity(fuelQuantity);
        }

        function actualCost(fuelQuantity){
            let totalDistance = parseFloat($('#totalDistance').val());
            let actualCost = totalDistance / fuelQuantity;
            $('input[name="actual_expense"]').val(actualCost.toFixed(2));
        }

        function calculateFuelReduseQuantity(fuelQuantity){
            let totalDistance = parseFloat($('#totalDistance').val());
            let officialExpense = parseFloat($('input[name="official_expense"]').val());
            let extraFuelExpense = parseFloat($('input[name="fuel_extra_expense_type_value"]').val());

            if(isNaN(extraFuelExpense)){
                extraFuelExpense = 0;
            }

            let fuelReduseQuantity = totalDistance / officialExpense + extraFuelExpense - fuelQuantity;
            $('input[name="fuel_cut_type_value"]').val(fuelReduseQuantity.toFixed(3));
        }
    }); 
</script>
@endsection