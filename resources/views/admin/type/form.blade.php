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
            <label for="Nombre">Nombre</label>
            <input class="form-control" placeholder="Nombre" name="Nombre" type="text" id="Nombre" pattern="[\w ]{3,44}" value="{{ old('Nombre',$type->Nombre)}}">
            <div class="invalid-feedback">Debe tener mas de 3 caracteres y menos de 44</div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
