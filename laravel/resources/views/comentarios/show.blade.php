@extends('layouts.box-app')

@section('box-title')
{{ __('Comentario') . " " . $comentario->id }}
@endsection

@section('box-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table">
                    <tr>
                        <td><strong>{{ __('fields.Author') }}</strong></td>
                        <td>{{ $comentario->user->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('Comentario') }}</strong></td>
                        <td>{{ $comentario->body }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('fields.created_at') }}</strong></td>
                        <td>{{ $comentario->created_at }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('fields.Updated') }}</strong></td>
                        <td>{{ $comentario->updated_at }}</td>
                    </tr>
                    </tbody>
                </table>

    <!-- Buttons -->
    <div class="container" style="margin-bottom:20px">

        <form id="form" method="POST" action="{{ route('posts.comentarios.destroy',[$post, $comentario]) }}" style="display: inline-block;">
            @csrf
            @method("DELETE")
            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️ {{ __('Delete') }}</button>
        </form>
        <a class="btn" href="{{ route('posts.comentarios.index',$post) }}" role="button">⬅️ {{ __('Back to list') }}</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Are you sure?') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('You are gonna delete coment ') . $comentario->id }}</p>
                    <p>{{ __('This action cannot be undone!') }}</p>
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
                                <p>{{ __('You are gonna delete comentario ') . $comentario->id }}</p>
                                <p>{{ __('This action cannot be undone!') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary black"  data-bs-dismiss="modal">Close</button>
                                <button id="confirm" type="button" class="btn btn-primary">{{ __('Confirm') }}</button>
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