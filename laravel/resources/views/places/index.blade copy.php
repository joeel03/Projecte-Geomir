@extends('layouts.box-app')

@section('box-title')
    {{ __('Llocs favorits') }}
@endsection

@section('box-content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
               <div class="card-header">
                   @yield('box-title')
               </div>
    <div class="table-responsive ">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">{{__('fields.name')}}</td>
                    <td scope="col">{{__('fields.description')}}</td>
                    <td scope="col">{{__('fields.file_id')}}</td>
                    <td scope="col">{{__('fields.latitude')}}</td>
                    <td scope="col">{{__('fields.longitude')}}</td>
                    <td scope="col">{{__('fields.created_at')}}</td>
                    <td scope="col">{{__('fields.updated_at')}}</td>
                    <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $place)
                <tr>
                    <td>{{ $place->id }}</td>
                    <td>{{ $place->name }}</td>
                    <td>{{ substr($place->description,0,10) . "..." }}</td>
                    <td>{{ $place->file_id }}</td>
                    <td>{{ $place->latitude }}</td>
                    <td>{{ $place->longitude }}</td>
                    <td>{{ $place->created_at }}</td>
                    <td>{{ $place->updated_at }}</td>
                    <td>
                        <a title="{{ _('View') }}" href="{{ route('places.show', $place) }}">👁️</a>
                        <a title="{{ _('Edit') }}" href="{{ route('places.edit', $place) }}">📝</a>
                        <a title="{{ _('Delete') }}" href="{{ route('places.show', [$place, 'delete' => 1]) }}">🗑️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{ route('places.create') }}" role="button">➕ {{ _('Add new place') }}</a>

    </div>
</div>
</div>
</div>
</div>
</div>
    
@endsection