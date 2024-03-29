@extends('layouts.box-app')

@section('box-title')
{{ __('Place') . " " . $place->id }}
@endsection

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
@section('box-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview" width="300px" />
                    <table class="table">
                        <tr>
                            <td><strong>ID<strong></td>
                            <td>{{ $place->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Name')}}</strong></td>
                            <td>{{ $place->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('fields.Description')}}</strong></td>
                            <td>{{ $place->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Lat</strong></td>
                            <td>{{ $place->latitude }}</td>
                        </tr>
                        <tr>
                            <td><strong>Lng</strong></td>
                            <td>{{ $place->longitude }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Author')}}</strong></td>
                            <td>{{ $author->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Created')}}</strong></td>
                            <td>{{ $place->created_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Updated')}}</strong></td>
                            <td>{{ $place->updated_at }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Buttons -->
                    <div class="container" style="margin-bottom:20px">
                        <a class="btn btn-warning" href="{{ route('places.edit', $place) }}" role="button">📝 {{
                            __('Edit') }}</a>
                        <form id="form" method="POST" action="{{ route('places.destroy', $place) }}"
                            style="display: inline-block;">
                            @csrf
                            @method("DELETE")
                            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmModal">🗑️ {{ __('Delete') }}</button>
                        </form>
                        <a class="btn" href="{{ route('places.index') }}" role="button">⬅️ {{ __('Back to list') }}</a>

                        @if($place->comprovarfavorite())
                        <form method="post" style="display: inline-block;"
                            action="{{ route('places.favorite',$place) }}" enctype="multipart/form-data">
                            @csrf
                            <button id="quitar" type="submit"><i class="fa-regular fa-star"></i></button>
                        </form>
                        @else
                        <form method="post" style="display: inline-block;"
                            action="{{ route('places.unfavorite',$place) }}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-primary"><i class="fa-solid fa-star"></i></button>
                        </form>
                        @endif
                        <a class="btn btn-primary" href="{{ route('places.resenas.index', $place) }}" role="button">Reseñas</a>


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
                                    <p>{{ __('You are gonna delete post ') . $place->id }}</p>
                                    <p>{{ __('This action cannot be undone!') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button id="confirm" type="button" class="btn btn-primary">{{ __('Confirm')
                                        }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @env(['local','development'])
                        @vite('resources/js/delete-modal.js')
                    @endenv
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection