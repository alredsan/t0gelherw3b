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
        <input type="hidden" name='idONG' value='{{ $organisation->idONG }}'>
        <div class="form-group">
            <label for="Name">Nombre:</label>
            <input class="form-control" placeholder="Nombre" name="Name" type="text" value="{{ $organisation->Name }}"
                id="Name" pattern=".{3,44}" required>
            <div class="invalid-feedback">Introduce el nombre correctamente, mas de 3 caracteres y menos de 44</div>
        </div>
        <div class="form-group">
            <label for="DireccionSede">Dirección de la Sede:</label>
            <input type="text" class="form-control" name="DireccionSede" id="DireccionSede" pattern=".{3,60}"
                value="{{ old('DireccionSede', $organisation->DireccionSede) }}" placeholder="DireccionSede" required>
            <div class="invalid-feedback">Introduce la direccion del Sede</div>
        </div>
        <div class="form-group">
            <label for="editor">Descripción:</label>
            <textarea class="form-control" name="Descripcion" id="editor" placeholder="Descripcion" required>{{ old('Descripcion', $organisation->Descripcion) }}</textarea>
            <div class="invalid-feedback">Introduce la descripcion de ONG</div>
        </div>

        <div class="row">
            <div class="form-group col-sm-4">
                <label for="FechaCreacion">Fecha de Creación:</label>
                <input type="date" class="form-control" name="FechaCreacion" id="FechaCreacion"
                    value="{{ old('FechaCreacion', date('Y-m-d', $organisation->FechaCreacion)) }}" required>
                <div class="invalid-feedback">Introduce la fecha de creacion</div>
            </div>
            <div class="form-group col-sm-8">
                <label for="IBANmetodoPago">IBAN:</label>
                <input type="text" class="form-control" name="IBANmetodoPago" id="IBANmetodoPago"
                    value="{{ old('IBANmetodoPago', $organisation->IBANmetodoPago) }}" placeholder="IBAN"
                    pattern="^[A-Z]{2}\d{2}\d{4}\d{4}\d{4}\d{4}\d{4}$" required>
                <div class="invalid-feedback">Introduce el IBAN correctamente</div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-8">
                <label for="eMail">Email de contacto</label>
                <input type="email" class="form-control" name="eMail" id="eMail"
                    value="{{ old('eMail', $organisation->eMail) }}" pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,}$"
                    placeholder="email" required>
                <div class="invalid-feedback">Introduce el Email de contacto</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="Telefono">Teléfono:</label>
                <input type="text" class="form-control" name="Telefono" id="Telefono"
                    pattern="^([+]{0,1}[0-9]{10,12}|[0-9]{9})$" value="{{ old('Telefono', $organisation->Telefono) }}"
                    placeholder="Telefono" required>
                <div class="invalid-feedback">Introduce el telefono XXXXXXXXX</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <p class="pt-2">Foto:</p>
                @if ($organisation->FotoLogo)
                    <img src="{{ asset($organisation->FotoLogo) }}" class='w-50' id='FotoPreview' alt="LogoONG">
                @else
                    <img src="{{ asset(config('constants.DEFAULT_PHOTO_ONG')) }}" id='FotoPreview' class='w-50'
                        alt="LogoONG">
                @endif
            </div>
            <div class="col-md">
                <label for="FotoLogoSelec">Seleccionar otra foto:</label>
                <input type="file" class='form-control' name='FotoLogo' id="FotoLogoSelec" accept="image/*">
                <div class="invalid-feedback">La imagen debe ser en formato jpg-png-gif y menos de 2MB</div>
            </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>

@push('scriptsJS')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="/js/formCKeditor.js"></script>
    <script src='/js/validation.js'></script>
@endpush
