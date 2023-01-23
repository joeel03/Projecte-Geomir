@extends('layouts.box-app')

@section('box-title')
{{ __('posts') . " " . $post->id }}
@endsection

@section('box-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <img class="img-posts-show" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview" width="300px" />
                <table class="table">
                    <tr>
                        <td><strong>{{ __('fields.body') }}</strong></td>
                        <td>{{ $post->body }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('fields.Author') }}</strong></td>
                        <td>{{ $author->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lat</strong></td>
                        <td>{{ $post->latitude }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lng</strong></td>
                        <td>{{ $post->longitude }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('fields.created_at') }}</strong></td>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('fields.Updated') }}</strong></td>
                        <td>{{ $post->updated_at }}</td>
                    </tr>
                    </tbody>
                </table>

    <!-- Buttons -->
    <div class="container" style="margin-bottom:20px">
        <a class="btn btn-warning" href="{{ route('posts.edit', $post) }}" role="button">📝 {{ __('Edit') }}</a>
        <form id="form" method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline-block;">
            @csrf
            @method("DELETE")
            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️ {{ __('Delete') }}</button>
        </form>
        <a class="btn" href="{{ route('home') }}" role="button">⬅️ {{ __('Back to list') }}</a>
    </div>

                <!-- Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Are you sure?') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>{{ __('You are gonna delete post ') . $post->id }}</p>
                                <p>{{ __('This action cannot be undone!') }}</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button id="confirm" type="button" class="btn btn-primary">{{ __('Confirm')
                                        }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @vite('resources/js/delete-modal.js')
            </div>
        </div>
    </div>
</div>
@endsection