@extends('layouts.box-app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">

                    <h1 class="linea-inferior text-center fw-bold">Reseñas</h1>
                    @foreach ($resenas as $resena)
                    @if($resena->place_id==$place->id)
                    <div class=" row linea-inferior">
                        <div class=" col-md-3 h3 fw-bold">
                        <a href="{{ route('places.resenas.show', [$place,$resena]) }}" class="fw-bold h3 " >{{ $resena->title }}</a><br>
                            
                            <div>
                                @foreach ($files as $file)
                                @if($file->id == $resena->file_id)
                                <div>
                                    <img class="caja-foto " width="80%"
                                        src='{{ asset("storage/{$file->filepath}") }}' />
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="border col-md-8 ">{{ $resena->description }}<br>
                        <?php for($i=0;$i<$resena->stars;$i++){
                                echo "&#11088";
                            }?>   
                            <div class="bajar ">
                                <button class="btn btn-primary separar">Marcar como util</button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <div>
                    <a class="btn btn-primary" href="{{ route('places.resenas.create', $place) }}" role="button">Crear nueva reseña</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection