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

        <div class="form-group">
            <label for="Nombre">Nombre:</label>
            <input type="text" class='form-control' name='Nombre' id='Nombre' placeholder='Nombre'
                value='{{ old('Nombre', $event->Nombre) }}'>
            <div class="invalid-feedback">Introduce el nombre</div>
        </div>

        <div class="form-group">
            <label for="Descripcion">Descripción del evento:</label>
            <textarea class='form-control' name='Descripcion' id='editor' placeholder='Descripcion'>{{ old('Descripcion', $event->Descripcion) }}</textarea>
            <div class="invalid-feedback">Introduce un descripción</div>
        </div>

        <div class="form-group">
            <label for="FechaEvento">Fecha del evento:</label>
            <input type="datetime-local" class='form-control' name='FechaEvento' id='FechaEvento'
                placeholder='Fecha del evento' value="{{ old('FechaEvento', date('Y-m-d H:m', $event->FechaEvento)) }}">
            <div class="invalid-feedback">Introduce la fecha y la hora correcta dd/mm/yyyy 00:00</div>
        </div>

        <div class="form-group">
            <label for="numMaxVoluntarios">Numero maximo de voluntarios:</label>
            <input type="number" class='form-control' name='numMaxVoluntarios' id='numMaxVoluntarios'
                placeholder='numero Maximo de Voluntarios'
                value='{{ old('numMaxVoluntarios', $event->numMaxVoluntarios) }}'>
            <div class="invalid-feedback">Introduce un numero maximo del voluntario del evento</div>

            <div class="form-group">
                <label for="Direccion">Direccion:</label>
                <input type="text" class='form-control' name='Direccion' id='Direccion' placeholder='Direccion'
                    value='{{ old('Direccion', $event->Direccion) }}'>
                <div class="invalid-feedback">Introduce la direccion del evento</div>
            </div>

            <div class="form-group">
                <label for="Latitud">Latitud:</label>
                <input type="text" class='form-control' name='Latitud' id='Latitud' placeholder='Latitud'
                    value='{{ old('Latitud', $event->Latitud) }}'>
                <div class="invalid-feedback">Introduce la Latitud</div>
            </div>
            <div class="form-group">
                <label for="Longitud">Longitud:</label>
                <input type="text" class='form-control' name='Longitud' id='Longitud' placeholder='Longitud'
                    value='{{ old('Longitud', $event->Longitud) }}'>
                <div class="invalid-feedback">Introduce la Longitud</div>
            </div>

            <div class="form-group">
                <label for="Aportaciones">Aportaciones:</label>
                <input type="number" class='form-control' name='Aportaciones' id='Aportaciones'
                    placeholder='Aportaciones' value='{{ old('Aportaciones', $event->Aportaciones) }}'>
                <div class="invalid-feedback">Introduce el numero de aportaciones</div>
            </div>
            @php
                $typeSelect = old('selectmultiple', $event->eventsType);
                $idTypesSelect = [];
                foreach ($typeSelect as $type) {
                    $idTypesSelect[] = $type['idtypeONG'];
                }
            @endphp

            <div class="form-group d-flex flex-column">
                <label for="typeEvent">Seleccione los tipos que relaciona la tematica:</label>
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

            <div>
                <label for="Foto">Foto: </label>
                <input type="file" class='form-control' name='Foto' accept="image/*" id="Foto">
                {!! $errors->first('Foto', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="CheckVisible" name="CheckVisible" @if($event->Visible) checked @endif>
                <label class="form-check-label" for="CheckVisible">El evento sea visible</label>
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
        {{-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
        <script src="/js/fSelect.js"></script>
        <script src="/js/formCKeditor.js"></script>
        <script>
            $('#selectmultiple').fSelect();
        </script>
    @endpush
