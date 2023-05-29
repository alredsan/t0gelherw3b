@extends('layouts.plantillaAdmin')

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
                        <h1 class="card-title">Actualizar Usuario <i>{{$user->name}}</i></h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin.user.update', $user->id) }}"  role="form" enctype="multipart/form-data" name="formUserUpdate">
                            {{ method_field('PATCH') }}
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


@push('scriptsJS')
    <script src="/js/validation.js"></script>
@endpush




{{-- @extends('layouts.plantillaAdmin')

@section('titulo')
    {{ __('Update') }} User
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                         <span class="card-title">{{ __('Update') }} User</span>
                        <span class="card-title">Modificar Usuario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.user.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.user.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}
