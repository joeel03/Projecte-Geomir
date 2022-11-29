@extends('layouts.box-app')

@section('box-title')
{{ __('Post') . " " . $post->id }}
@endsection

@section('box-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview" />
                <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="body">{{ __('fields.body') }}</label>
                        <textarea id="body" name="body" class="form-control">{{ $post->body }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">{{ __('fields.file_id') }}</label>
                        <input type="file" id="upload" name="upload" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="latitude">{{ __('fields.latitude') }}</label>
                        <input type="text" id="latitude" name="latitude" class="form-control"
                            value="{{ $post->latitude }}" />
                    </div>
                    <div class="form-group">
                        <label for="longitude">{{ __('fields.longitude') }}</label>
                        <input type="text" id="longitude" name="longitude" class="form-control"
                            value="{{ $post->longitude }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('fields.Update') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('fields.Reset') }}</button>
                    <form id="form" method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline-block;">
                        @csrf
                        @method("DELETE")
                        <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️ {{ __('Delete') }}</button>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection