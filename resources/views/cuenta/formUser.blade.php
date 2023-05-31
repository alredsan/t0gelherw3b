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
        <div class="row">
            <div class="form-group col-sm">
                <label for="Nombre">Nombre</label>
                <input type="text" class="form-control" name="name" id="Nombre" value="{{ old('Nombre',$user->name) }}"
                    placeholder="nombre" pattern="[A-Z a-z\-]{3,}" required>
                <div class="invalid-feedback">Introduce el nombre</div>
            </div>
            <div class="form-group col-sm">
                <label for="Apellidos">Apellidos:</label>
                <input type="text" class="form-control" name="Apellidos" id="Apellidos" value="{{ old('Apellidos',$user->Apellidos) }}"
                    placeholder="Apellidos" pattern="[A-Z a-z\-]{3,}" required>
                <div class="invalid-feedback">Introduce los apellidos</div>
            </div>
        </div>
        {{-- <div class="form-group">
            <label for="DNI">DNI</label>
            <input type="text" class="form-control" name="DNI" id="DNI" value="{{ old('DNI',$user->DNI) }}"
                placeholder="DNI">
            <div class="invalid-feedback">Introduce el DNI</div>
        </div> --}}
        <div class="row">
            <div class="form-group col-sm">
                <label for="email">email:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email',$user->email) }}"
                pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,}$" placeholder="email" required>
                <div class="invalid-feedback">Introduce el email</div>
            </div>

            <div class="form-group col-sm">
                <label for="Telefono">Telefono:</label>
                <input type="text" class="form-control" name="Telefono" id="Telefono" value="{{ old('Telefono',$user->Telefono) }}"
                    placeholder="Telefono" pattern="([+]{0,1}[0-9]{10,12}|[0-9]{9})$" required>
                <div class="invalid-feedback">Introduce el telefono</div>
            </div>
        </div>
        <div class="form-group">
            <label for="Direccion">Direccion:</label>
            <input type="text" class="form-control" name="Direccion" id="Direccion" value="{{ old('Direccion',$user->Direccion) }}"
                placeholder="Direccion" pattern=".{4,}$" required>
            <div class="invalid-feedback">Introduce la direccion</div>
        </div>
        <div class="form-group">
            <label for="Provincia">Provincia:</label>
            <input type="text" class="form-control" name="ProvinciaLocalidad" id="Provincia"
                value="{{ old('ProvinciaLocalidad',$user->ProvinciaLocalidad) }}" placeholder="Provincia" pattern=".{4,}$" required>
            <div class="invalid-feedback">Introduce la Provincia</div>
        </div>

        <div class="row">
            <div class="col-md">
                <p class="pt-2">Foto :</p>
                @if($user->Foto)
                    <img src="{{ asset($user->Foto) }}" class='w-50' id='FotoPreview' alt="Foto perfil">
                @else
                    <img src="{{ asset(config('constants.DEFAULT_PHOTO_USER')) }}"  id='FotoPreview' class='w-50' alt="Foto evento">
                @endif
            </div>
            <div class="col-md">
                <label for="FotoLogoSelec">Seleccionar otra foto:</label>
                <input type="file" class='form-control' name='Foto' id="FotoLogoSelec" accept="image/*">
                <div class="invalid-feedback">La imagen debe ser en formato jpg-png-gif, no puede superar mas de 2MB</div>
            </div>
        </div>

        {{-- <div>
            <label for="Foto">Foto perfil:</label>
            <input type="file" class='form-control' name='Foto' value="" accept="image/*">
            {!! $errors->first('Foto', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
