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
                        <form method="POST" action="{{ route('cuenta.update', $user->id) }}"  role="form" enctype="multipart/form-data">
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
