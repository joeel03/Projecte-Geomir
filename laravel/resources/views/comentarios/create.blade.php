@extends('layouts.box-app')

@section('box-title')
{{ __('Add coment') }}
@endsection

@section('box-content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8 ">
           <div class="card ">
               <div class="card-header ">

                <h1 class="text-center h2 fw-bold">Añadir Comentario</h1>

                </div >
                <form method="post" class="separar " action="{{ route('comentarios.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="body">{{ __('fields.body') }}</label>
                        <textarea id="body" name="body" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection