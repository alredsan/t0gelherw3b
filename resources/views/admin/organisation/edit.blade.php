@extends('layouts.plantillaAdmin')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Organisation</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.ong.update', $organisation->idONG) }}"  role="form" enctype="multipart/form-data">
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
