@extends('layouts.box-app')

@section('box-title')
    {{ __('Comentarios') }}
@endsection

@section('box-content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header ">
               <h1 class=" text-center fw-bold ">Sitios</h1>
                    @foreach ($comentarios as $coments)
                    <div class="border separar-left ">
                         <a href="{{ route('comentarios.show', $coments) }}" class="fw-bold h3 " >{{ $coments->name }}</a><br>
                            <div class="border col-md-6  h3"><span class="text-decoration-underline fw-bold ">Descripción<br></span>{{ $coments->body }}<div>
                            <div class="bajar ">
                                <div  class=" izq lista-contactos "> 
                                    <div >{{ $coments->user->name }}</div>
                                    <div >{{ $coments->created_at }}</div>
                                </div>
                            </div>    
                    </div>
                    @endforeach
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection