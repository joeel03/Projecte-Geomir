@extends('layouts.box-app')

@section('box-title')
{{ __('Comentarios') . " " . $comentarios->id }}
@endsection

@section('box-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{ route('comentarios.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="body">{{ __('fields.body') }}</label>
                        <textarea id="body" name="body" class="form-control">{{ $post->body }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('fields.Update') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('fields.Reset') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection