@extends('layouts.app');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles</div>
                <div class="card-body">
                <b>{{$tag->nombre}}</b>
                  @php
                  $tags = 
                  ['Ocio'=>'sucess',
                  'Deporte'=>'danger',
                  'informacion'=>'info',
                  'Estudio'=>'light'                                    
                   ]; 
                   @endphp 
                   @foreach ($tags as $item=>$value)
                   @if ($value == $tag->estilo)
                   <p>{{$item}}</p>
                   @endif
                   @endforeach
                </div>
            </div>
            <div class="mt-2">
             <a class="btn btn-primary " href="/hobby">
            <i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection