@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard: <b>{{ auth()->user()->role}} </b> </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>Hola {{ auth()->user()->name }}</h2>
                            <h5><b>Motto</b> </h5>
                            <p><p>{{ auth()->user()->motto ?? '' }}</p></p>
                            <h5><b>About Me</b></h5>
                            <p><p>{{ auth()->user()->about_me ?? '' }}</p></p>
                            <a href="/user/{{ auth()->user()->id }}/edit" class="btn btn-outline-primary">Editar Perfil</a>
                        </div>
                        <div class="col-md-3">
                            @if(file_exists("img/users/".auth()->user()->id."_large.jpg"))
                            <img class="img-thumbnail" src="/img/users/{{ auth()->user()->id }}_large.jpg" alt="{{ auth()->user()->name }}">
                            @else
                            <img class="img-thumbnail" src="/img/300x400.jpg" alt="{{ auth()->user()->name }}">
                            @endif
                        </div>
                        
                    </div>



                    @isset($hobbies)
                        @if($hobbies->count() > 0)
                        <h3>Your Hobbies:</h3>
                        @endif
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
                                        <img src="{{ 'img/thumb_landscape.jpg' }}" alt="thumb">
                                        {{ $hobby->nombre }}
                                    </a>
                                    @endif
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
