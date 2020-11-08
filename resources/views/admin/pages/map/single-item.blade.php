@extends('layouts.admin-master')

@section('title', $data['title'])

@section('content')
<div class="container-fluid content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboards') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">{{$data['title']}}</li>
            </ol>
            <div class="ml-auto">
                <a href="#" class="btn btn-primary btn-icon btn-sm text-white mr-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Show Report
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
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
                lat: 24.7953,
                lng: 90.3563
            },
            zoom: 8,
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
    database.ref('Devices/').on('value', function(snapshot) {
        var allDevicesInfo = snapshot.val();
        $.each(allDevicesInfo, function(key, data) {
            if (key == <?= $data['device_id'] ?>) {
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
            icon: "{{ asset('img/car.jpg') }}",
            map: map,
        });

    });
</script>

@endsection