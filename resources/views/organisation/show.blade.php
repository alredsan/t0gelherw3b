@extends('layouts.app')

@section('template_title')
    {{ $organisation->name ?? "{{ __('Show') Organisation" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Organisation</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('organisations.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
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
                            {{ $organisation->Descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Fechacreacion:</strong>
                            {{ $organisation->FechaCreacion }}
                        </div>
                        <div class="form-group">
                            <strong>Ibanmetodopago:</strong>
                            {{ $organisation->IBANmetodoPago }}
                        </div>
                        <div class="form-group">
                            <strong>Fotologo:</strong>
                            {{ $organisation->FotoLogo }}
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
    </section>
@endsection
