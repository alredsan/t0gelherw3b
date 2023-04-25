@extends('layouts.app')

@section('template_title')
    {{ $event->name ?? "{{ __('Show') Event" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Event</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('events.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Idevento:</strong>
                            {{ $event->idEvento }}
                        </div>
                        <div class="form-group">
                            <strong>Id Ong:</strong>
                            {{ $event->id_ONG }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $event->Nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $event->Descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaevento:</strong>
                            {{ $event->FechaEvento }}
                        </div>
                        <div class="form-group">
                            <strong>Nummaxvoluntarios:</strong>
                            {{ $event->numMaxVoluntarios }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $event->Direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Latitud:</strong>
                            {{ $event->Latitud }}
                        </div>
                        <div class="form-group">
                            <strong>Longitud:</strong>
                            {{ $event->Longitud }}
                        </div>
                        <div class="form-group">
                            <strong>Aportaciones:</strong>
                            {{ $event->Aportaciones }}
                        </div>
                        <div class="form-group">
                            <strong>Foto:</strong>
                            {{ $event->Foto }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
