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
               <h1 class=" text-center fw-bold ">Comentarios</h1>
                    @foreach ($comentarios as $coment)
                    <div class="border separar-left ">
                            <div class="border col-md-10  h3"><span class="text-decoration-underline fw-bold ">
                            <div >{{ $coment->user->name }}</div>
                            </span>{{ $coment->body }}<div>
                            <div class="bajar ">
                                <div  class=" izq lista-contactos "> 
                                    <div >{{ $coment->created_at }}</div>
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