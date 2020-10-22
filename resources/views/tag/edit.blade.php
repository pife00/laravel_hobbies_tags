@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar Tag</div>
                    <div class="card-body">
                        <form action="/tag/{{$tag->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                            <input value="{{$tag->nombre ?? old('nombre')}}" type="text" class="form-control" id="name" name="nombre">
                            @if ($errors->has('nombre'))
                            <small class="form-text text-danger" >{{$errors->first('nombre')}}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Estilo</label>
                                <select multiple class="form-control" name="estilo" id="">
                                    @php
                                    $tags = 
                                    ['Ocio'=>'success',
                                    'Deporte'=>'danger',
                                    'informacion'=>'info',
                                    'Estudio'=>'light'                                    
                                    ]; 
                                    @endphp 
                                    @foreach ($tags as $item => $value)
                                    @if($value == $tag->estilo)
                                    <option selected='selected' value="{{$value}}">{{$item}}</option>
                                    @else
                                     <option value="{{$value}}" >{{$item}}</option>
                                    @endif
                                
                                    @endforeach
                                </select>
                                 @if ($errors->has('descripcion'))
                                 <small class="form-text text-danger" >{{$errors->first('estilo')}}</small>
                                 @endif
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Guardar Tag">
                        </form>
                        <a class="btn btn-primary float-right" href="/tag"><i class="fas fa-arrow-circle-up"></i> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection