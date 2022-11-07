@extends('layouts.app')
 
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Post') }}</div>
               <div class="card-body">
                    <form method="post" action="{{ route('post.update',$post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">Body</td>
                                    <td scope="col">File</td>
                                    <td scope="col">Latitude</td>
                                    <td scope="col">Longitude</td>
                                    <td scope="col">Visibility</td>
                                    <td scope="col">Author</td>
                                    <td scope="col">Created</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>{{ $post->file_id }}</td>
                                    <td>{{ $post->latitude }}</td>
                                    <td>{{ $post->longitude }}</td>
                                    <td>{{ $post->visibility_id }}</td>
                                    <td>{{ $post->author_id }}</td>
                                    <td>{{ $post->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="body">Body</label><br>
                            <input type="text" id="body" name="body"><br>
                            <label for="latitude">Latitude</label><br>
                            <input type="text" id="latitude" name="latitude"><br>
                            <label for="longitude">Longitude</label><br>
                            <input type="text" id="longitude" name="longitude"><br>
                            <label for="visibility_id">Visibility</label><br>
                            <input type="text" id="visibility_id" name="visibility_id"><br>
                            <label for="upload">Update</label>
                            <input type="file" class="form-control" name="upload"/>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
           </div>
       </div>
   </div>
</div>
@endsection