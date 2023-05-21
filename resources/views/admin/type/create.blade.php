@extends('layouts.plantillaAdmin')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Create') }} Type</h1>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin.types.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
