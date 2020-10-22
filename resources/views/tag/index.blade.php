@extends('layouts.app');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hobbies</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tags ?? '' as $tag)
                        <li class="list-group-item">
                        <a class="btn btn-{{$tag->estilo}}" title="Show Details" href="/tag/{{$tag->id}} ">{{$tag->nombre}}</a>
                        @can('update', $tag)
                        <a class="btn btn-light text-right list-inline" title="Edit Hobby" href="/tag/{{$tag->id}}/edit">    
                        <i class="fas fa-edit"></i> Editar</a>
                        @endcan  
                        @can('delete', $tag)
                        <form  method="POST" class="float-right" action="/tag/{{$tag->id}}">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-outline-danger" type="submit" value="Eliminar">
                        </form>
                        @endcan  
                        <a class="float-right mx-2" href="/hobby/tag/{{$tag->id}}">Usado {{$tag->hobbies->count()}} veces</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-2">
                    @can('create', $tag)
                    <a class="btn btn-success" href="/tag/create">
                       <i class="fas fa-plus-circle"></i> Crear un nuevo Tag</a>
                        
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection