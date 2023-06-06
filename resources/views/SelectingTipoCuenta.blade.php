@extends('layouts.plantilla')

@section('titulo', 'Tipo de cuenta')

@section('contenido')
    <main id="mainForm" class="d-flex justify-content-center align-items-center pt-5 pb-5">

        <div class="form form_selecting">
            <p class="form__title">Entrar como...</p>
            <p>Seleccione una acción..</p>

            <a href="{{ route('cuenta') }}">Voluntario</a>
            <a href="{{ route('Admin') }}">
                @php($ongExists = false)
                @if (Auth::user()->id_ONG != null)
                    Administrador ONG
                    @php($ongExists = true)
                @endif
                @if (Auth::user()->Role == 4)
                    @if ($ongExists)
                        /
                    @else
                        Administar
                    @endif
                    WEB
                @endif
            </a>
        </div>
    </main>
@endsection
