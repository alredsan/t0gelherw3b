@extends('layouts.plantillaAdmin')

@section('titulo')
    Editar Perfil
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} User</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="DNI">DNI</label>
                                <input type="text" class="form-control" name="DNI" id="DNI" value="{{ old('DNI',$user->DNI) }}"
                                    placeholder="DNI">
                                <div class="invalid-feedback">Introduce el DNI</div>
                            </div>

                            @include('cuenta.formUser')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
