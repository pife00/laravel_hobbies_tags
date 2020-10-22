@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">

                    @isset($filter)
                        <div class="card-header">Filtered hobbies by
                            <span style="font-size: 130%;" class="badge badge-{{ $filter->estilo }}">{{ $filter->nombre }}</span>
                            <span class="float-right"><a href="/hobby">Mostrar todos los hobbies</a></span>
                        </div>
                    @else
                        <div class="card-header">Todos los hobbies</div>
                    @endisset

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($hobbies as $hobby)
                                <li class="list-group-item">
                                    @if (file_exists('img/hobbies/'.$hobby->id.'_thumb.jpg'))           
                                    <a title="Show Details" href="/hobby/{{ $hobby->id }}">
                                        <img src="{{ '/img/hobbies/'.$hobby->id.'_thumb.jpg' }}" alt="thumb">
                                        {{ $hobby->nombre }}
                                    </a>
                                    @else
                                    <a title="Show Details" href="/hobby/{{ $hobby->id }}">
                                        <img src="/img/thumb_landscape.jpg" alt="thumb">
                                        {{ $hobby->nombre }}
                                    </a>
                                    @endif

                                    @auth
                                    <a class="btn btn-sm btn-light ml-2" href="/hobby/{{ $hobby->id }}/edit"><i class="fas fa-edit"></i> Editar Hobby</a>
                                    @endauth
                                    @if (file_exists('img/users/'. $hobby->user->id.'_thumb.jpg'))
                                    <span class="mx-2">Posteado por: <a href="/user/{{ $hobby->user->id }}">{{ $hobby->user->name }} ({{ $hobby->user->hobbies->count() }} Hobbies)</a>
                                    <a href="/user/{{ $hobby->user->id }}"><img class="rounded" src="/img/users/{{ $hobby->user->id }}_thumb.jpg"></a>
                                    </span>
                                    @else
                                    <span class="mx-2">Posteado por: <a href="/user/{{ $hobby->user->id }}">{{ $hobby->user->name }} ({{ $hobby->user->hobbies->count() }} Hobbies)</a>
                                    <a href="/user/{{ $hobby->user->id }}"><img class="rounded" src="/img/thumb_portrait.jpg"></a>
                                    </span>
                                    @endif

                                    @auth
                                    <form class="float-right" style="display: inline" action="/hobby/{{ $hobby->id }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <input class="btn btn-sm btn-outline-danger" type="submit" value="Eliminar">
                                    </form>
                                    @endauth
                                    <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                                    <br>
                                    @foreach($hobby->tags as $tag)
                                    <h3 style="display: inline">
                                        
                                        <a href="/hobby/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->estilo }}">{{ $tag->nombre }}</span></a>
                                    </h3>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $hobbies->links() }}
                </div>
                @auth
                <div class="mt-2">
                    <a class="btn btn-success btn-sm" href="/hobby/create"><i class="fas fa-plus-circle"></i> Crear nuevo Hobby</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
@endsection