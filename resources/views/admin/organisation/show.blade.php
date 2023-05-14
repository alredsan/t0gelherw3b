@extends('layouts.plantillaAdmin')

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
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            @if (Auth::user()->roles('2'))
                            <a class="btn btn-primary" href="{{ route('admin.ong.edit',$organisation->idONG) }}"> {{ __('Editar') }}</a>
                            @endif
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="card-body d-flex">
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
                                <strong>Name:</strong>
                                {{ $organisation->Name }}
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

                                {{ date('d-m-Y',$organisation->FechaCreacion) }}
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
