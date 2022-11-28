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

                <h1 class="text-center h2 fw-bold">Crear sitio</h1>

                </div >
                <form method="post" class="separar " action="{{ route('places.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" />
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
                        <label for="latitude">{{ __('Latitude') }}</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" value="41.2310371" />
                    </div>
                    <div class="form-group">
                        <label for="longitude">{{ __('Longitude') }}</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" value="1.7282036" />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection