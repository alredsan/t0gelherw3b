@extends('layouts.plantillaAdmin')

@section('titulo', 'Nuevo Evento')

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div>
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Crear nuevo Evento') }}</h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin.ong.event.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('event.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
