@extends('layouts.admin-master')

@section('title', 'Maintenance Reports')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Maintenance Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Maintenance Report</h3>
                    <div class="card-options">
                        <div class="input-group">
                            <select class="form-control mr-2" id="maintenanceType">
                                <option value="" label="Choose Maintenance Type"></option>
                                @foreach($maintenanceTypes as $maintenanceType)
                                <option value="{{ $maintenanceType->maintenance_type_id }}">{{ $maintenanceType->maintenance_type_name }}</option>
                                @endforeach
                            </select>

                            <input id="fromDate" data-provide="datepicker" type="text" class="form-control fc-datepicker mr-2" placeholder="From Date">
                            <input id="toDate" data-provide="datepicker" type="text" class="form-control fc-datepicker" placeholder="To Date">
                            <span class="input-group-btn ml-2">
                                <button id="btnMaintenanceReport" class="btn btn-sm btn-primary">
                                    <span class="fa fa-eye"></span>
                                </button>
                                <button id="btnMaintenanceReportDownload" class="btn btn-sm btn-primary">
                                    <span class="fa fa-download"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="maintenanceReportTable" class="table-responsive">
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
            minDate: "@if($firstDate){{ $firstDate->created_at->format('Y-m-d') }}@else today @endif",
            maxDate: "@if($lastDate){{ $lastDate->created_at->format('Y-m-d') }}@else today @endif"
        });
        $("#toDate").flatpickr({
            dateFormat: "Y-m-d",
            minDate: "@if($firstDate){{ $firstDate->created_at->format('Y-m-d') }}@else today @endif",
            maxDate: "@if($lastDate){{ $lastDate->created_at->format('Y-m-d') }}@else today @endif"
        });

        $('#btnMaintenanceReport').on('click', function() {
            var fromDate = null;
            var toDate = null;
            var maintenanceTypeId = null;

            $('#expensesType').removeClass('is-invalid');
            $('#fromDate').removeClass('is-invalid');
            $('#toDate').removeClass('is-invalid');

            $('#maintenanceType').on('change', function() {
                maintenanceTypeId = this.value;
            });

            if (!$("#fromDate").val()) {
                $('#fromDate').addClass('is-invalid');
            } else if (!$("#toDate").val()) {
                $('#toDate').addClass('is-invalid');
            } else {
                fromDate = $("#fromDate").val();
                toDate = $("#toDate").val();
                maintenanceTypeId = $("#maintenanceType").val();

                $.ajax({
                    url: "{{ route('maintenance-reports-generate') }}",
                    method: 'POST',
                    data: {
                        maintenanceTypeId: maintenanceTypeId,
                        fromDate: fromDate,
                        toDate: toDate,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        $('#maintenanceReportTable').html(response);
                    }
                })
            }

        });


        $('#btnMaintenanceReportDownload').on('click', function() {
            var fromDate = null;
            var toDate = null;
            var maintenanceTypeId = null;

            $('#expensesType').removeClass('is-invalid');
            $('#fromDate').removeClass('is-invalid');
            $('#toDate').removeClass('is-invalid');

            $('#maintenanceType').on('change', function() {
                maintenanceTypeId = this.value;
            });

            if (!$("#fromDate").val()) {
                $('#fromDate').addClass('is-invalid');
            } else if (!$("#toDate").val()) {
                $('#toDate').addClass('is-invalid');
            } else {
                fromDate = $("#fromDate").val();
                toDate = $("#toDate").val();
                maintenanceTypeId = $("#maintenanceType").val();

                $.ajax({
                    url: "{{ route('maintenance-reports-download') }}",
                    method: 'POST',
                    data: {
                        maintenanceTypeId: maintenanceTypeId,
                        fromDate: fromDate,
                        toDate: toDate,
                        _token: '{{csrf_token()}}',
                    },
                    success: function(response) {
                        JSONToCSVConvertor(null, response, 'Maintenance_Reports', true);
                    }
                });
            }
        });


        function JSONToCSVConvertor(info, JSONData, ReportTitle, ShowLabel) {
            //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
            var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

            var CSV = '';
            //Set Report title in first row or line
            CSV += ReportTitle + ' \r\n';
            // CSV += 'Device No: ' + info.deviceId + '\r\n';
            // CSV += 'From Date: ' + info.startDate + '\r\n';
            // CSV += 'To Date: ' + info.endDate + '\r\n\n';

            //This condition will generate the Label/Header
            if (ShowLabel) {
                var row = "";
                //This loop will extract the label from 1st index of on array
                for (var index in arrData[0]) {
                    //Now convert each value to string and comma-seprated
                    row += index + ',';
                }
                row = row.slice(0, -1);
                //append Label row with line break
                CSV += row.toUpperCase() + '\r\n';
            }

            //1st loop is to extract each row
            for (var i = 0; i < arrData.length; i++) {
                var row = "";

                //2nd loop will extract each column and convert it in string comma-seprated
                for (var index in arrData[i]) {
                    if (index == 'maintenance_type_name') {
                        row += '"' + arrData[i][index] + '",';
                    } else if (index == 'vehicle_plate_number') {
                        row += '"' + arrData[i][index] + '",';
                    } else if (index == 'maintenance_date') {
                        row += '"' + arrData[i][index] + '",';
                    } else if (index == 'maintenance_details') {
                        row += '"' + arrData[i][index] + '",';
                    } else if (index == 'maintenance_next_date') {
                        row += '"' + arrData[i][index] + '",';
                    }
                }

                row.slice(0, row.length - 1);

                //add a line break after each row
                CSV += row + '\r\n';
            }

            if (CSV == '') {
                alert("Invalid data");
                return;
            }

            //Generate a file name
            var fileName = "";
            //this will remove the blank-spaces from the title and replace it with an underscore
            fileName += ReportTitle.replace(/ /g, "_");

            //Initialize file format you want csv or xls
            var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

            // Now the little tricky part.
            // you can use either>> window.open(uri);
            // but this will not work in some browsers
            // or you will not get the correct file extension    

            //this trick will generate a temp <a /> tag
            var link = document.createElement("a");
            link.href = uri;

            //set the visibility hidden so it will not effect on your web-layout
            link.style = "visibility:hidden";
            link.download = fileName + ".csv";

            //this part will append the anchor tag and remove it after automatic click
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });
</script>
@endsection