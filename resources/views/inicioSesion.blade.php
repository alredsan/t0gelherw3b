@extends('layouts.plantilla')

@section('titulo', 'Inicio Sesion')

@section('contenido')
    <main id="mainForm" class="d-flex justify-content-center align-items-center pt-5 pb-5">

        <form class="form" method="POST" action="{{ route('inicia-sesion') }}">
            @csrf
            <p class="form__title">Iniciar Sesión</p>

            <label for="email">Correo Electronico</label>
            <input class="form__input" type="text" name="email" id="email"
                pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,}$" title="Introduca el email correcto" required>

            <label for="pass">Contraseña</label>
            <div class="form__pass">
                <input class="form__input" type="password" name="passwd" id="passwd"
                    title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                    required autocomplete="on">
                {{-- <input class="form__input" type="password" name="passwd" id="passwd"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$"
                    title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                    required autocomplete="on"> --}}
                <a class="pass__img" href="#" onclick="mostrarContrasena()">Mostrar</a>
            </div>
            <input type="radio" name="recordar"><label for="radio">Recordar cuenta</label>
            @if ($message = Session::get('message'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <input class="button form__button" type="submit" value="Iniciar Sesión" name="sign">
            <a class="form__button" href="{{ route('registro') }}">Registrarte</a>
        </form>

    </main>
@endsection
