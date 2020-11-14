@extends('layouts.admin-master')

@section('title', 'Vehicle Location')

@section('content')
<div class="container-fluid content-area">
    <div class="row" style="margin-left: 0px !important; margin-right: 0px !important">
        <div class="col-lg-12 col-xl-3">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-12" style="height: 67vh !important;">
                    <div class="card card-collapsed" style="margin-top: 120px;" card-collapsed>
                        <div class="card-header">
                            <div class="card-title">{{ $vehicleInfo->vehicle_plate_number }}</div>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <ul class="demo-accordion accordionjs m-0" data-active-index="false">
                                    <li>
                                        <div>
                                            <h3>Vehicle Info</h3>
                                        </div>
                                        <div>
                                            <p><strong>Vehicle Brand: </strong> {{ $vehicleInfo->vehicle_brand }}</p>
                                            <p><strong>Vehicle Model: </strong> {{ $vehicleInfo->vehicle_model }}</p>
                                            <p><strong>Model Year: </strong> {{ $vehicleInfo->vehicle_model_year }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Device Info</h3>
                                        </div>
                                        <div>
                                            <p><strong>Device IMEI: </strong> {{ $deviceInfo->device_unique_id }}</p>
                                            <p><strong>Device Model: </strong> {{ $deviceInfo->device_model }}</p>
                                            <p><strong>Device SIM: </strong> {{ $deviceInfo->device_sim_number }}</p>
                                            <p><strong>SIM Type: </strong> {{ $deviceInfo->device_sim_type }}</p>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header pt-2 pb-0 border-bottom-0">
                            <h6 class="mb-0">Engine Status: <span id="engineStatus">@if($deviceDataInfo->status == 1) ON @else OFF @endif</span></h6>
                        </div>
                        <div class="card-body pt-0">
                            <h6 class="mb-2">
                                <i class="fe fe-check-circle fs-20 text-primary"></i> <span>Locations</span>
                            </h6>
                            <div class="progress progress-md mb-3">
                                <div id="vehicleSpeedStyle" style="width: {{ round($deviceDataInfo->speed) }}" class="progress-bar bg-warning"><span id="vehicleSpeed">{{ round($deviceDataInfo->speed) }}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-collapsed">
                        <div class="card-header pt-2 pb-0 border-bottom-0">
                            <h6 class="mb-0">Reports</h6>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="form-group">
                                <label class="form-label">Show Travels</label>
                                <div class="row gutters-xs">
                                    <div class="col">
                                        <input id="dataDate" data-provide="datepicker" type="text" class="form-control fc-datepicker">
                                    </div>
                                    <span class="col-auto">
                                        <button id="btnDailyReport" class="btn btn-primary" type="button"><i class="fa fa-eye"></i></button>
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('vehicle-reports', $vehicleInfo->vehicle_id) }}" class="btn btn-primary btn-block">View Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-9">
            <div class="map-header" style="height: 100vh !important;">
                <div class="map-header-layer" id="map"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/accordion/accordion.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
<script src="{{ asset('plugins/accordion/accordion.min.js') }}"></script>
<script src="{{ asset('plugins/accordion/accordion.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&callback=initMap"></script>
{{-- Include Firebase  --}}
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>

<script>
    var deviceData = {};
    var changePosition;
    var lockPosition;
    var marker;
    // map initialize
    function initMap() {
        var mapOptions = {
            center: {
                lat: <?= $deviceDataInfo->latitude ?>,
                lng: <?= $deviceDataInfo->longitude ?>
            },
            zoom: 10,
            zoomControl: true,
            fullscreenControl: true,
            streetViewControl: true,
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        // marker = new google.maps.Marker({
        //     position: new google.maps.LatLng(<?= $deviceDataInfo->latitude ?>, <?= $deviceDataInfo->longitude ?>),
        //     icon: "{{ asset('img/car.jpg') }}",
        // map: map,
        // });
        displayLocation(<?= $deviceDataInfo->latitude ?>, <?= $deviceDataInfo->longitude ?>)
    }

    function displayLocation(lat, lng) {
        // console.log(location.lat)
        var position = new google.maps.LatLng(lat, lng);
        if (marker && marker.setPosition) {
            // if the marker already exists, move it (set its position)
            // location = {
            // lat: lat,
            // lng: lng
            // };
            marker.setPosition(position);

        } else {
            // create a new marker, keeping a reference
            marker = new google.maps.Marker({
                map: map,
                position: position,
                icon: "{{ asset('img/car.jpg') }}",
            });
        }
        lockPosition = position;
    }
    // decode data
    function dex_to_degrees(dex) {
        return parseInt(dex, 16) / 1800000;
    };
    // firebase initialize
    var config = {
        apiKey: "{{ env('FIRE_API_KEY')}}",
        authDomain: "{{ env('FIRE_AUTH_DOMAIN') }}",
        databaseURL: "{{ env('FIRE_DB_URL') }}",
        storageBucket: "{{ env('FIRE_STOREAGE_BUCKET') }}",
    };
    firebase.initializeApp(config);
    var database = firebase.database();
    // Get Data from Firebase
    // database.ref('Devices/').on('child_changed', function(snapshot) {
    // var changeData = snapshot.val();
    // console.log(changeData)
    // });
    database.ref('Devices/').on('child_changed', function(snapshot) {
        var changeData = snapshot.val();
        if (snapshot.ref.key == <?= $deviceInfo->device_unique_id ?>) {
            console.log(changeData)
            console.log(snapshot.ref.key)

            var engineStatus;
            if (changeData.Data.status == 0) {
                engineStatus = 'OFF';
            } else {
                engineStatus = 'ON'
            }
            $('#engineStatus').text(engineStatus);

            $('#vehicleSpeed').text(changeData.Data.speed);
            $('#vehicleSpeedStyle').css('width', changeData.Data.speed + '%');


            changePosition = [dex_to_degrees(changeData.Data.lat), dex_to_degrees(changeData.Data.lng)];
            var result = [<?= $deviceDataInfo->latitude ?>, <?= $deviceDataInfo->longitude ?>]
            // transition(result);
        }

        marker = new google.maps.Marker({
            map: map,
            position: lockPosition,
            icon: "{{ asset('img/car.jpg') }}",
        });

    });

    // Variable for Transition or Move marker
    var numDeltas = 100;
    var delay = 10; //milliseconds
    var i = 0;
    var deltaLat;
    var deltaLng;

    function transition(result) {
        i = 0;
        deltaLat = (result[0] - changePosition[0]) / numDeltas;
        deltaLng = (result[1] - changePosition[1]) / numDeltas;
        moveMarker();
    }

    function moveMarker() {
        changePosition[0] += deltaLat;
        changePosition[1] += deltaLng;
        // console.log(position[0], position[1])
        displayLocation(changePosition[0], changePosition[1])
        // var latlng = new google.maps.LatLng(position[0], position[1]);
        // marker.setPosition(latlng);
        if (i != numDeltas) {
            i++;
            setTimeout(moveMarker, delay);
        }
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
        $("#dataDate").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "{{ date('Y-m-d') }}",
            minDate: "{{ $vehicleInfo->created_at->format('Y-m-d') }}",
            maxDate: "{{ date('Y-m-d') }}"
        });
    })
</script>

@endsection