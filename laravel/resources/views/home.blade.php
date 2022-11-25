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
<div class="border row">

    <div class="border">
        barra de buscar
    </div>
    <div class="border ">
        3 cajas
        <div class="border">
            izquierda
        </div>
        <div class="border">
            medio
        </div>
        <div class="border">
            derecha
        </div>
    </div>
</div>
@endsection