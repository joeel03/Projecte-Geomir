@extends('layouts.box-app')
@section('box-content')
<head>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
		integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
		crossorigin="">
	</script>
</head>
<style>
	#map { height: 190vh;
			width:190vh; }
</style>
<header>
	<h1 class="center">VOSTÉ ESTÀ AQUÍ</h1>
	<div id="map"></div>
	<script>
		function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
		}

		function showPosition(position) {
		x.innerHTML = "Latitude: " + position.coords.latitude + 
		"<br>Longitude: " + position.coords.longitude;
		}

		var map = L.map('map').setView([41.23114477320315, 1.7281181849031044], 18);
		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
		var marker = L.marker([41.23114477320315, 1.7281181849031044]).addTo(map);

		var marker = L.marker([41.23114477320315, 1.7281181849031044]).addTo(map);
		
		var marker1 = L.marker([function showPosition(position) {
		x.innerHTML = position.coords.latitude},x.innerHTML = position.coords.longitude]).addTo(map);

	</script>
</header>
@endsection