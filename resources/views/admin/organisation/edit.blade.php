@extends('layouts.plantillaAdmin')

@section('titulo')
    Editar ONG
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <h1 class="card-title">Editar ONG</h1>
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-body">
                        <form method="POST" id="formONG" action="{{ route('admin.ong.update', $organisation->idONG) }}" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.organisation.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
