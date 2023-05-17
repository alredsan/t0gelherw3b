<form action="{{ route('eventsFilter') }}" class="form_principal" method="GET">
    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre" placeholder="Buscar ..." name='nombre'
                    value="@php echo isset($_GET['nombre'])? $_GET['nombre'] : ""; @endphp">
                <label for="nombre">Buscar por palabra</label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">
                <select class="form-select" id="selectType" name='selectType' aria-label="select tipo ">
                    <option value='0'>Tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->idtypeONG }}"> {{ $tipo->Nombre }}</option>
                    @endforeach
                </select>
                <label for="selectType">Tematica</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ date('Y-m-d') }}"
                    value="@php echo isset($_GET['fecha'])? $_GET['fecha'] : ""; @endphp">
                <label for="fecha">Fecha</label>
            </div>
        </div>

        <div class="col-md">
            <div class="input-group align-items-end" id="fGeocoder">

                <div class="form-floating">
                    <input type="text" class="form-control" id="localidad" name='localidad' placeholder="Buscar ..."
                        autocomplete="off" value="@php echo isset($_GET['localidad'])? $_GET['localidad'] : ""; @endphp">
                    <label for="localidad">Localidad</label>
                    <input type="hidden" name="lat" id='lat'
                        value="@php echo isset($_GET['lat'])? $_GET['lat'] : ""; @endphp">
                    <input type="hidden" name="lon" id='lon'
                        value="@php echo isset($_GET['lon'])? $_GET['lon'] : ""; @endphp">
                    <div id="geocoderAddresses"></div>
                </div>

                <button id='bGeo' type='button' class="input-group-text"><i
                        class="bi bi-cursor-fill"></i></button>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating mb-3">
                <select class="form-select" id="selectRadio" name='selectRadio' aria-label="select tipo">
                    <option value='0'>Sin limite</option>
                    @php
                        $array[0] = 5;
                        for ($i = 1; $i < 8; $i++) {
                            $array[$i] = $array[$i - 1] * 2;
                        }
                        $existsRequest = isset($_GET['selectRadio']);
                    @endphp

                    @foreach ($array as $km)
                        <option value='{{ $km }}'
                        @if($existsRequest && $_GET['selectRadio'] == $km)
                            selected
                        @endif
                        >{{ $km }} km</option>
                    @endforeach
                </select>
                <label for="selectRadio">Radio</label>
            </div>
        </div>
        <div class="col-12">
            <button type='button' class="btn btn-primary" id='btnMoreFilters'>Mas filtros <i class="bi bi-arrow-down-short"></i></button>
            <div class='row' id='divMoreFilters'>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="order" name='order' aria-label="select tipo ">
                            <option value='0'>Ordenar por fecha</option>
                            <option value='1'>Ordenar por Distancia</option>
                            <option value='2'>Ordenar por Nuevos Eventos</option>

                        </select>
                        <label for="order">Ordenacion</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="activeEvent" placeholder="Buscar ..." name='activeEvent'
                            value="@php echo isset($_GET['nombre'])? $_GET['nombre'] : ""; @endphp">
                        <label for="activeEvent">eVENTOS aCTIVOS</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary botonSearch" type="submit">Buscar</button>
        </div>
    </div>
</form>

@push('scriptsJS')
    <script src="/js/script.js"></script>
@endpush
