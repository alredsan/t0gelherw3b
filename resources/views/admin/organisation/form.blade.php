<div class="box box-info padding-1">
    <div class="box-body">

        <input type="hidden" name='idONG' value='{{ $organisation->idONG }}'>
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
            {{ Form::textarea('Descripcion', $organisation->Descripcion, ['class' => 'form-control' . ($errors->has('Descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion', 'id' => 'editor','rows'=>'10','cols' => '80']) }}
            {!! $errors->first('Descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FechaCreacion') }}
            {{ Form::date('FechaCreacion', date('Y-m-d', $organisation->FechaCreacion), ['class' => 'form-control' . ($errors->has('FechaCreacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechacreacion']) }}
            {!! $errors->first('FechaCreacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('IBANmetodoPago') }}
            {{ Form::text('IBANmetodoPago', $organisation->IBANmetodoPago, ['class' => 'form-control' . ($errors->has('IBANmetodoPago') ? ' is-invalid' : ''), 'placeholder' => 'Ibanmetodopago']) }}
            {!! $errors->first('IBANmetodoPago', '<div class="invalid-feedback">:message</div>') !!}
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
        <div>
            <input type="file" class='form-control' name='FotoLogo' value="" accept="image/*">
            {!! $errors->first('FotoLogo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

@push('scriptsJS')
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
<script>
    let element = document.querySelector('#editor');

    if (element != null) {
        ClassicEditor.create(element)
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

    }
</script>
@endpush
