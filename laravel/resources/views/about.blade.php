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
      <div id="about" class="about-prueba">
        <div id="div1" class="div-perfil">
          <img id="foto1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"  class="about-imgL" alt="imatge Xavi"></img><!--src="img/xavi-serio.jpg"-->
          <audio>
            <source src="img/jingel.mp3">
          </audio>
          <div>
            <h1 class="about-text1-imgL">Xavi Galán </h1>
            <h1 id="text1" class="about-text2-imgL">Programador d'elite</h1>
          </div>
        </div>
        <div class="div-perfil" id="div2">
          <img id="foto2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="about-imgR" alt="imatge Joel"></img><!--src="img/joel-serio.jpg"-->
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <video width="100%" height="100%" autoplay muted controls >
                <source src="img/Presentacion.mp4" type="video/mp4">
              </video>
            </div>
            <div class="carousel-item">
              <video width="100%" height="100%" controls>
                <source src="img/anuncio.mp4" type="video/mp4">
              </video>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleControls2" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <video width="100%" height="100%" autoplay muted controls>
                <source src="img/messi.mp4" type="video/mp4">
              </video>
            </div>
            <div class="carousel-item">
              <video width="100%" height="100%" controls>
                <source src="img/suu.mp4" type="video/mp4">
              </video>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
<script>
  dragula([document.getElementById("about")]);
  let imgL = document.getElementById("foto1");
  let imgR = document.getElementById("foto2");
  var audio = document.getElementsByTagName("audio")[0];
  var audio1 = document.getElementsByTagName("audio")[1];


  const videos = document.getElementsByTagName("video");
  const prevBtn = document.getElementsByClassName("carousel-control-prev")[0]
  const nextBtn = document.getElementsByClassName("carousel-control-next")[0]

  var cur = 0
  const max = videos.length
  console.log("🎬 Total videos: " + max)

  const playVideos = function() {
    // Pause all videos
    for (v = 0; v < max; v++) {
      videos[v].pause();
    }
    // Play current video
    console.log("🎬 PLAY VIDEO " + cur)
    videos[cur].play()
  }

  prevBtn.addEventListener("click", function() {
    cur = (cur - 1 >= 0) ? cur - 1 : max
    playVideos()
  })

  nextBtn.addEventListener("click", function() {
    cur = (cur + 1 < max) ? cur + 1 : 0
    playVideos()
  })




  imgL.addEventListener("mouseover", function(event) {
    imgL.src = "img/xavi-feliz.jpg";
    audio.play();
    document.querySelector("#text1").innerHTML = "Culturista"
  });

  imgL.addEventListener("mouseout", function(event) {
    imgL.src = "img/xavi-serio.jpg";
    audio.pause();
    document.querySelector("#text1").innerHTML = "Programador d'elite"
  });


  imgR.addEventListener("mouseover", function(event) {
    //imgR.src = "img/joel-feliz.jpg";
    audio1.play();
    document.querySelector("#text2").innerHTML = "Mecanico"
  });

  imgR.addEventListener("mouseout", function(event) {
   // imgR.src = "img/joel-serio.jpg";
    audio1.pause();
    document.querySelector("#text2").innerHTML = "Programador d'elite"

  });
</script>
@endsection