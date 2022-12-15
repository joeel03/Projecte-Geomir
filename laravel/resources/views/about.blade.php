@extends('layouts.box-app')
@section('box-content')

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>



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
              <img id="foto1" src="img/xavi-serio.jpg" class="about-imgL" ></img>
              <div>
                <h1 class="about-text1">Xavi Galán </h1>
                <h1 id="text1" class="about-text2">Programador d'elite</h1>
              </div>
            </div>
            <div>
              <img id="foto2" class="about-imgR" src="img/joel-serio.jpg"></img>
              <div>
                <h1 class="about-text1">Joel Donaire </h1>
                <h1 id="text2" class="about-text2">Programador d'elite</h1>
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
<script>

  let imgL = document.getElementById("foto1");
  let imgR = document.getElementById("foto2");

  
  imgL.addEventListener("mouseover",function(event){
    imgL.src="img/xavi-feliz.jpg";
    document.querySelector("#text1").innerHTML = "Culturista"
  });

  imgL.addEventListener("mouseout",function(event){
    imgL.src="img/xavi-serio.jpg";
    document.querySelector("#text1").innerHTML = "Programador d'elite"
  });


  imgR.addEventListener("mouseover",function(event){
    imgR.src="img/joel-feliz.jpg";
    document.querySelector("#text2").innerHTML = "Mecánico"
  });

  imgR.addEventListener("mouseout",function(event){
    imgR.src="img/joel-serio.jpg";
    document.querySelector("#text2").innerHTML = "Programador d'elite"
  });


</script>
@endsection
