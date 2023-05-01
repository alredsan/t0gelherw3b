<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $event->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('Descripcion', $event->Descripcion, ['class' => 'form-control' . ($errors->has('Descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('Descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FechaEvento') }}
            {{ Form::date('FechaEvento',  (date('d-m-Y', $event->FechaEvento)), ['class' => 'form-control' . ($errors->has('FechaEvento') ? ' is-invalid' : ''), 'placeholder' => 'Fechaevento']) }}
            {!! $errors->first('FechaEvento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numMaxVoluntarios') }}
            {{ Form::text('numMaxVoluntarios', $event->numMaxVoluntarios, ['class' => 'form-control' . ($errors->has('numMaxVoluntarios') ? ' is-invalid' : ''), 'placeholder' => 'Nummaxvoluntarios']) }}
            {!! $errors->first('numMaxVoluntarios', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Direccion') }}
            {{ Form::text('Direccion', $event->Direccion, ['class' => 'form-control' . ($errors->has('Direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('Direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Latitud') }}
            {{ Form::text('Latitud', $event->Latitud, ['class' => 'form-control' . ($errors->has('Latitud') ? ' is-invalid' : ''), 'placeholder' => 'Latitud']) }}
            {!! $errors->first('Latitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Longitud') }}
            {{ Form::text('Longitud', $event->Longitud, ['class' => 'form-control' . ($errors->has('Longitud') ? ' is-invalid' : ''), 'placeholder' => 'Longitud']) }}
            {!! $errors->first('Longitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Aportaciones') }}
            {{ Form::text('Aportaciones', $event->Aportaciones, ['class' => 'form-control' . ($errors->has('Aportaciones') ? ' is-invalid' : ''), 'placeholder' => 'Aportaciones']) }}
            {!! $errors->first('Aportaciones', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div>
            <label for="Foto">Foto: </label>
            <input type="file" class='form-control' name='Foto' value="" accept="image/*">
            {!! $errors->first('Foto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
