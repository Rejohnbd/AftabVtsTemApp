@extends('layouts.admin-master')

@section('title', 'Temperature Device Report')

@section('content')
<div class="container content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Temperature Report of Device {{ $tempDeviceInfo->device_unique_id }}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label ml-4">Select Report Date:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                    <input type="text" id="dataDate" data-provide="datepicker" class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required>
                                    <button id="btnShowData" class="btn btn-primary btn-icon">
                                        <div><i class="fa fa-eye"></i></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label ml-4">Select Start Date:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                            <input type="text" id="dataStartDate" data-provide="datepicker" class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label ml-4">Select End Date:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                            <input type="text" id="dataEndDate" data-provide="datepicker" class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label">Export Option:</label>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" id="excelExport" href="#">Excell Export</a>
                                            <a class="dropdown-item" href="#">Pdf Export</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="deviceDataTable">
                        @include('admin.pages.temperature.report-single')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
        $("#dataDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $tempDeviceInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });

        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            selectedDate = $("#dataDate").val();
            $.ajax({
                url: "{{ route('device-temp-data-paginate') }}",
                method: 'POST',
                data: {
                    page: page,
                    selectedDate: selectedDate,
                    deviceId: "{{ $tempDeviceInfo->device_id }}",
                    _token: '{{csrf_token()}}',
                },
                success: function(reports) {
                    $('#deviceDataTable').html(reports);
                }
            })
        }

        // Data by Date
        $("#dataDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $tempDeviceInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });

        $('#btnShowData').on('click', function() {
            selectedDate = $("#dataDate").val();
            console.log('called');
            $.ajax({
                url: "{{ route('device-temp-dated-data') }}",
                method: 'POST',
                data: {
                    deviceId: "{{ $tempDeviceInfo->device_id }}",
                    selectedDate: selectedDate,
                    _token: '{{csrf_token()}}',
                },
                success: function(reports) {
                    $('#deviceDataTable').html(reports);
                }
            })
        })

        // Start Date
        $("#dataStartDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $tempDeviceInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });
        // Start Date
        $("#dataEndDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $tempDeviceInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });

        $('#excelExport').on('click', function() {
            startDate = $("#dataStartDate").val();
            endDate = $("#dataEndDate").val();
            $.ajax({
                url: "{{ route('device-temp-export-as-excel') }}",
                method: 'POST',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    deviceId: "{{ $tempDeviceInfo->device_id }}",
                    _token: '{{csrf_token()}}',
                },
                success: function(overAllData) {
                    // console.log(datas)
                    JSONToCSVConvertor(overAllData.info, overAllData.datas, 'Reports', true);
                }
            });
        });

        function JSONToCSVConvertor(info, JSONData, ReportTitle, ShowLabel) {
            //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
            var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

            var CSV = '';
            //Set Report title in first row or line
            CSV += ReportTitle + ' of \r\n';
            CSV += 'Device No: ' + info.deviceId + '\r\n';
            CSV += 'From Date: ' + info.startDate + '\r\n';
            CSV += 'To Date: ' + info.endDate + '\r\n\n';

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
                    console.log(index);
                    if (index == 'comp_status') {
                        if (arrData[i][index] == 0) {
                            row += '"' + 'OFF' + '",';
                        } else {
                            row += '"' + 'ON' + '",';
                        }
                    } else if (index == 'date') {
                        row += '"' + arrData[i][index].substr(0, 10) + '",';
                    } else if (index == 'time') {
                        row += '"' + arrData[i][index].slice(10) + '",';
                    } else {
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