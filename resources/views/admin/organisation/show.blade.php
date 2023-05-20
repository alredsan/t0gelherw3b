@extends('layouts.plantillaAdmin')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="float-left">
                            {{-- <h1 class="card-title">Perfil ONG</h1> --}}

                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="float-right">
                            @if (Auth::user()->roles('2'))
                                <a class="btn btn-primary" href="{{ route('admin.ong.edit', $organisation->idONG) }}">
                                    {{ __('Editar') }}</a>
                            @endif
                        </div>

                    </div>

                    <div class="card-body  bg-white d-flex flex-column">

                        <div class="form-group">
                            <h1>{{ $organisation->Name }}</h1>
                        </div>

                        <div>
                            <div class="form-group">
                                <img src="{{ asset($organisation->FotoLogo) }}" class='w-50' alt="LogoONG">
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <strong>Idong:</strong>
                                {{ $organisation->idONG }}
                            </div>

                            <div class="form-group">
                                <strong>Direccionsede:</strong>
                                {{ $organisation->DireccionSede }}
                            </div>
                            <div class="form-group">
                                <strong>Descripcion:</strong>
                                {!! $organisation->Descripcion !!}
                            </div>
                            <div class="form-group">
                                <strong>Fechacreacion:</strong>

                                {{ date('d-m-Y', $organisation->FechaCreacion) }}
                            </div>
                            <div class="form-group">
                                <strong>Ibanmetodopago:</strong>
                                {{ $organisation->IBANmetodoPago }}
                            </div>

                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $organisation->eMail }}
                            </div>
                            <div class="form-group">
                                <strong>Telefono:</strong>
                                {{ $organisation->Telefono }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
