@extends('layouts.box-app')

@section('box-title')
{{ __('resena') . " " . $resena->id }}
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

                    <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview"
                        width="300px" />

                    <table class="table">
                        <tr>
                            <td><strong>ID<strong></td>
                            <td>{{ $resena->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Title')}}</strong></td>
                            <td>{{ $resena->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('fields.Description')}}</strong></td>
                            <td>{{ $resena->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ __('fields.Stars')}}</strong></td>

                            <td><?php 
                            for($i=0;$i<$estrellas;$i++){
                                echo "&#11088";
                            }?>   
                               
                            </td>
                            <!-- <td>{{ $resena->stars }}</td> -->
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Author')}}</strong></td>
                            <td>{{ $author->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('Place')}}</strong></td>
                            <td>{{ $place->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Created')}}</strong></td>
                            <td>{{ $resena->created_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('fields.Updated')}}</strong></td>
                            <td>{{ $resena->updated_at }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Buttons -->        
                    @if($resena->author_id==$id)
                   
                    <div class="container" style="margin-bottom:20px">

                        <form id="form" method="POST" action="{{ route('places.resenas.destroy',[$place,$resena]) }}"
                            style="display: inline-block;">
                            @csrf
                            @method("DELETE")
                            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmModal">🗑️ {{ __('Delete') }}</button>
                        </form>
                        @endif

                        <a class="btn" href="{{ route('places.resenas.index',$place) }}" role="button">⬅️
                            {{ __('Back to list') }}</a>

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
                                    <p>{{ __('You are gonna delete post ') . $resena->id }}</p>
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