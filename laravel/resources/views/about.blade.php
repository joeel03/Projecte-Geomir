@extends('layouts.box-app')
@section('box-content')

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<script>


  let imgL = document.getElementsById("foto1");
  let imgR = document.getElementsById("foto2");

  imgL.addEventListener("mouseover",function(event){
    imgL.src="img/foto_mujer.jpg";
    imgL=document.getElementsById("foto1");
  });

</script>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div id="some-element" class="about-us iframe">
          <div>
            <h1 class="about-titulo "> JOVIGAM TEAM </h1>
          </div>
          <div class="about-prueba">
            <div>
              <img id="foto1" class="about-imgL" src="img/foto_hombre.jpg"></img>
              <div>
                <h1 id="text1" class="about-text1">Xavi Galán </h1>
                <h1 class="about-text2">Programador d'elite</h1>
              </div>
            </div>
            <div>
              <img class="about-imgR" src="img/foto_mujer.jpg"></img>
              <div>
                <h1 class="about-text1">Joel Donaire </h1>
                <h1 class="about-text2">Programador d'elite</h1>
              </div>
            </div>
          </div>
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection