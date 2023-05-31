@extends('layouts.plantillaAdmin')

@section('titulo', 'Editar Evento')

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title pb-2">Actualizar Evento</h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin.ong.event.update', $event->idEvento) }}" id="formEvent" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('event.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
