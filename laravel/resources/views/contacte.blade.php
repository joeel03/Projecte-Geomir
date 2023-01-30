@extends('layouts.box-app')
@section('box-content')
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"/>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
		integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
		crossorigin="">
	</script>
</head>
<style>
	#map { height: 275px;
			width:190vh; }
</style>
<header>
	<section class="showcase">
			<div class="video-container">
				<video src="https://traversymedia.com/downloads/video.mov" autoplay muted loop></video>
			</div>
			<div class="content">
				<h1 class="h1-contacte-h">Contacta'ns!</h1>
				<h3 class="h3-contacte-h">Envia el teu missatge</h3>
				<a class="boto-contacte" href="#about" >Read More</a>
			</div>
	</section>
</header>
<body class="body-contacte">
	<h1 class="h1-contacte-b">Vols visitar-nos?</h1>
	<h3 class="h3-contacte-b">Ubica'ns al mapa</h3>
	<div id="map"></div>
	<a href="/popup" target="_blank" onClick="window.open(this.href, this.target, 'width=300,height=400'); return false;">
	<button onclick="getLocation()">BOTON</button>
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
</body>
<footer>
<section id="about">
			<h2>Segueix-nos a xarxes!</h2>
			<div class="social">
				<a href="https://github.com/bradtraversy" target="_blank"><i class="bi bi-twitter"></i></a>
				<a href="https://facebook.com/traversymedia" target="_blank"><i class="bi bi-facebook"></i></a>
				<a href="https://twitter.com/traversymedia" target="_blank"><i class="bi bi-linkedin"></i></a>
				<a href="https://www.linkedin.com/in/bradtraversy" target="_blank"><i class="bi bi-github"></i></a>
			</div>
		</section>
</footer>

@endsection