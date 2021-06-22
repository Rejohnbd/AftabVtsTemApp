@extends('layouts.admin-master')

@section('title', 'Vehicle Types')

@section('content')
<div class="container-fluid content-area">
    <div class="row" style="margin-left: 0px !important; margin-right: 0px !important">
        <div class="col-lg-12 col-xl-4">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-12">
                    <div class="card" style="margin-top: 120px;">
                        <div class="card-header">
                            <div class="card-title"> All Vehicle</div>
                        </div>
                        <div class="card-body p-2">
                            <div class="content vscroll" style="height: 67vh !important;">
                                @foreach($datas as $data)
                                <?php
                                $gprsData = findVehicleLastGprsDataByVehicleId($data->vehicle_id);
                                $tempData = findLastTempHumidityDataByVehicleId($data->vehicle_id);
                                ?>
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h3 class="card-title text-white">{{ $data->vehicle_plate_number }}</h3>
                                        <div class="card-options">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row dash1">
                                            <div class="col  border-right">
                                                <h6 class="font-weight-500 number-font1 mb-0">Engine Status</h6>
                                                <span class="text-muted">@if($gprsData->speed == 0) Off @else On @endif</span>
                                            </div>
                                            <div class="col  border-right">
                                                <h6 class="font-weight-500 number-font1 mb-0">Speed</h6>
                                                <span class="text-muted">{{ $gprsData->speed }}</span>
                                            </div>
                                            <div class="col ">
                                                <p class="font-weight-500 number-font1 mb-0">Location</p>
                                                <span class="text-muted" id="{{ $data->device_unique_id }}"></span>
                                            </div>
                                        </div>
                                        <div class="row mt-4 dash1">
                                            <div class="col  border-right">
                                                <h6 class="font-weight-500 number-font1 mb-0">Temperature</h6>
                                                <span class="text-muted">{{ $tempData['temp'] }} <sup>o</sup>C</span>
                                            </div>
                                            <div class="col  border-right">
                                                <h6 class="font-weight-500 number-font1 mb-0">Humidity</h6>
                                                <span class="text-muted">{{ $tempData['humidity'] }}</span>
                                            </div>
                                            <div class="col ">
                                                <p class="font-weight-500 number-font1 mb-0">Comp. Status</p>
                                                <span class="text-muted">@if($tempData['comp'] == 0) Off @else On @endif</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center p-1">
                                        <div class="row user-social-detail">
                                            <div class="col-lg-6 col-sm-6 col-6">
                                                <a href="{{ route('vehicle-location', $data->vehicle_id) }}" class="btn btn-icon btn-danger"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-6">
                                                <a href="{{ route('device-temp-data', $tempData['device_id']) }}" class="btn btn-icon btn-purple"><i class="fa fa-thermometer-4" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-8">
            <div class="map-header" style="height: 100vh !important;">
                <div class="map-header-layer" id="map"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/sweet-alert/sweetalert.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.js') }}"></script>
<script src="{{ asset('plugins/jquery.mCustomScrollbar/customscrollbar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6GM52G_Zf5-U9Ta22uSQAz_lGQEGq05I&callback=initMap"></script>
{{-- Include Firebase  --}}
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
<script>
    let vehicleArray = <?= json_encode($vehicleArray); ?>;
    var deviceOldData = {};
    // var myMarkers = new Array();
    // var deviceNewData = {};
    // var changeMyMarker = [];

    // map initialize
    function initMap() {
        var mapOptions = {
            center: {
                lat: 24.7953,
                lng: 90.3563
            },
            zoom: 7,
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
    database.ref('Devices/').once('value').then(function(snapshot) {
        var allDevicesInfo = snapshot.val();
        var i = 0;
        for (var key in allDevicesInfo) {
            if (allDevicesInfo.hasOwnProperty(key)) {
                deviceOldData[i] = {
                    'imei': key,
                    'lat': dex_to_degrees(allDevicesInfo[key].Data.lat),
                    'lng': dex_to_degrees(allDevicesInfo[key].Data.lng),
                    'speed': allDevicesInfo[key].Data.speed,
                    'status': allDevicesInfo[key].Data.status,
                }
            }
            i++;
        }

        var cli = 0;

        function customLoop() {
            setTimeout(function() {
                cli++;
                if (cli <= Object.keys(deviceOldData).length) {
                    customLoop();
                    addMarker(map, deviceOldData[cli - 1]);
                }
            }, 1500);
        }

        customLoop();
    });

    function addMarker(map, data) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data.lat, data.lng),
            icon: "{{ asset('img/van.png') }}",
            map: map
        });

        attachVehicleInfo(marker, data.imei, data.lat, data.lng, data.speed, data.status);
        return marker;
    }


    function attachVehicleInfo(marker, imei, lat, lng, speed, status) {
        const vehicleNumber = vehicleArray[imei];
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = new google.maps.Geocoder()
        var engStatus;
        if (status == 1) {
            engStatus = "On";
        } else {
            engStatus = "Off";
        }
        geocoder.geocode({
            location: latlng
        }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    locationAddress = results[0].formatted_address;
                    $('#' + imei).text(results[0].formatted_address);
                    const contentString =
                        '<div>' +
                        '<p class="text-center"><b>' + vehicleNumber + '</b></p>' +
                        '<div class="d-flex justify-content-between">' +
                        '<div><b>Speed: </b>' + speed + ' km</div>' +
                        '<div><b>Engine Status: </b>' + engStatus + '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<div>' +
                        locationAddress +
                        '<div>' +
                        '</div>';
                    const infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener("click", () => {
                        infowindow.open(marker.get("map"), marker)
                    });
                    console.log(locationAddress, '1st')
                } else {
                    window.alert("No results found");
                }
            } else {
                window.alert("Geocoder failed due to: " + status);
            }
        });
    }
</script>

@if(session('error'))
<script>
    $(document).ready(function() {
        Swal.fire({
            title: "Alert",
            text: "{{ session('error') }}",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: 'Exit',
            cancelButtonText: 'Stay on the page'
        });
    });
</script>
@endif

@endsection