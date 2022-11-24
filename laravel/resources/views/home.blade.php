@extends('layouts.box-app')

@section('box-title')
{{ __('Dashboard') }}
@endsection

@section('box-content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="border row ">
    <div class="border">
    <form >
      <input class=" mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>    
</div>
    <div class="border row">
        <div class="border col-md-4">
            izquierda
        </div>
        <div class="border col-md-4">
            medio
        </div>
        <div class="border col-md-4">
            derecha
        </div>
    </div>
</div>
@endsection