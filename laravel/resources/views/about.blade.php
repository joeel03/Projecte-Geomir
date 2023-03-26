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
        <!--Crear foto izquierda para introducir id para javascript  -->
          <img id="foto1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"  class="about-imgL" alt="imatge Xavi"></img><!--src="img/xavi-serio.jpg"-->
          <!--Crear audio para introducir id para javascript  -->
          <audio>
            <source src="img/jingel.mp3">
          </audio>
          <div>
            <h1 class="about-text1-imgL">Xavi Galán </h1>
            <!--Crear foto texto izquierda para introducir id para javascript  -->
            <h1 id="text1" class="about-text2-imgL">Programador d'elite</h1>
          </div>
        </div>
        <div class="div-perfil" id="div2">
          <!--Crear foto derecha para introducir id para javascript  -->
          <img id="foto2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="about-imgR" alt="imatge Joel"></img><!--src="img/joel-serio.jpg"-->
          <!--Crear audio para introducir id para javascript  -->
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

<!--Crear modal para la imagen de la izquierda con id exampleModal  -->
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

<!--Crear modal para la imagen de la derecha con id exampleModal2  -->
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
  <!--Boton para activar reconocimiento de voz  -->
  <button id="recvoz">Iniciar Reconocimiento de Voz</button>
	<p id="desvoz"></p>

</div>

<script>
  //Constante de boton para reconocer a través de la id recvoz
		const recvoz = document.getElementById("recvoz");
		const desvoz = document.getElementById("desvoz");
		const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  //Constante que hay que definir para poder reconocer voz
		const recognition = new SpeechRecognition();
    
    //Constante que indica que esta escuchando
		recognition.onstart = function() {
			recvoz.disabled = true;
			recvoz.textContent = "Escuchando...";
		}

		recognition.onresult = function(event) {
			const transcript = event.results[0][0].transcript.toLowerCase();
			desvoz.textContent = transcript;
			executeCommand(transcript);
			recvoz.disabled = false;
			recvoz.textContent = "Iniciar Reconocimiento de Voz";
		}

		function executeCommand(command) {
			if (command.includes("bajar") || command.includes("scroll hacia abajo")) {
				window.scrollBy(0, 100);
			} else if (command.includes("subir") || command.includes("scroll hacia arriba")) {
				window.scrollBy(0, -100);
			} else if (command.includes("ampliar") || command.includes("aumentar zoom")) {
				document.body.style.zoom = parseFloat(document.body.style.zoom) + 0.1;
			} else if (command.includes("reducir") || command.includes("disminuir zoom")) {
				document.body.style.zoom = parseFloat(document.body.style.zoom) - 0.1;
			} else if (command.includes("restaurar") || command.includes("volver al inicio")) {
				document.body.style.zoom = 1;
				window.scrollTo(0, 0);
			}
		}

		btn.addEventListener("click", function() {
			recognition.start();
		});
	</script>

  
<!--Definir dragula  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
<script>
  //Definir variables del dragula por id about
  dragula([document.getElementById("about")]);
  //Definir variables de imagenes por id foto1
  let imgL = document.getElementById("foto1");
  let imgR = document.getElementById("foto2");
  //Definir variables de imagenes por id foto2
  var audio = document.getElementsByTagName("audio")[0];
  //Definir variables de audio por elemento audio
  var audio1 = document.getElementsByTagName("audio")[1];
  //Definir variables de audio1 por el elemento audio

  //Definir variables de videos por el elemento video
  const videos = document.getElementsByTagName("video");
//Definir variables carousel para pasar pagina y retroceder
  const prevBtn = document.getElementsByClassName("carousel-control-prev")[0]
  const nextBtn = document.getElementsByClassName("carousel-control-next")[0]

  var cur = 0
  const max = videos.length
  console.log("🎬 Total videos: " + max)

  const playVideos = function() {
    // Puasar todos los videos
    for (v = 0; v < max; v++) {
      videos[v].pause();
    }
    // Eejcutar video
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



// Cuando poner el raton sobre la imagen de xavi se ejecuta el audio
  imgL.addEventListener("mouseover", function(event) {
    imgL.src = "img/xavi-feliz.jpg";
    audio.play();
    document.querySelector("#text1").innerHTML = "Culturista"
  });

// Cuando sacas el raton sobre la imagen de xavi se pausa el audio
  imgL.addEventListener("mouseout", function(event) {
    imgL.src = "img/xavi-serio.jpg";
    audio.pause();
    document.querySelector("#text1").innerHTML = "Programador d'elite"
  });

// Cuando sacas el raton sobre la imagen de joel se pausa el audio
  imgR.addEventListener("mouseover", function(event) {
    //imgR.src = "img/joel-feliz.jpg";
    audio1.play();
    document.querySelector("#text2").innerHTML = "Mecanico"
  });

// Cuando sacas el raton sobre la imagen de joel se pausa el audio
  imgR.addEventListener("mouseout", function(event) {
   // imgR.src = "img/joel-serio.jpg";
    audio1.pause();
    document.querySelector("#text2").innerHTML = "Programador d'elite"

  });
</script>
@endsection