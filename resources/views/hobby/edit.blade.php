@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Hobby</div>
                    <div class="card-body">
                    <form autocomplete="off" action="/hobby/{{$hobby->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                            <input value="{{$hobby->nombre ?? old('nombre')}}" type="text" class="form-control" id="name" name="nombre">
                            @if ($errors->has('nombre'))
                            <small class="form-text text-danger" >{{$errors->first('nombre')}}</small>
                            @endif
                            </div>

                            <div class="form-group">
                                @if (file_exists('img/hobbies/'.$hobby->id.'_large.jpg'))
                                <div class="text-center">    
                                    <img width="150" height="200"  class="img-fluid" src="{{ '/img/hobbies/'.$hobby->id.'_large.jpg' }}" alt="imagen">   
                                    <p></p>
                                    <div class="text-center">
                                        <a href="/delete-image/hobby/{{ $hobby->id }}" class="btn btn-outline-danger">Eliminar</a>
                                    </div>
                                </div>
                                @endif     
                                <label for="name">Imagen</label>
                            <input value="{{old('imagen')}}" type="file" class="form-control" name="imagen">
                            @if ($errors->has('imagen'))
                            <small class="form-text text-danger" >{{$errors->first('imagen')}}</small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="descripcion" rows="5">{{$hobby->descripcion ?? old('descripcion')}}</textarea>
                                 @if ($errors->has('descripcion'))
                                 <small class="form-text text-danger" >{{$errors->first('descripcion')}}</small>
                                 @endif
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Editar Hobby">
                        </form>
                        <a class="btn btn-primary float-right" href="/hobby"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection