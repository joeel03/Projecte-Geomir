

@extends('layouts.box-app')
@section('content')

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header ">
                
                    <h1 class="linea-inferior text-center fw-bold">Reseñas</h1>
                    @foreach ($resenas as $resena)
                    <div class=" row linea-inferior">
                        <div class=" col-md-3 h3 fw-bold">
                            {{ $resena->title }}
                        <div>
                                <img class="rounded-circle img" src="img/foto_hombre.jpg" width="80%"></img>
                            </div>
                        </div>
                        <div class="border col-md-8 ">{{ $resena->description }}<br>
                        {{ $resena->stars }}estrellas
                            <div class="bajar ">
                                <button class="btn btn-primary separar">Marcar como util</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div>
                 <a class="btn btn-primary"  role="button">Crear nueva reseña</a><!-- href=resenas.create -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 