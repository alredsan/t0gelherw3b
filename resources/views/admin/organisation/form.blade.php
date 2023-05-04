<div class="box box-info padding-1">
    <div class="box-body">

        <input type="hidden" name='idONG' value='{{ $organisation->idONG }}'>
        <div class="form-group">
            <label for="Name">Nombre:</label>
            <input class="form-control" placeholder="Name" name="Name" type="text" value="{{ $organisation->Name }}"
                id="Name">
            <div class="invalid-feedback">Introduce el nombre correctamente</div>
        </div>
        <div class="form-group">
            <label for="DireccionSede">Direccion del Sede:</label>
            <input type="text" class="form-control" name="DireccionSede" id="DireccionSede"
                value="{{ old('DireccionSede', $organisation->DireccionSede) }}" placeholder="DireccionSede">
            <div class="invalid-feedback">Introduce la direccion del Sede</div>
        </div>
        <div class="form-group">
            <label for="Descripcion">Descripcion:</label>
            <textarea type="text" class="form-control" name="Descripcion" id="editor" value="{{ $organisation->Descripcion }}"
                placeholder="Descripcion">{{ old('Descripcion', $organisation->Descripcion) }}</textarea>
            <div class="invalid-feedback">Introduce la descripcion de ONG</div>
        </div>
        <div class="form-group">
            <label for="FechaCreacion">Fecha de Creacion:</label>
            <input type="date" class="form-control" name="FechaCreacion" id="FechaCreacion"
                value="{{ old('FechaCreacion', date('Y-m-d', $organisation->FechaCreacion)) }}"
                placeholder="FechaCreacion">
            <div class="invalid-feedback">Introduce la fecha de creacion</div>
        </div>
        <div class="form-group">
            <label for="IBANmetodoPago">IBAN:</label>
            <input type="text" class="form-control" name="IBANmetodoPago" id="IBANmetodoPago"
                value="{{ old('IBANmetodoPago', $organisation->IBANmetodoPago) }}" placeholder="IBAN">
            <div class="invalid-feedback">Introduce el IBAN correctamente</div>
        </div>

        <div class="form-group">
            <label for="eMail">Email de contacto</label>
            <input type="email" class="form-control" name="eMail" id="eMail"
                value="{{ old('eMail', $organisation->eMail) }}" placeholder="eMail">
            <div class="invalid-feedback">Introduce el Email de contacto</div>
        </div>
        <div class="form-group">
            <label for="Telefono">Telefono:</label>
            <input type="text" class="form-control" name="Telefono" id="Telefono"
                value="{{ old('Telefono', $organisation->Telefono) }}" placeholder="Telefono">
            <div class="invalid-feedback">Introduce la direccion del Sede</div>
        </div>
        <div>
            <input type="file" class='form-control' name='FotoLogo' accept="image/*">
            {!! $errors->first('FotoLogo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>

@push('scriptsJS')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="/js/formCKeditor.js"></script>
@endpush
