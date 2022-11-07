<!--
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
   </ul>
</div>
@endif
-->
@extends('layouts.app')
 
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Places</div>
               <div class="card-body">
                    <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Nombre</label><br>
                        <input type="text" id="name" name="name" ><br>
                        <label for="description">Descripcion</label><br>
                        <input type="text" id="description" name="description" ><br><br>
                        <label for="upload">Archivo</label><br>
                        <input type="file" id="upload" name="upload" ><br>
                        <label for="latitude">Latitud</label><br>
                        <input type="text" id="latitude" name="latitude" ><br><br>
                        <label for="longitude">Longitud</label><br>
                        <input type="text" id="longitude" name="longitude" ><br>
                        <label for="category_id">Categoria</label><br>
                        <input type="text" id="category_id" name="category_id" ><br><br>
                        <label for="visibility_id">Visibilidad</label><br>
                        <input type="text" id="visibility_id" name="visibility_id" ><br><br>

                        <button type="submit" class="btn btn-primary">Create </button>
                        <button type="reset" class="btn btn-primary">Reset </button>

                    </form>
                </div>
           </div>
       </div>
   </div>
</div>

@endsection