@extends('layouts.plantillaAdmin')

@section('titulo')
    {{ $organisation->Name }}
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="card-header d-flex justify-content-between align-items-center">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <h1 id="card_title">
                            {{ __('Perfil organización') }}
                        </h1>

                        <div class="float-right">
                            @if ($userAuth->Role >= 3)
                                <a class="btn btn-primary" data-placement="left" href="{{ route('admin.ong.edit', $organisation->idONG) }}">
                                    {{ __('Editar') }}</a>
                            @endif
                        </div>

                    </div>

                    <div class="card-body bg-white d-flex flex-column">
                        <div class="form-group">
                            <h1>{{ $organisation->Name }}</h1>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <strong>Identificacion ONG:</strong>
                                    {{ $organisation->idONG }}
                                </div>

                                <div class="form-group">
                                    <strong>Direccionsede:</strong>
                                    {{ $organisation->DireccionSede }}
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
                            <div class="col-lg">
                                <div class="form-group">
                                    <img src="{{ asset($organisation->FotoLogo) }}" class='w-50' alt="LogoONG">
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3>Descripción:</h3>
                            {!! $organisation->Descripcion !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
