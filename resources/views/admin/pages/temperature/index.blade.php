@extends('layouts.admin-master')

@section('title', 'Temperature Device Data')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Temperature Device Preset Data</li>
            </ol>
            <div class="ml-auto">
                <a href="{{ route('temp-device-report', $tempDeviceInfo->device_id) }}" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Reports
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Temerature: <span id="tempText">{{ $tempDeviceLastData->temperature }}</span> <sup>o</sup>C</h3>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <div id="tempCalcu" class="text-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Humidity: <span id="humiText">{{ $tempDeviceLastData->humidity }}</span> %</h3>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <div id="deviceTemp" class="text-center mt-5"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Status: <span id="statusText">@if($tempDeviceLastData->comp_status == 1) ON @else OFF @endif</span></h3>
                    </div>
                    <div class="card-body text-center" style="height: 400px;">
                        <img id="compStatus" src="@if($tempDeviceLastData->comp_status == 1) {{ asset('img/on.jpg') }} @else {{ asset('img/off.jpg') }} @endif" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6 pr-0 pl-0 border-right">
                            <div class="card-body text-center">
                                <h6 class="mb-0">Device Model</h6>
                                <h2 class="mb-1 mt-2 number-font"><span class="counter">{{ $tempDeviceInfo->device_model }}</span></h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 pr-0 pl-0 border-right">
                            <div class="card-body text-center">
                                <h6 class="mb-0">Device IMEI No</h6>
                                <h2 class="mb-1 mt-2 number-font"><span class="counter">{{ $tempDeviceInfo->device_unique_id }}</span></h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 pr-0 pl-0 border-right">
                            <div class="card-body text-center">
                                <h6 class="mb-0">Device SIM Number</h6>
                                <h2 class="mb-1 mt-2 number-font"><span class="counter">{{ $tempDeviceInfo->device_sim_number }}</span></h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 pr-0 pl-0">
                            <div class="card-body text-center">
                                <h6 class="mb-0">Device SIM Type</h6>
                                <h2 class="mb-1 mt-2 number-font"><span class="counter">{{ $tempDeviceInfo->device_sim_type }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

@endsection

@section('scripts')
<script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script src="{{ asset('plugins/amcharts/core.js') }}"></script>
<script src="{{ asset('plugins/amcharts/charts.js')}}"></script>
<script src="{{ asset('plugins/amcharts/animated.js')}}"></script>
<script>
    $("document").ready(function() {
        var response = '';

        var chart = new FusionCharts({
            type: 'thermometer',
            renderAt: 'tempCalcu',
            width: '150',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    // "caption": "Central cold storage",
                    // "subcaption": "Bakersfield Central",
                    "subcaptionFontBold": "0",
                    "lowerLimit": "-10",
                    "upperLimit": "60",
                    "numberSuffix": "°C",
                    "bgColor": "#ffffff",
                    "showBorder": "0",
                    "thmFillColor": "#008ee4"
                },
                "value": 0 // dataInfo.temperature
            }
        }).render();



        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // create chart
        var humiChart = am4core.create("deviceTemp", am4charts.GaugeChart);
        humiChart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        humiChart.innerRadius = -25;

        var axis = humiChart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;
        axis.renderer.grid.template.stroke = new am4core.InterfaceColorSet().getFor("background");
        axis.renderer.grid.template.strokeOpacity = 0.3;

        var colorSet = new am4core.ColorSet();

        var range0 = axis.axisRanges.create();
        range0.value = 0;
        range0.endValue = 50;
        range0.axisFill.fillOpacity = 1;
        range0.axisFill.fill = colorSet.getIndex(0);
        range0.axisFill.zIndex = -1;

        var range1 = axis.axisRanges.create();
        range1.value = 50;
        range1.endValue = 80;
        range1.axisFill.fillOpacity = 1;
        range1.axisFill.fill = colorSet.getIndex(2);
        range1.axisFill.zIndex = -1;

        var range2 = axis.axisRanges.create();
        range2.value = 80;
        range2.endValue = 100;
        range2.axisFill.fillOpacity = 1;
        range2.axisFill.fill = colorSet.getIndex(4);
        range2.axisFill.zIndex = -1;

        var hand = humiChart.hands.push(new am4charts.ClockHand());

        setInterval(function() {
            $.ajax({
                url: "{{ route('get-temp-device-data') }}",
                method: 'POST',
                data: {
                    deviceId: "{{ $tempDeviceInfo->device_unique_id }}",
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        if (response.comp_status == 0) {
                            $('#compStatus').attr('src', "{{ asset('img/off.jpg') }}")
                            $('#statusText').text('OFF')
                        } else if (response.comp_status == 1) {
                            $('#compStatus').attr('src', "{{ asset('img/on.jpg') }}")
                            $('#statusText').text('ON')
                        }
                        chart.setData(response.temperature)
                        $('#tempText').text(response.temperature)
                        humiChart.setTimeout(randomValue);

                        function randomValue() {
                            hand.showValue(response.humidity, 500, am4core.ease.cubicOut);
                        }
                        $('#humiText').text(response.humidity)
                    }
                }
            })
        }, 30000);
    });
</script>
@endsection