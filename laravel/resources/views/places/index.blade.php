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
               <div class="card-header">
                    <div class="card-header">
                        @yield('box-title')
                    </div>
                    @foreach ($places as $place)
                    <div class="border ">
                        
                        <div  class=" h3">{{ $place->name }}</div>
                        <div  class=" row">
                            <div  class=" col-md-6">
                                @foreach ($files as $file)
                                @if($file->id == $place->file_id)
                                    <div class="border">
                                            <img class="caja-foto " src='{{ asset("storage/{$file->filepath}") }}'/>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="border col-md-6 descrip "><span class="text-decoration-underline ">Descripción<br></span>{{ $place->description }}<div>
                            <div class="bajar ">
                                <div  class=" izq "> 
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