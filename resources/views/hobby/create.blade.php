@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crear Hobby</div>
                    <div class="card-body">
                        <form autocomplete="off" action="/hobby" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                            <input value="" type="text" class="form-control" id="name" name="nombre">
                            @if ($errors->has('nombre'))
                            <small class="form-text text-danger" >{{$errors->first('nombre')}}</small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Imagen</label>
                            <input value="{{old('imagen')}}" type="file" class="form-control" name="imagen">
                            @if ($errors->has('imagen'))
                            <small class="form-text text-danger" >{{$errors->first('imagen')}}</small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Descricion</label>
                                <textarea class="form-control" id="description" name="descripcion" rows="5">{{old('descripcion')}}</textarea>
                                 @if ($errors->has('descripcion'))
                                 <small class="form-text text-danger" >{{$errors->first('descripcion')}}</small>
                                 @endif
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save Hobby">
                        </form>
                        <a class="btn btn-primary float-right" href="/hobby"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection