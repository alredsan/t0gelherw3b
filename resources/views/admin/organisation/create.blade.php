@extends('layouts.plantillaAdmin')

@section('titulo')
    Crear ONG
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Crear nuevo ONG') }} </h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" id="formONG" action="{{ route('admin.ong.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.organisation.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
