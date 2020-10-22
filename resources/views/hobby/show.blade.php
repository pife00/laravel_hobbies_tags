@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Hobby Detail</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <b>{{$hobby->nombre}}</b>
                                <p>{{$hobby->descripcion}}</p>
                                @if($hobby->tags->count() > 0)
                                    <b>Tags Usados:</b> (Click para remover)
                                    <p>
                                        @foreach($hobby->tags as $tag)
                                            <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/detach"><span class="badge badge-{{ $tag->estilo }}">{{ $tag->nombre }}</span></a>
                                        @endforeach
                                    </p>
                                @endif

                                @if($availableTags->count() > 0)
                                    <b>Tags Disponibles:</b> (Click para añadir)
                                    <p>
                                        @foreach($availableTags as $tag)
                                            <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/attach"><span class="badge badge-{{ $tag->estilo }}">{{ $tag->nombre }}</span></a>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if (file_exists('img/hobbies/'.$hobby->id.'_large.jpg'))
                                @auth
                                <a href="{{ '/img/hobbies/'.$hobby->id.'_large.jpg' }}" data-lightbox="400x300.jpg" data-title="{{ $hobby->nombre }}">
                                    <img class="img-fluid" src="{{ '/img/hobbies/'.$hobby->id.'_large.jpg' }}" alt="">
                                </a>
                                <i class="fa fa-search-plus"></i> Click para ampliar
                                @else
                                <a href="{{ '/img/hobbies/'.$hobby->id.'_pixalate.jpg' }}" data-lightbox="400x300.jpg" data-title="{{ $hobby->nombre }}">
                                    <img class="img-fluid" src="{{ '/img/hobbies/'.$hobby->id.'_pixalate.jpg' }}" alt="">
                                </a>
                                <i class="fa fa-search-plus"></i> Click para ampliar
                                @endauth
                                @else
                                <a href="/img/400x300.jpg" data-lightbox="400x300.jpg" data-title="{{ $hobby->nombre }}">
                                        <img class="img-fluid" src="/img/400x300.jpg" alt="">
                                    </a>
                                    <i class="fa fa-search-plus"></i> Click para ampliar
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="mt-2">
                    <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Back to Overview</a>
                </div>
                -->
            </div>
        </div>
    </div>
@endsection