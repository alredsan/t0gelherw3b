@extends('layouts.plantillaAdmin')

@section('titulo')
    Crear nuevo tipo
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Crear tipo') }}</h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin.types.store') }}" id="formType" enctype="multipart/form-data">
                            @csrf

                            @include('admin.type.form')

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

