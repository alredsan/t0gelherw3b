@extends('layouts.plantillaCuenta')

@section('titulo')
    Editar Perfil
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title pb-3">{{ __('Cambiar Contraseña Usuario') }}</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cuenta.pass.update') }}" enctype="multipart/form-data" name="formChangePasswd">
                            {{ method_field('PATCH') }}
                            @csrf
                            @if (session('exito'))
                            <div class="alert alert-success" role="alert">
                                {{ session('exito') }}
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif


                            <div class="form-group">
                                <label for="oldpassword">Dime la antigua contraseña:</label>
                                <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Antigua contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$" autocomplete="on">
                                <div class="invalid-feedback">Debe introduce la contraseña antigua,que contiene 4-16 caracteres, un numero, letra mayúscula y letra mayuscula.</div>
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Dime la nueva contraseña:</label>
                                <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nueva contraseña"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$" autocomplete="on">
                                <div class="invalid-feedback">Introduce la contraseña nueva o no conciden o no cumple 4-16 caracteres, un numero, letra mayúscula y letra mayuscula.</div>
                            </div>
                            <div class="form-group">
                                <label for="confirmarpassword">Dime de nuevo la nueva contraseña:</label>
                                <input type="password" class="form-control" name="confirmarpassword" id="confirmarpassword" placeholder="Confirmar contraseña"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$" autocomplete="on">
                                <div class="invalid-feedback">La nueva contraseña no conciden.</div>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scriptsJS')
    <script src="/js/validation.js"></script>
@endpush
