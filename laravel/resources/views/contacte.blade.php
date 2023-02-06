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
			<div class="showcase-video">
				<video src="https://traversymedia.com/downloads/video.mov" autoplay muted loop></video>
			</div>
			<div class="showcase-content">
				<h1 class="showcase-h1">Contacta'ns!</h1>
				<h3 class="showcase-h3">Envia el teu missatge</h3>
				<a class="showcase-boto" href="#about" >Read More</a>
			</div>
	</section>
</header>


<body class="body-contacte">
	<h1 class="body-h1">Vols visitar-nos?</h1>
	<a href="#" onClick="getLocation()"><h3 class="body-h3">Ubica'ns al mapa</h3></a>
	<div id="map"></div>

	<script>
		var map = L.map('map').setView([41.23114477320315, 1.7281181849031044], 18);
		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
		var marker = L.marker([41.23114477320315, 1.7281181849031044]).addTo(map);
		


		function getLocation(e) {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else { 
				x.innerHTML = "Geolocation is not supported by this browser.";
			}
			e.preventDefault()
			return false
		}

		function showPosition(position) {
			var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
			var circle = L.circle([position.coords.latitude, position.coords.longitude],{color:'blue', fillColor: '#0000FF', fillOpacity: 0.5, radius: 30}).addTo(map);
		}
		navigator.getLocation.getCurrentPosition(showPosition);

		var listener = new window.keypress.Listener();
		listener.simple_combo("ctrl alt g", function(e) {
		e.alert("ESTO");
    	console.log("You pressed shift and s");
		});
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
				<a href="/home" accesskey="f">Menú Principal</a>
			</div>
		</section>
</footer>

@endsection