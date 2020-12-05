@extends('layouts.admin-master')

@section('title', 'Vehicle Types')

@section('content')
<div class="container-fluid content-area">
    <div class="row" style="margin-left: 0px !important; margin-right: 0px !important">
        <div class="col-lg-12 col-xl-3">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-12">
                    <div class="card" style="margin-top: 120px;">
                        <div class="card-header">
                            <div class="card-title"> All Vehicle</div>
                        </div>
                        <div class="card-body">
                            <div class="content vscroll" style="height: 67vh !important;">
                                <div class="list-group list-lg-group list-group-flush br-4">
                                    @foreach($datas as $data)
                                    <a class="list-group-item list-group-item-action p-3" href="{{ route('vehicle-location', $data->vehicle_id) }}">
                                        <div class="media mt-0">
                                            <span class="avatar brround cover-image"></span>
                                            <div class="media-body ml-2">
                                                <div class="d-md-flex align-items-center">
                                                    <div>
                                                        <h5 class="mb-0 text-dark">{{ $data->vehicle_plate_number }}</h5>
                                                        <p class="mb-0 fs-13 text-muted"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
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
    var deviceOldData = {};
    var myMarkers = new Array();
    var deviceNewData = {};
    var changeMyMarker = [];
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
    /* database.ref('Devices/').once('value').then(function(snapshot) {
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

        for (index in deviceOldData) {
            myMarkers[index] = [addMarker(map, deviceOldData[index]), [deviceOldData[index].imei]]
        };

    }); */
    // console.log(deviceOldData, 'deviceOldData');

    function addMarker(map, data) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data.lat, data.lng),
            icon: "{{ asset('img/van.png') }}",
            map: map
        });
        return marker;
    }
    // console.log(myMarkers)

    /*database.ref('Devices/').on('child_changed', function(snapshot) {
        var changeData = snapshot.val();
        // console.log(snapshot.ref.key);
        $.each(deviceOldData, function(key, data) {
            deviceNewData[key] = data;
            if (data.imei == snapshot.ref.key) {
                oldLat = data.lat;
                oldLng = data.lng;
                changeImei = data.imei;

                deviceNewData[key] = {
                    'imei': data.imei,
                    'lat': dex_to_degrees(changeData.Data.lat),
                    'lng': dex_to_degrees(changeData.Data.lng),
                    'speed': changeData.Data.speed,
                    'status': changeData.Data.status,
                };
                position = [dex_to_degrees(changeData.Data.lat), dex_to_degrees(changeData.Data.lng)];
            }
        });

        $.each(myMarkers, function(key, data) {
            if (changeImei == data[1]) {
                console.log(key)
                console.log(data[1])
                changeMyMarker = myMarkers[key];
            }
        })
        console.log(changeMyMarker, 'changed marker');

        var result = [oldLat, oldLng, changeMyMarker]
        transition(result);
    });

    // Variable for Transition or Move marker
    var numDeltas = 100;
    var delay = 10; //milliseconds
    var i = 0;
    var deltaLat;
    var deltaLng;

    function transition(result) {
        i = 0;
        deltaLat = (result[0] - position[0]) / numDeltas;
        deltaLng = (result[1] - position[1]) / numDeltas;
        moveMarker(result[2]);
    }

    function moveMarker(result) {
        position[0] += deltaLat;
        position[1] += deltaLng;
        var latlng = new google.maps.LatLng(position[0], position[1]);
        result.setPosition(latlng);
        if (i != numDeltas) {
            i++;
            setTimeout(moveMarker, delay);
        }
    } */
</script>

@endsection