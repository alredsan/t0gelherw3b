<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('idONG') }}
            {{ Form::text('idONG', $organisation->idONG, ['class' => 'form-control' . ($errors->has('idONG') ? ' is-invalid' : ''), 'placeholder' => 'Idong']) }}
            {!! $errors->first('idONG', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Name') }}
            {{ Form::text('Name', $organisation->Name, ['class' => 'form-control' . ($errors->has('Name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('Name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('DireccionSede') }}
            {{ Form::text('DireccionSede', $organisation->DireccionSede, ['class' => 'form-control' . ($errors->has('DireccionSede') ? ' is-invalid' : ''), 'placeholder' => 'Direccionsede']) }}
            {!! $errors->first('DireccionSede', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('Descripcion', $organisation->Descripcion, ['class' => 'form-control' . ($errors->has('Descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('Descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FechaCreacion') }}
            {{ Form::text('FechaCreacion', $organisation->FechaCreacion, ['class' => 'form-control' . ($errors->has('FechaCreacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechacreacion']) }}
            {!! $errors->first('FechaCreacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('IBANmetodoPago') }}
            {{ Form::text('IBANmetodoPago', $organisation->IBANmetodoPago, ['class' => 'form-control' . ($errors->has('IBANmetodoPago') ? ' is-invalid' : ''), 'placeholder' => 'Ibanmetodopago']) }}
            {!! $errors->first('IBANmetodoPago', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FotoLogo') }}
            {{ Form::text('FotoLogo', $organisation->FotoLogo, ['class' => 'form-control' . ($errors->has('FotoLogo') ? ' is-invalid' : ''), 'placeholder' => 'Fotologo']) }}
            {!! $errors->first('FotoLogo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('eMail') }}
            {{ Form::text('eMail', $organisation->eMail, ['class' => 'form-control' . ($errors->has('eMail') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('eMail', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Telefono') }}
            {{ Form::text('Telefono', $organisation->Telefono, ['class' => 'form-control' . ($errors->has('Telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('Telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>