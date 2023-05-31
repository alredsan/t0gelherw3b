@extends('layouts.plantilla')

@section('titulo')
    Evento | {{ $event->Nombre }}
@endsection

@section('contenido')
    <section class="container">
        <div class="row">
            <div class="col-lg-4 photoEvent" style="background-image:url({{ asset($event->Foto) }})">

            </div>
            <div class="col-lg-8">
                <div>
                    <div>
                        <h2>{{ $event->Nombre }}</h2>
                        <div class='d-flex flex-row gap-2 flex-wrap pb-3'>
                            @foreach ($event->eventsType as $type)
                                <div class='alert alert-info p-1 m-0 text-center '>
                                    <a class="typeEvent" href="{{ asset("/app?selectType=$type->idtypeONG") }}">
                                        {{ $type->Nombre }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <div class="event-info">
                            <div>
                                <p class="fw-bolder">Dirección:</p>
                                <p>{{ $event->Direccion }}</p>
                            </div>
                            <div>
                                <p class="fw-bolder">Fecha / Hora:</p>
                                <p>{{ date('d-m-Y - H:m', $event->FechaEvento) }}</p>
                            </div>
                        </div>
                        @if ($event->FechaEvento >= time())
                            <div
                                class='d-flex justify-content-center mt-5 flex-column align-items-center justify-content-center'>
                                <p>Quedan <strong id='numParticipantesRest'>{{ $particiantesRestantes }}</strong> puestos de {{ $event->numMaxVoluntarios }}</p>
                                <div id='message'></div>
                                <form action={{ '/app/event/' . $event->idEvento . '/addparticipation' }} method="GET"
                                    id='addVolunteer'>
                                    <button type="submit" class="btn btn-primary me-2 botonSearch">Apuntarse</button>
                                </form>
                            </div>
                        @else
                            <div
                                class='d-flex justify-content-center mt-5 flex-column align-items-center justify-content-center'>
                                <p>Han apuntado <b>{{ $event->numMaxVoluntarios - $particiantesRestantes }}</b>
                                    voluntarios ¡Gracias!
                                </p>
                                <div id='message'></div>
                                <button type="submit" class="btn btn-primary me-2 botonSearch" disabled>EVENTO
                                    FINALIZADO</button>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class='row'>
            <h3>Descripción</h3>
            {!! $event->Descripcion !!}
        </div>

        <h3>Donde se encuentra:</h3>
        <x-maps-leaflet :centerPoint="['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]" :markers="[['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]]" :zoomLevel="20">
        </x-maps-leaflet>

        <div class='row'>
            <h3>Sobre el ONG</h3>

            <div class="col-sm-4 photoLogo" style="background-image:url({{ asset($event->organisation->FotoLogo) }})">
            </div>

            <div class='col-sm-8'>
                <h4>{{ $event->organisation->Name }}</h4>
                <a class="btn btn-primary" href="{{ asset("/app?id_ONG=$event->id_ONG") }}">Ver mas eventos sobre el ONG</a>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script src="/js/scriptEvent.js"></script>
@endsection

@section('styleCssPag')
    <link rel="stylesheet" href="/css/showEvent.css">
@endsection
