@extends('layouts.box-app')

@section('posts')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header borde">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<link href = "https://fonts.googleapis.com/css?family=Montserrat" rel = "stylesheet" >  

        @foreach ($posts as $post)
        <div class="border posts">
            <div class="boton-black"> 
                <div>
                    <i class="fa-solid fa-user"></i> {{$post->user->name }}
                </div>
                <div>
                    <a href="{{ route('posts.edit', $post) }}" class="boton-black" style="font-size:25px;"type="submit"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                </div>
            </div>
            <div class="imagen-posts"> 
                    @foreach ($files as $file)
                        @if($file->id == $post->file_id)
                            <div class="div-foto-post">
                                    <img class="img-posts" src='{{ asset("storage/{$file->filepath}") }}'/>
                            </div>
                        @endif
                    @endforeach
            </div>

            <div class="boton-posts"> 
                <div>
                    <form method="post" action="{{ route('posts.likes',$post) }}" enctype="multipart/form-data">
                        @csrf
                        <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fa-regular fa-heart"></i></button>
                        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit">COMENTARIOS </a>
                        <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-square-share-nodes"></i> </a>
                    </form>
                </div>
            </div>
            <div class="texto">
                 {{ $post->body }} 
            </div>
        </div>
        @endforeach
@endsection