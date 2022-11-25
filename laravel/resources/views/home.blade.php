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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<link href = "https://fonts.googleapis.com/css?family=Montserrat" rel = "stylesheet" >  
</head>

<div class="border row letra">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center"">
        <form >
        <input class=" mr-sm-2 align-middle" style="font-size:20px;" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>    
    </div>
    <div class="col-md-4 text-center" >
        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-camera"></i></a>
        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-magnifying-glass"></i></a>
        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-house"></i></a>
        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-bell"></i></a>
        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-user"></i></a>

    </div>
</div>
    <div class="border row text-center h1">
        <div class="border col-md-4 letra">
            Lista de contactos
            <div>
                <img class="rounded-circle" src="img/foto_hombre.jpg" width="20%"></img>
                Mario Gomez
                <i class="fa-brands fa-whatsapp h1 border-emoji" ></i>
                <i class="fa-solid fa-phone h1 border-emoji" ></i>
            </div>
            <div>
                <img class="rounded-circle" src="img/foto_mujer.jpg" width="20%"></img>
                Andrea Perruna
                <i class="fa-brands fa-whatsapp h1 border-emoji" ></i>
                <i class="fa-solid fa-phone h1 border-emoji" ></i>
            </div>
        </div>
        <div class="border col-md-4">
            medio
        </div>
        <div class="border col-md-4">
            <img src="img/mapa.png" width="100%" height="100%"></img>
        </div>
    </div>
</div>
@endsection