@extends('layouts.admin-master')

@section('title', 'Vehicle Types')

@section('content')
<div class="container-fluid  content-area">

    <div class="map-header" style="height: 100vh !important;">
        <div class="map-header-layer" id="map"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&callback=initMap"></script>
<script>
    let map;
    var marker;
    var newVehicleList = [];

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 24.7953,
                lng: 90.3563
            },
            zoom: 7,
            zoomControl: true,
            fullscreenControl: true,
            streetViewControl: true,
            // disableDefaultUI: true,
            // rotateControl: true
            // mapTypeControl: true
        });

        const trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
    }
</script>
@endsection