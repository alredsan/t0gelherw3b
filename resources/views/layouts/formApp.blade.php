<form action="{{ route('eventsFilter') }}" class="form_principal" method="GET">
    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Buscar ..."
                    name='nombre' value={{ old('nombre') }}>
                <label for="floatingInput">Buscar por palabra</label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" name='selectType' aria-label="select tipo ">
                    <option value='0'>Tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value={{ $tipo->idtypeONG }}> {{ $tipo->Nombre }}</option>
                    @endforeach
                </select>
                <label for="floatingSelect">Tematica</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name='fecha' min="{{ date('Y-m-d') }}">
                <label for="floatingInput">Fecha</label>
            </div>
        </div>

        <div class="col-md">
            <div class="input-group align-items-end" id="fGeocoder">
                {{-- <div class="form-floating">
                    <input type="text" class="form-control" id="localidad" name='localidad'
                        placeholder="Buscar ...">
                    <label for="floatingInput">Localidad</label>
                    <input type="hidden" name="lat" id='lat'>
                    <input type="hidden" name="lon" id='lon'>
                </div> --}}


                <div class="form-floating">
                    <input type="text" class="form-control" id="localidad" name='localidad' placeholder="Buscar ..." autocomplete="off">
                    <label for="floatingInput">Localidad</label>
                    <input type="hidden" name="lat" id='lat'>
                    <input type="hidden" name="lon" id='lon'>
                    <div id="geocoderAddresses"></div>
                </div>

                <button id='bGeo' type='button' class="input-group-text"><i class="bi bi-cursor-fill"></i></button>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" name='selectRadio' aria-label="select tipo">
                    <option value='0'>Sin limite</option>
                    <option value='1'>1 km</option>
                    <option value='5'>5 km</option>
                    <option value='10'>10 km</option>
                    <option value='20'>20 km</option>
                    <option value='50'>50 km</option>
                    <option value='100'>100 km</option>
                    <option value='200'>200 km</option>
                </select>
                <label for="floatingInput">Radio</label>
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
