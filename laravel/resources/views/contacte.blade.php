@extends('layouts.box-app')
@section('box-content')
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css");
</head>
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
	<img class="img-contacte" src="img/2023-01-24_17-12.png"></img>
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