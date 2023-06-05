<div class="box box-info padding-1">
    <div class="box-body">
        @if ($errors->any())
            {{-- errores del parte servidor form --}}
            <div class='alert alert-danger'>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('danger-events'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="form-group">
            <label for="Nombre">Nombre:</label>
            <input type="text" class='form-control' name='Nombre' id='Nombre' placeholder='Nombre'
            pattern="[\w ]{3,}" value='{{ old('Nombre', $event->Nombre) }}'>
            <div class="invalid-feedback">Introduce el nombre</div>
        </div>

        <div class="form-group">
            <label for="editor">Descripción del evento:</label>
            <textarea class='form-control' name='Descripcion' id='editor' placeholder='Descripcion'>{{ old('Descripcion', $event->Descripcion) }}</textarea>
            <div class="invalid-feedback">Introduce un descripción</div>
        </div>

        <div class="form-group">
            <label for="FechaEvento">Fecha del evento:</label>
            <input type="datetime-local" class='form-control' name='FechaEvento' id='FechaEvento'
                value="{{ old('FechaEvento', date('Y-m-d H:m', $event->FechaEvento)) }}">
            <div class="invalid-feedback">Introduce la fecha y la hora correcta dd/mm/yyyy 00:00</div>
        </div>

        <div class="row">
            <div class="form-group col-sm-5">
                <label for="numMaxVoluntarios">Numero maximo de voluntarios:</label>
                <input type="number" class='form-control' name='numMaxVoluntarios' id='numMaxVoluntarios'
                    placeholder='numero Maximo de Voluntarios' min="1"
                    value='{{ old('numMaxVoluntarios', $event->numMaxVoluntarios) }}'>
                <div class="invalid-feedback">Introduce un numero maximo del voluntario del evento</div>
            </div>
            <div class="form-group col-sm-7">
                <label for="Direccion">Direccion:</label>
                <input type="text" class='form-control' name='Direccion' id='Direccion' placeholder='Direccion'
                    value='{{ old('Direccion', $event->Direccion) }}'>
                <div class="invalid-feedback">Introduce la direccion del evento</div>
            </div>
        </div>

        <div class="form-group ">
            <label for="searchDire">Buscador:</label>
            <div class="d-flex flex-row">
                <input type="text" class='form-control' name='searchDire' id='searchDire'
                    placeholder='Buscar direccion'>

                <button type="button" class="btn btn-primary" id="searchDireccion">Buscar</button>
            </div>


            <div id="geocoderAddresses"></div>
            <div class="mapForm">
                @if ($event->Latitud)
                    <x-maps-leaflet :centerPoint="['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]" :marker="[['lat' => floatval($event->Latitud), 'long' => floatval($event->Longitud)]]" :zoomLevel="20">
                    </x-maps-leaflet>
                @else
                    <x-maps-leaflet :zoomLevel="3"></x-maps-leaflet>
                @endif
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" class='form-control' name='Latitud' id='Latitud'
                value='{{ old('Latitud', $event->Latitud) }}'>
             <div class="invalid-feedback">Introduce un punto para concretar lugar del evento</div>
        </div>
        <div class="form-group">
            <input type="hidden" class='form-control' name='Longitud' id='Longitud'
                value='{{ old('Longitud', $event->Longitud) }}'>
        </div>

        @php
            $typeSelect = old('selectmultiple', $event->eventsType);
            $idTypesSelect = [];
            foreach ($typeSelect as $type) {
                $idTypesSelect[] = $type['idtypeONG'];
            }
        @endphp

        <div class="form-group d-flex flex-column">
            <label for="selectmultiple">Seleccione los tipos que relaciona la tematica:</label>
            <select id="selectmultiple" name="selectmultiple[]" multiple="multiple">
                @foreach ($types as $type)
                    @if (in_array($type->idtypeONG, $idTypesSelect))
                        <option value="{{ $type->idtypeONG }}" selected>{{ $type->Nombre }}</option>
                    @else
                        <option value="{{ $type->idtypeONG }}">{{ $type->Nombre }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- <div>
            <label for="Foto">Foto: </label>
            <input type="file" class='form-control' name='Foto' accept="image/*" id="Foto">
            {!! $errors->first('Foto', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}

        <div class="row">
            <div class="col-md">
                <p class="pt-2">Foto :</p>
                @if($event->Foto)
                    <img src="{{ asset($event->Foto) }}" class='w-50' id='FotoPreview' alt="Foto evento">
                @else
                    <img src="{{ asset(config('constants.DEFAULT_PHOTO_ONG')) }}"  id='FotoPreview' class='w-50' alt="Foto evento">
                @endif
            </div>
            <div class="col-md">
                <label for="FotoLogoSelec">Seleccionar otra foto:</label>
                <input type="file" class='form-control' name='Foto' id="FotoLogoSelec" accept="image/*">
                <div class="invalid-feedback">La imagen debe ser en formato jpg-png-gif</div>
            </div>
        </div>

        <div class="form-check form-switch d-flex align-items-center">
            <input class="form-check-input " type="checkbox" role="switch" id="CheckVisible" name="CheckVisible"
                @if ($event->Visible) checked @endif>
            <label class="form-check-label ps-2" for="CheckVisible">El evento sea visible para el publico</label>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>

@section('styleCssPag')
    <link href="/css/fSelect.css" rel="stylesheet">
@endsection

@push('scriptsJS')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="/js/fSelect.js"></script>
    <script src="/js/formCKeditor.js"></script>
    <script src="/js/validation.js"></script>
    <script>
        $('#selectmultiple').fSelect();
        let latInput = document.getElementById("Latitud");
        let lonInput = document.getElementById("Longitud");
        var marcador;
        let btnSearch = document.getElementById("searchDireccion");
        let inputSeach = document.getElementById("searchDire");

        let latEvent = {{ floatval($event->Latitud) }}
        let lonEvent = {{ floatval($event->Longitud) }}
        if (latEvent != "" && lonEvent != "") {
            marcador = L.marker([latEvent, lonEvent]).addTo(mymap);
        }

        mymap.on('click', function(event) {
            if (marcador) {
                mymap.removeLayer(marcador);
            }

            marcador = L.marker([event.latlng.lat, event.latlng.lng]).addTo(mymap);
            latInput.value = event.latlng.lat;
            lonInput.value = event.latlng.lng;
        });

        btnSearch.addEventListener("click", function() {
            geoCode();
        })
        let inputGeoCoder = $('#localidad');
        let addresses = $('#geocoderAddresses');

        function geoCode() {

            $.get('https://nominatim.openstreetmap.org/search?format=json&limit=3&q=' + inputSeach.value).then(
                function(data) {

                    let list = $('<div style="z-index:1005" class="list-group position-absolute"></div>');
                    console.log(data);
                    data.forEach((address) => {
                        list.append(
                            `<a data-lat="${address.lat}" data-lon="${address.lon}" class="list-group-item list-group-item-action">${address.display_name}</a>`
                        );
                    });
                    addresses.empty();
                    addresses.append(list);
                    list.find('a').click(function(event) {

                        inputGeoCoder.val($(this).text().trim());
                        mymap.setView(new L.LatLng(this.dataset.lat, this.dataset.lon), 15);

                        addresses.empty();
                    });

                },
                function(error) {
                    addresses.empty();
                    addresses.append(`<div class="text-danger">
                <i class="fas fa-exclamation-circle"></i>
                No se ha podido establecer la conexión con el servidor de mapas.
            </div>`);
                }
            );
        };
    </script>
@endpush
