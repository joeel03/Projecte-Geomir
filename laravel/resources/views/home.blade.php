@extends('layouts.box-app')

@section('box-title')
{{ __('Dashboard') }}
@endsection

@section('box-content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<div class="border row letra">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center">
        <form >
        <input class=" mr-sm-2 align-middle" style="font-size:1.4em;" type="search" placeholder="Search"
        aria-label="Search">
        <button class="btn btn-primary my-2 my-sm-0" style="font-size:1.5em;" type="submit"><i
                class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="col-md-4 text-center espacio">
        <a href="{{ route('posts.create') }}" class="btn btn-primary my-2 my-sm-0" style="font-size:1.5em;"><i class="fa-solid fa-camera"></i></a>
        <a href="" class="btn btn-primary my-2 my-sm-0" style="font-size:1.5em;"><i
                class="fa-solid fa-magnifying-glass"></i></a>
        <a href="" class="btn btn-primary my-2 my-sm-0" style="font-size:1.5em;"><i class="fa-solid fa-house"></i></a>
        <a href="" class="btn btn-primary my-2 my-sm-0" style="font-size:1.5em;"><i class="fa-solid fa-bell"></i></a>
        <a href="" class="btn btn-primary my-2 my-sm-0" style="font-size:1.5em;"><i class="fa-solid fa-user"></i></a>

    </div>
</div>
<div class="border row text-center h1 post">
    <div class="border col-md-4 ">
        <h1 class="linea-inferior">Lista de contactos</h1>
        <div class="lista-contactos linea-inferior">
            <img class="rounded-circle img" src="img/foto_hombre.jpg" width="20%"></img>
            Mario Gomez
            <i class="fa-brands fa-whatsapp  border-emoji"></i>
            <i class="fa-solid fa-phone  border-emoji"></i>
        </div>
        <div class="lista-contactos linea-inferior">
            <img class="rounded-circle img" src="img/foto_mujer.jpg" width="20%"></img>
            Andrea Perruna
            <i class="fa-brands fa-whatsapp  border-emoji"></i>
            <i class="fa-solid fa-phone  border-emoji"></i>
        </div>
    </div>
    <div class="border col-md-4 post">
        @include('partials.posts')
    </div>
    <div class=" border col-md-4">
        <div>
            <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="boton-mas"><a href="{{ route('places.create') }}" class="btn btn-primary"
                    style="font-size:0.6em;"><i class="fa-solid fa-plus"></i></a></div>
            <div class="boton-menu"><a href="{{ route('places.index') }}" class="btn btn-primary"
                    style="font-size:0.6em;"><i class="fa-solid fa-list"></i></a></div>
        </div>
        <div class="row caja-text">
            <a class="border minicajas col-md-4 a " href="">Marcar com a favorit</a>
            <a class="border minicajas col-md-4 a" href="">Desar categoria</a>
            <a class="border minicajas col-md-4 a" href="{{ url('/resenas') }}">Reseñas</a>
        </div>
        <div>
        </div>
    </div>
</div>

@endsection