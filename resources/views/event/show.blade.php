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
                    </div>
                    <div>
                        <div>
                            {{ $event->Direccion }}
                            {{ date('d-m-Y', $event->FechaEvento) }}

                        </div>
                        <div class='d-flex justify-content-center mt-5'>
                            <a type="button" href='{{ route('acceso') }}' class="btn btn-outline-primary me-2">Apuntarse</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class='row'>
            <h3>Descripción</h3>
            {!! $event->Descripcion !!}
        </div>

        <x-maps-leaflet :centerPoint="['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud) ]" :markers="[['lat' => floatval($event->Latitud), 'long' =>  floatval($event->Longitud) ]]" :zoomLevel="20">
        </x-maps-leaflet>
        {{-- <div id='mapid'>

        </div> --}}

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

@section('styleCssPag')
    <link rel="stylesheet" href="/css/showEvent.css">
@endsection
{{--
@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script src="/js/leafletMap.js"></script>

    <script>
        // contanier.append(
        //     `<div class="container"><h5>Donde se situa: </h5><div class="m-4" id="mapidProd" name='mapid'></div></div>`);

        let mapContainerProd = document.getElementById('mapid');
        console.log(mapContainerProd);
        mapContainerProd.style.height = '250px';
        mapContainerProd.style.border = '2px solid #faa541';
        // mapContainerProd.css({
        //     height: '250px',
        //     border: '2px solid #faa541',
        // });

        let mapProd = L.map('mapid').setView([{{$event->Latitud}}, {{$event->Longitud}}], 15);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
            maxZoom: 18
        }).addTo(mapProd);

        // L.marker([{{$event->Latitud}}, {{$event->Longitud}}]).addTo(mapProd);
    </script>
@endsection --}}
