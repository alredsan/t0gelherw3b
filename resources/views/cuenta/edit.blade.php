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
                        <h1 class="card-title">Actualizar Usuario <i>{{ $user->name }}</i></h1>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('fail'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('cuenta.update', $user->id) }}" role="form"
                            enctype="multipart/form-data" name="formUserUpdate">
                            {{ method_field('PATCH') }}
                            @csrf

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
