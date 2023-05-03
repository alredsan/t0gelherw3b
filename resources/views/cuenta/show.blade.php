@extends('layouts.plantillaCuenta')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuenta.edit') }}"> {{ __('Editar') }}</a>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">

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
                        <div class="form-group">
                            <strong>Foto:</strong>
                            <img src={{asset($user->Foto)}} class="card-img-top w-25" alt="FotoPerfil" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
