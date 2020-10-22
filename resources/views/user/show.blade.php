@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header"><h3>{{ $user->name }}</h3></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                           
                            <h5><b>Motto</b> </h5>
                            <p><p>{{ $user->motto ?? '' }}</p></p>
                            <h5> <b>"About Me"</b> </h5>
                            <p><p>{{ $user->about_me ?? '' }}</p></p>
                        </div>
                        <div class="col-md-3">
                            @if (file_exists('img/users/'.$user->id.'_large.jpg'))
                            @auth
                            <img class="img-thumbnail" src="/img/users/{{ $user->id }}_large.jpg" alt="{{$user->id}}">
                            @else
                            <img class="img-thumbnail" src="/img/users/{{ $user->id }}_pixelate.jpg" alt="{{$user->id}}">
                            @endauth
                            @else
                            <img class="img-thumbnail" src="/img/300x400.jpg" alt="{{$user->id}}">
                            @endif
                        </div>
                    </div>

                    @isset($hobbies)
                        @if($hobbies->count() > 0)
                        <h3>Hobbies de {{ $user->name }}</h3>
                        @endif
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                            <li class="list-group-item">
                                <a title="Show Details" href="/hobby/{{ $hobby->id }}">
                                    
                                    {{ $hobby->nombre }}
                                </a>
                                @auth
                                    <a class="btn btn-sm btn-light ml-2" href="/hobby/{{ $hobby->id }}/edit"><i class="fas fa-edit"></i> Editar Hobby</a>
                                @endauth

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
                                    <a href="/hobby/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->estilo }}">{{ $tag->nombre }}</span></a>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                    @endisset

                    <a class="btn btn-success btn-sm" href="/hobby/create"><i class="fas fa-plus-circle"></i> Create new Hobby</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
