@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar Usuario</div>
                    <div class="card-body">
                    <form autocomplete="off" action="/user/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                            <input value="{{$user->name ?? old('name')}}" type="text" class="form-control" id="name" name="name">
                            @if ($errors->has('name'))
                            <small class="form-text text-danger" >{{$errors->first('name')}}</small>
                            @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Motto</label>
                            <input value="{{$user->motto ?? old('motto')}}" type="text" class="form-control" id="name" name="motto">
                            @if ($errors->has('motto'))
                            <small class="form-text text-danger" >{{$errors->first('motto')}}</small>
                            @endif
                            </div>

                            <div class="form-group">
                                @if (file_exists('img/users/'.$user->id.'_large.jpg'))
                                <div class="text-center">    
                                    <img width="150" height="200"  class="img-fluid" src="{{ '/img/users/'.$user->id.'_large.jpg' }}" alt="imagen">   
                                    <p></p>
                                    <div class="text-center">
                                        <a href="/delete-image/user/{{ $user->id }}" class="btn btn-outline-danger">Eliminar</a>
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
                                <label for="description">About Me</label>
                                <textarea class="form-control" id="about_me" name="about_me" rows="5">{{$user->about_me ?? old('about_me')}}</textarea>
                                 @if ($errors->has('about_me'))
                                 <small class="form-text text-danger" >{{$errors->first('about_me')}}</small>
                                 @endif
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Editar Usuario">
                        </form>
                        <a class="btn btn-primary float-right" href="/hobby"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection