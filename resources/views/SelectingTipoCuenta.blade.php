@extends('layouts.plantilla')

@section('titulo', 'Tipo de cuenta')

@section('contenido')
    <main id="mainForm" class="d-flex justify-content-center align-items-center pt-5 pb-5">

        <form class="form" method="POST" action="{{ route('inicia-sesion') }}">
            <p class="form__title">Entrar como...</p>
            <p>Seleccione una acción..</p>

            <a href="{{ route('cuenta') }}">Voluntario</a>
            <a href="{{ route('Admin') }}">
                @if (Auth::user()->id_ONG != null)
                    Administrador ONG
                    @php($ongExists = true)
                @endif
                @if (Auth::user()->roles('1'))
                    @if ($ongExists)
                        /
                    @endif
                    WEB
                @endif
            </a>
        </form>
    </main>
@endsection
