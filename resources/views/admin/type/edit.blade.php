@extends('layouts.plantillaAdmin')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Update') }} Type {{ $type->Nombre}}</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.types.update', $type->idtypeONG) }}"  role="form" enctype="multipart/form-data">
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
