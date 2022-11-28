@extends('layouts.box-app')
@section('content')

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header ">
                
                    <h1 class="linea-inferior text-center fw-bold">Reseñas</h1>
    
                    <div class=" row linea-inferior">
                        <div class=" col-md-3 h3 fw-bold">
                            Mario Gomez
                            <div>
                                <img class="rounded-circle img" src="img/foto_hombre.jpg" width="80%"></img>
                            </div>
                        </div>
                        <div class="border col-md-8 "></span>Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but
                            also the leap into electronic typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s
                            with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                            desktop
                            publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            <div class="bajar ">
                                <button class="btn btn-primary separar">Marcar como util</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class=" row linea-inferior">
                        <div class=" col-md-3 h3 fw-bold">
                            Andrea Perruna
                            <div>
                                <img class="rounded-circle img" src="img/foto_mujer.jpg" width="80%"></img>
                            </div>

                        </div>
                        <div class="border col-md-8 "></span>Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but
                            also the leap into electronic typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s
                            with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                            desktop
                            publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            <div class="bajar ">
                                <button class="btn btn-primary separar">Marcar como util</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary reseñas">Crear nueva reseña</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection