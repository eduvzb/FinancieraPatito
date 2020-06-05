@extends('layouts.app')

@section('content')
<div class="row  ">
    <div class="col-sm-8 col-md-8 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3>Editar usuario</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('clients.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if( session('message'))
                <div class="alert alert-success" role="alert" id="alert">
                    {{ session('message')}}
                </div>
                @endif
            <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group form-row">
                        <img src="{{ asset( 'storage/img/'.Auth::user()->picture) }}" alt="asd" width="200 px" >
                    </div>
                    <div class="form-group form-row">
                        <div class=" col-md-6">
                            <label for="picture">Nombre</label>
                            <input type="file" name="picture" id="picture" class="form-control @error('picture') is-invalid @enderror">
                            @error('picture')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class=" col-md-6">
                            <label for="name">Nombre</label>
                            <input value="{{ Auth::user()->name }}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">   
                        <div class="col-md-6">
                            <label for="phone">Correo</label>
                            <input value="{{ Auth::user()->email  }}" type="email" name="email" id="email"class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Actualizar</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('users.update_password') }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class=" col-md-6">
                            <label for="name">Contraseña actual</label>
                            <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                            @error('old_password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">   
                        <div class="col-md-6">
                            <label for="password">Contraseña nueva</label>
                            <input  type="password" name="password" id="new_password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">   
                        <div class="col-md-6">
                            <label for="phone">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Actualizar</button>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
