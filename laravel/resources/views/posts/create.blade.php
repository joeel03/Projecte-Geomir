@extends('layouts.box-app')

@section('box-title')
{{ __('Add post') }}
@endsection

@section('box-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="border posts">
                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="body">{{ __('fields.body') }}</label>
                            <textarea id="body" name="body" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="upload">{{ __('fields.file_id') }}</label>
                            <input type="file" id="upload" name="upload" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="latitude">{{ __('fields.latitude') }}</label>
                            <input type="text" id="latitude" name="latitude" class="form-control" value="41.2310371" />
                        </div>
                        <div class="form-group">
                            <label for="longitude">{{ __('fields.longitude') }}</label>
                            <input type="text" id="longitude" name="longitude" class="form-control" value="1.7282036" />
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('fields.Create') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('fields.Reset') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection