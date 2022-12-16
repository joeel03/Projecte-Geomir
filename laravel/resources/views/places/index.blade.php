@extends('layouts.box-app')

@section('box-title')
    {{ __('Llocs favorits') }}
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
                    @foreach ($places as $place)
                    <div class="border separar-left ">
                         <a href="{{ route('places.show', $place) }}" class="fw-bold h3 " >{{ $place->name }}</a><br>
                       
                        <div  class="row">
                            <div  class="col-md-5">
                                @foreach ($files as $file)
                                @if($file->id == $place->file_id)
                                    <div class="">
                                            <img class="caja-foto " width="100%" src='{{ asset("storage/{$file->filepath}") }}'/>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="border col-md-6  h3"><span class="text-decoration-underline fw-bold ">Descripción<br></span>{{ $place->description }}<div>
                            <div class="bajar ">
                                <div  class=" izq lista-contactos "> 
                                    <div >{{ $place->user->name }}</div>
                                    <div >{{ $place->created_at }}</div>
                                </div>
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