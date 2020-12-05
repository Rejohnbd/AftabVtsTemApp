@extends('layouts.admin-master')

@section('title', 'Device Location')

@section('content')
<div class="container-fluid content-area">
    <div class="row" style="margin-left: 0px !important; margin-right: 0px !important">
        <div class="col-lg-12 col-xl-3">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-12" style="height: 67vh !important;">

                    <div class="card" style="margin-top: 120px;">
                        <div class="card-header pt-2 pb-0 border-bottom-0">
                            <h6 class="mb-0">Device Information</h6>
                        </div>
                        <div class="card-body pt-0">
                            <p class="mb-2"><strong>Device IMEI: </strong> <span class="float-right">{{ $deviceInfo->device_unique_id }}</span></p>
                            <p class="mb-2"><strong>Device Model: </strong> <span class="float-right">{{ $deviceInfo->device_model }}</span></p>
                            <p class="mb-2"><strong>Device SIM: </strong> <span class="float-right">{{ $deviceInfo->device_sim_number }}</span></p>
                            <p class="mb-2"><strong>SIM Type: </strong> <span class="float-right">{{ $deviceInfo->device_sim_type }}</span></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-2 pb-0 border-bottom-0">
                            <h6 class="mb-0">Device GPS Info</h6>
                        </div>
                        <div class="card-body pt-0">
                            <p class="mb-2">
                                Engine Status: <span class="ml-2" id="engineStatus">@if($deviceDataInfo->status == 1) ON @else OFF @endif</span>
                            </p>
                            <p class="mb-2">
                                <i class="fa fa-map-marker fs-20 text-danger"></i> <span class="ml-2">Locations</span>
                            </p>
                            Vehicle Speed:</br />
                            <div class="progress progress-md mb-1">
                                <div id="vehicleSpeedStyle" style="width: {{ round($deviceDataInfo->speed) }}" class="progress-bar bg-warning">
                                    <span id="vehicleSpeed">{{ round($deviceDataInfo->speed) }} Km</span>
                                </div>
                            </div>
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
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.js') }}"></script>
<script src="{{ asset('plugins/jquery.mCustomScrollbar/customscrollbar.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&callback=initMap"></script>
{{-- Include Firebase  --}}
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>

<script>
    var deviceData = {};
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
    /* database.ref('Devices/').on('value', function(snapshot) {
        var allDevicesInfo = snapshot.val();
        $.each(allDevicesInfo, function(key, data) {
            if (key == <?= $deviceInfo->device_unique_id ?>) {
                deviceData = {
                    'imei': key,
                    'lat': dex_to_degrees(allDevicesInfo[key].Data.lat),
                    'lng': dex_to_degrees(allDevicesInfo[key].Data.lng),
                    'speed': allDevicesInfo[key].Data.speed,
                    'status': allDevicesInfo[key].Data.status,
                }
            }
        });

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(deviceData.lat, deviceData.lng),
            icon: "{{ asset('img/van.png') }}",
            map: map,
        });
    }); */
</script>

@endsection