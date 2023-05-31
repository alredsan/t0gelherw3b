@extends('layouts.plantilla')

@section('titulo')
    Evento | {{ $event->Nombre }}
@endsection

@section('contenido')
    <section class="container">
        <div class="row">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('fail'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
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
                        <div class="row">
                            <div class="col-sm">
                                <div
                                    class='d-flex justify-content-center mt-5 flex-column align-items-center justify-content-center'>
                                    @if ($event->FechaEvento >= time())
                                        <p>Quedan <strong id='numParticipantesRest'>{{ $particiantesRestantes }}</strong>
                                            puestos de {{ $event->numMaxVoluntarios }}</p>
                                        <div id='message'></div>
                                        <form action={{ '/app/event/' . $event->idEvento . '/addparticipation' }}
                                            method="GET" id='addVolunteer'>
                                            <button type="submit"
                                                class="btn btn-primary me-2 botonSearch">Apuntarse</button>
                                        </form>
                                    @else
                                        <p>Han apuntado <b>{{ $event->numMaxVoluntarios - $particiantesRestantes }}</b>
                                            voluntarios ¡Gracias!
                                        </p>
                                        <div id='message'></div>
                                        <button type="submit" class="btn btn-primary me-2 botonSearch" disabled>EVENTO
                                            FINALIZADO</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div
                                    class='d-flex justify-content-center mt-5 flex-column align-items-center justify-content-center'>
                                    <p>¿Quieres donar?</p>

                                    <button type="submit" class="btn btn-primary me-2 botonSearch" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">DONA</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class='row'>
            <h3>Descripción</h3>
            {!! $event->Descripcion !!}
        </div>

        <div class="d-flex flex-wrap justify-content-between pb-3">
            <h3>Donde se encuentra:</h3>
            <a class="btn btn-success" href="https://www.google.com/maps/search/?api=1&query={{$event->Latitud}},{{$event->Longitud}}">Abrir con Google Maps</a>
            <a class="btn btn-success" href="https://maps.apple.com/?ll={{$event->Latitud}},{{$event->Longitud}}&lsp=7618&q=Evento">Abrir con Apple Maps</a>
        </div>


        <x-maps-leaflet :centerPoint="['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]" :markers="[['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]]" :zoomLevel="20">
        </x-maps-leaflet>

        <div class='row'>
            <h3>Sobre el ONG</h3>

            <div class="col-sm-4 photoLogo" style="background-image:url({{ asset($event->organisation->FotoLogo) }})">
            </div>

            <div class='col-sm-8'>
                <h4>{{ $event->organisation->Name }}</h4>
                <a class="btn btn-primary" href="{{ asset("/app?id_ONG=$event->id_ONG") }}">Ver más eventos que organiza el ONG</a>
            </div>
            <h4>Descripcion sobre ONG:</h4>
            {!! $event->organisation->Descripcion !!}
        </div>
    </section>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Cuanto quieres donar al evento?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('events.donative', $event->idEvento) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" name="donative" class="form-control" aria-label="Introduce la cantidad que quieres donar">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Donar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/scriptEvent.js"></script>
@endsection

@section('styleCssPag')
    <link rel="stylesheet" href="/css/showEvent.css">
@endsection
