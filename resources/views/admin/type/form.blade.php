<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">

            <label for="Nombre">Nombre</label>
            <input class="form-control" placeholder="Nombre" name="Nombre" type="text" id="Nombre" value="{{ old('Nombre',$type->Nombre)}}">
            {{-- {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $type->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!} --}}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
