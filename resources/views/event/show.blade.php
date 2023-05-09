@extends('layouts.plantilla')

@section('titulo')
    Evento | {{ $event->Nombre }}
@endsection

@section('contenido')
    <section class="container">
        <div class="row">
            <div class="col-sm-4 photoEvent" style="background-image:url({{ asset($event->Foto) }})">

            </div>
            <div class="col-sm-8">
                <div>
                    <div>
                        <h2>{{ $event->Nombre }}</h2>
                        <p>
                            @foreach ($event->eventsType as $type)
                                {{ $type->Nombre }}
                            @endforeach
                        </p>
                    </div>
                    <div>
                        <div>
                            <p>{{ $event->Direccion }}</p>
                            <p>{{ date('Y-m-d H:m', $event->FechaEvento) }}</p>
                        </div>
                        <div
                            class='d-flex justify-content-center mt-5 flex-column align-items-center justify-content-center'>
                            <p>Quedan <b>{{ $particiantesRestantes }}</b> puestos de {{ $event->numMaxVoluntarios }}</p>
                            <div id='message'>

                            </div>
                            <button type="button" id='addVolunteer'
                                class="btn btn-primary me-2 w-50 botonSearch">Apuntarse</button>
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

    <script>
        let boton = document.getElementById('addVolunteer');
        let divMessage = document.getElementById('message');

        boton.addEventListener('click', function() {
            fetch({!! "'/app/event/" . $event->idEvento . "/addparticipation'" !!})
                .then(result => result.json())
                .then(function(data) {
                    divMessage.innerHTML = '';

                    divMessage.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                    console.log(data);
                })
                .catch(function() {
                    divMessage.innerHTML = '';

                    divMessage.innerHTML = '<div class="alert alert-danger">No se ha podido realizar la peticion</div>';
                })
            /* .then(result => console.log(result)
                 e => console.log(`Error capturado:  ${e}`));*/
        });
    </script>
@endsection

@section('styleCssPag')
    <link rel="stylesheet" href="/css/showEvent.css">
@endsection
