@extends('layouts.plantillaAdmin')

@section('titulo')
    Actualizar tipo
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Actualizar Tipo') }} "{{ $type->Nombre}}"</h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin.types.update', $type->idtypeONG) }}" id="formType" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
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

