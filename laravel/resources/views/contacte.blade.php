@extends('layouts.box-app')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<link rel="stylesheet" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin="">
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
@endsection

@vite(['resources/js/keypress.js', 'resources/js/contacte/keypress.js'])

@section('box-content')
<header class="header" id="header">
	<section class="showcase__section">
		<div class="showcase__video">
			<video src="/img/video.mov" autoplay muted loop></video>
		</div>
		<div class="showcase__content">
			<h1 class="showcase__h1">Contacta'ns!</h1>
			<h3 class="showcase__h3">Envia el teu missatge</h3>
			<!-- Botones para ejecutar la lectura de elementos -->
			<a class="showcase__boto" href="/about">About-us</a><br>
			<button id="leerTexto">Leer texto</button>
			<br>
			<a href="https://www.w3.org/WAI/WCAG2AA-Conformance"
			title="Explanation of WCAG 2 Level AA conformance">
			<img height="32" width="88" src="https://www.w3.org/WAI/WCAG21/wcag2.1AA-v" alt="Level AA conformance,
            W3C WAI Web Content Accessibility Guidelines 2.1">
			</a>
		</div>
	</section>
</header>


<body class="body">
	<h1 class="body__h1">Vols visitar-nos?</h1>
	<a href="#" onClick="getLocation()">
		<h2 class="body__h3">Ubica'ns al mapa</h2>
	</a>
	<div id="map"></div>

	<script>
		var map = L.map('map').setView([41.23114477320315, 1.7281181849031044], 18);
		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
		var marker = L.marker([41.23114477320315, 1.7281181849031044]).addTo(map);

		L.Routing.control({
			waypoints: [
				L.latLng(41.23114477320315, 1.7281181849031044),
				L.latLng(41.22317016641275, 1.7176998961503782)
			]
		}).addTo(map);

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
			var circle = L.circle([position.coords.latitude, position.coords.longitude], {
				color: 'blue',
				fillColor: '#0000FF',
				fillOpacity: 0.5,
				radius: 30
			}).addTo(map);
		}
		// Funcion que coge el texto de toda la pagina y lo lee.
		function leerPagina() {
			var texto = document.body.innerText;
			var mensaje = new SpeechSynthesisUtterance(texto);
			window.speechSynthesis.speak(mensaje);
		}
		// Declarar boton para leer elementos con id header 
		// var boton1 = document.getElementById("header");
				
		// Funcion de que cuando haces clic coge los elementos de showcase_section y los concatena en una variable llamada text y seguidamente los lee.
		function leerParrafo() {
			// Codi per obtenir el text de l'element i els seus fills
			var elements = document.getElementsByClassName('showcase__section');
			var text = '';
			for (var i = 0; i < elements.length; i++) {
				text += elements[i].textContent + ' ';
			}
			var msg = new SpeechSynthesisUtterance(text);
			speechSynthesis.speak(msg);
		};
		// Declarar boton para leer parrafo 
		boton1.addEventListener("dblclick", leerParrafo);

		// Coge el contenido de un elemento por la id y te lo lee
		function leerTexto() {
			var texto = document.getElementById("leerTexto").innerText;
			var synth = window.speechSynthesis;
			var msg = new SpeechSynthesisUtterance();
			msg.text = texto;
			synth.speak(msg);
		}
		// Definimos el boton y esperamos a que se haga el clic
		var boton = document.getElementById("leerTexto");
		boton.addEventListener("click", leerTexto);
	</script>
</body>
<footer>
	<section id="about">
		<h2>Segueix-nos a xarxes!</h2>
		<div>
			<a href="https://github.com/bradtraversy" target="_blank"><i class="bi bi-twitter"></i><span class="ocultar">f</span></a>
			<a href="https://facebook.com/traversymedia" target="_blank"><i class="bi bi-facebook"></i></a>
			<a href="/home" accesskey="f" class="about__a-link">Menú Principal</a>
			<a href="https://twitter.com/traversymedia" target="_blank"><i class="bi bi-linkedin"></i></a>
			<a href="https://www.linkedin.com/in/bradtraversy" target="_blank"><i class="bi bi-github"></i></a>
		</div>
	</section>
</footer>

@endsection