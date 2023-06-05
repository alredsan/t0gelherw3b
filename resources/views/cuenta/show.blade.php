@extends('layouts.plantillaCuenta')

@section('titulo')
    Perfil
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="p-3">
                            <div class="float-left">
                                <h1 class="card-title">{{ __('Perfil Voluntario') }}</h1>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('cuenta.edit') }}"> {{ __('Editar Perfil') }}</a>
                            </div>

                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="card-body row">
                        <div class="col-lg">
                            <div class="form-group">
                                <strong>Dni:</strong>
                                {{ $user->DNI }}
                            </div>
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </div>
                            <div class="form-group">
                                <strong>Apellidos:</strong>
                                {{ $user->Apellidos }}
                            </div>
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                            <div class="form-group">
                                <strong>Direccion:</strong>
                                {{ $user->Direccion }}
                            </div>
                            <div class="form-group">
                                <strong>Provincialocalidad:</strong>
                                {{ $user->ProvinciaLocalidad }}
                            </div>
                            <div class="form-group">
                                <strong>Telefono:</strong>
                                {{ $user->Telefono }}
                            </div>
                            <div class="form-group">
                                <strong>Id Ong:</strong>
                                {{ $user->id_ONG }}
                            </div>

                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <img src={{asset($user->Foto)}} class="card-img-top w-50" alt="FotoPerfil">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
