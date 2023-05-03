@extends('layouts.plantillaCuenta')

@section('titulo')
    Editar Perfil
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} User</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cuenta.pass.update') }}"  role="form" enctype="multipart/form-data">
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
                                <label for="name">Dime la antigua contraseña:</label>
                                <input type="text" class="form-control" name="oldpassword" id="name" placeholder="Antigua contraseña">
                                <div class="invalid-feedback">Introduce la contraseña antigua</div>
                            </div>
                            <div class="form-group">
                                <label for="name">Dime la nueva contraseña:</label>
                                <input type="text" class="form-control" name="newpassword" id="name" placeholder="nueva contraseña">
                                <div class="invalid-feedback">Introduce la contraseña nueva o no conciden</div>
                            </div>
                            <div class="form-group">
                                <label for="name">Dime de nuevo la nueva contraseña:</label>
                                <input type="text" class="form-control" name="confirmarpassword" id="name" placeholder="confirmar contraseña">
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
