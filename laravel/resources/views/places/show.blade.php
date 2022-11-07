@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Places</div>
                <div class="card-body">
                <form method="post" action="{{ route('places.destroy',$place) }}" enctype="multipart/form-data" >
                @csrf     
                @method('delete')
                   <table class="table">
                       <thead>
                           <tr>
                                <td scope="col">ID</td>
                                <td scope="col">name</td>
                                <td scope="col">description</td>
                                <td scope="col">file_id</td>
                                <td scope="col">latitude</td>
                                <td scope="col">longitude</td>
                                <td scope="col">category_id</td>
                                <td scope="col">visibility_id</td>
                                <td scope="col">author_id</td>
                                <td scope="col">created_at</td>
                                <td scope="col">updated_at</td>
                           </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $place->id }}</td>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->description }}</td>
                                <td>{{ $place->file_id }}</td>
                                <td>{{ $place->latitude }}</td>
                                <td>{{ $place->longitude }}</td>
                                <td>{{ $place->category_id }}</td>
                                <td>{{ $place->visibility_id }}</td>
                                <td>{{ $place->author_id }}</td>
                                <td>{{ $place->created_at }}</td>
                                <td>{{ $place->updated_at }}</td>
                            </tr>
                            
                        </tbody>

                    </table>
                    <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
                    <br>
                    <a class="btn btn-primary" href="{{ route('places.edit',$place) }}" role="button" >Edit</a>
                    
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

