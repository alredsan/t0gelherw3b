@extends('layouts.plantilla')

@section('titulo')
    Eventos
@endsection

@section('contenido')
    <div class="container pt-5">
        <h1>Búsqueda</h1>
        @include('layouts.formApp')

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class='d-flex gap-5 m-5 flex-wrap justify-content-center'>
            @forelse ($events as $event)
                <div class="card mb-3 " style="width: 100%">
                    <div class="row g-0 shadow">
                        <div class="col-md-4">
                            <div style="background-image:url({{ asset($event->Foto) }});height:25vh;background-repeat: no-repeat;background-size: cover;background-position: center;"
                                class="card-img-top"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-bodyEvent">
                                <h5 class="card-title">{{ $event->Nombre }}</h5>

                                <p class="card-text">{!! strip_tags(mb_strimwidth($event->Descripcion,0, 200, "...")) !!}...</p>
                                <p class="card-text"><small
                                        class="text-body-secondary">{{ date('d/m/Y H:m', $event->FechaEvento) }}</small></p>
                                @if ($event->distancia)
                                    <p class="fw-light">{{ round($event->distancia, 2) }} km</p>
                                @endif
                                <p><a href="{{ route('events.show', $event->idEvento) }}" class="btn btn-primary">Más información</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    <b>No hay eventos con los filtros indicados ¡Lo sentimos!</b>
                </div>
            @endforelse
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    {!! $events->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
