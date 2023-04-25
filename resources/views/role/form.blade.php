<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('idRol') }}
            {{ Form::text('idRol', $role->idRol, ['class' => 'form-control' . ($errors->has('idRol') ? ' is-invalid' : ''), 'placeholder' => 'Idrol']) }}
            {!! $errors->first('idRol', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('NombreRol') }}
            {{ Form::text('NombreRol', $role->NombreRol, ['class' => 'form-control' . ($errors->has('NombreRol') ? ' is-invalid' : ''), 'placeholder' => 'Nombrerol']) }}
            {!! $errors->first('NombreRol', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>