@extends('layouts.box-app')

@section('box-title')
{{ __('Add place') }}
@endsection

@section('box-content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8 ">
           <div class="card ">
               <div class="card-header ">

                <h1 class="text-center h2 fw-bold">Crear reseña</h1>

                </div >
                <form method="post" class="separar " action="{{ route('places.resenas.store', $place) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" id="title" name="title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">{{ __('File') }}</label>
                        <input type="file" id="upload" name="upload" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="stars">{{ __('Stars') }}</label>
                        <input type="text" id="stars" name="stars" class="form-control"  />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection