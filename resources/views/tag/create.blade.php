@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crear Tag</div>
                    <div class="card-body">
                        <form action="/tag" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                            <input value="{{old('nombre')}}" type="text" class="form-control" id="name" name="nombre">
                            @if ($errors->has('nombre'))
                            <small class="form-text text-danger" >{{$errors->first('nombre')}}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Estilo</label>
                                <select multiple class="form-control" name="estilo" id="">
                                    <option value="success">Ocio</option>
                                    <option value="danger">Deporte</option>
                                    <option value="info">Informacion</option>
                                    <option value="light">Estudio</option>
                                </select>
                                 @if ($errors->has('estilo'))
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