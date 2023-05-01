@extends('layouts.plantillaAdmin')

@section('titulo', 'Eventos')

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Evento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.ong.event.update', $event->idEvento) }}"  role="form" enctype="multipart/form-data">
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
