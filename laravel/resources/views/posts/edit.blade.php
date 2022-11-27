@extends('layouts.box-app')

@section('box-title')
    {{ __('Post') . " " . $post->id }}
@endsection

@section('box-content')

    <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview"/>
    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="body">{{ _('fields.body') }}</label>
            <textarea id="body" name="body" class="form-control">{{ $post->body }}</textarea>
        </div>
        <div class="form-group">
            <label for="upload">{{ _('fields.file_id') }}</label>
            <input type="file" id="upload" name="upload" class="form-control" />
        </div>
        <div class="form-group">            
                <label for="latitude">{{ _('fields.latitude') }}</label>
                <input type="text" id="latitude" name="latitude" class="form-control"
                    value="{{ $post->latitude }}"/>
        </div>
        <div class="form-group">            
                <label for="longitude">{{ _('fields.longitude') }}</label>
                <input type="text" id="longitude" name="longitude" class="form-control"
                    value="{{ $post->longitude }}"/>
        </div>
        <button type="submit" class="btn btn-primary">{{ _('Update') }}</button>
        <button type="reset" class="btn btn-secondary">{{ _('fields.Reset') }}</button>
    </form>
@endsection