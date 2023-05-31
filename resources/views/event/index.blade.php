@extends('layouts.plantilla')

@section('titulo')
    Eventos
@endsection

@section('contenido')
    <div class="contanier_form_events">
        <h1>Busqueda</h1>

        @include('layouts.formApp')
    </div>

    <div class='d-flex gap-5 m-5 flex-wrap justify-content-center'>
        @foreach ($events as $event)
            <div class="card" style="width: 30rem;">
                <div style="background-image:url({{ asset($event->Foto) }});height:20vh;background-repeat: no-repeat;background-size: cover;background-position: center;"
                    class="card-img-top" alt="{{ $event->Nombre }}"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $event->Nombre }}</h5>
                    <p class="card-text">{{ date('d/m/Y H:m', $event->FechaEvento) }}</p>
                    <p class="fw-light">{{round($event->distancia,2)}} km</p>
                    <a href="{{ route('events.show', $event->idEvento) }}" class="btn btn-primary">Más información</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {!! $events->links() !!}
            </div>
        </div>
    </div>
@endsection

{{-- @stack('scriptsJS') --}}
