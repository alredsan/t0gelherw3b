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
                        <div class='d-flex flex-row gap-2 flex-wrap'>
                            @foreach ($event->eventsType as $type)
                            <div class='alert alert-info p-1 m-0 text-center '>
                                <span class="typeEvent"> {{ $type->Nombre }}</span>
                            </div>

                            @endforeach
                        </div>
                    </div>
                    <div>
                        <div>
                            <p>{{ $event->Direccion }}</p>
                            <p>{{ date('Y-m-d H:m', $event->FechaEvento) }}</p>
                        </div>
                        <div
                            class='d-flex justify-content-center mt-5 flex-column align-items-center justify-content-center'>
                            <p>Quedan <b>{{ $particiantesRestantes }}</b> puestos de {{ $event->numMaxVoluntarios }}</p>
                            <div id='message'></div>
                            <form action={{"/app/event/" . $event->idEvento . "/addparticipation"}} method="GET" id='addVolunteer'>

                                <button type="submit" class="btn btn-primary me-2 botonSearch">Apuntarse</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class='row'>
            <h3>Descripción</h3>
            {!! $event->Descripcion !!}
        </div>

        <x-maps-leaflet :centerPoint="['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]" :markers="[['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]]" :zoomLevel="20">
        </x-maps-leaflet>

        <div class='row'>
            <h3>Sobre el ONG</h3>

            <div class="col-sm-4 photoLogo" style="background-image:url({{ asset($event->organisation->FotoLogo) }})">
            </div>

            <div class='col-sm-8'>
                <h4>{{ $event->organisation->Name }}</h4>
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
