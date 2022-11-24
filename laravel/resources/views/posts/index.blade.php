@extends('layouts.box-app')

@section('box-title')
    {{ __('Files') }}
@endsection

@section('box-content')
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">{{__('fields.body')}}</td>
                    <td scope="col">{{__('fields.file_id')}}</td>
                    <td scope="col">{{__('fields.latitude')}}</td>
                    <td scope="col">{{__('fields.longitude')}}</td>
                    <td scope="col">{{__('fields.created_at')}}</td>
                    <td scope="col">{{__('fields.updated_at')}}</td>
                    <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ substr($post->body,0,10) . "..." }}</td>
                    <td>{{ $post->file_id }}</td>
                    <td>{{ $post->latitude }}</td>
                    <td>{{ $post->longitude }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <a title="{{ _('View') }}" href="{{ route('posts.show', $post) }}">👁️</a>
                        <a title="{{ _('Edit') }}" href="{{ route('posts.edit', $post) }}">📝</a>
                        <a title="{{ _('Delete') }}" href="{{ route('posts.show', [$post, 'delete' => 1]) }}">🗑️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a class="btn btn-primary" href="{{ route('posts.create') }}" role="button">➕ {{ _('Add new post') }}</a>
@endsection