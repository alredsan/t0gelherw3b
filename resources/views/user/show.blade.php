@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? "{{ __('Show') User" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                        </div>
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
                            {{ $user->Foto }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
