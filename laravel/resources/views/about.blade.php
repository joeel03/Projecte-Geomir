@extends('layouts.box-app')
@section('box-content')

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>


<div class="container">
  <div class="row justify-content-center">
    <div class="quadrado-us ">
      <div>
        <h1 class="about-titulo "> JOVIGAM TEAM </h1>
      </div>
      <div class="about-prueba">
        <div class="div-perfil">
          <img id="foto1" src="img/xavi-serio.jpg" class="about-imgL"></img>
          <audio>
            <source src="img/jingel.mp3">

          </audio>
          <div>
            <h1 class="about-text1-imgL">Xavi Galán </h1>
            <h1 id="text1" class="about-text2-imgL">Programador d'elite</h1>
          </div>
        </div>
        <div class="div-perfil">
          <img id="foto2" class="about-imgR" src="img/joel-serio.jpg"></img>
          <audio>
            <source src="img/cancion.mp3">
          </audio>
          <div>
            <h1 class="about-text1-imgR">Joel Donaire </h1>
            <h1 id="text2" class="about-text2-imgR">Programador d'elite</h1>
          </div>
        </div>
        <div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  let imgL = document.getElementById("foto1");
  let imgR = document.getElementById("foto2");
  var audio = document.getElementsByTagName("audio")[0];
  var audio1 = document.getElementsByTagName("audio")[1];



  imgL.addEventListener("mouseover", function (event) {
    imgL.src = "img/xavi-feliz.jpg";
    audio.play();
    document.querySelector("#text1").innerHTML = "Culturista"
  });

  imgL.addEventListener("mouseout", function (event) {
    imgL.src = "img/xavi-serio.jpg";
    audio.pause();
    document.querySelector("#text1").innerHTML = "Programador d'elite"
  });


  imgR.addEventListener("mouseover", function (event) {
    imgR.src = "img/joel-feliz.jpg";
    audio1.play();

    document.querySelector("#text2").innerHTML = "Mecánico"
  });

  imgR.addEventListener("mouseout", function (event) {
    imgR.src = "img/joel-serio.jpg";
    audio1.pause();

    document.querySelector("#text2").innerHTML = "Programador d'elite"
  });


</script>
@endsection