@extends('layouts.plantilla')

@section('titulo', 'Registro')

@section('contenido')
    <main id="mainForm" class="d-flex justify-content-center align-items-center pt-5 pb-5">

        <form class="form" method="POST" action="{{ route('validar-registro') }}">
            @csrf
            <p class="form__title">Registro</p>

            <label for="Nombre">Nombre</label>
            <input class="form__input" type="text" name="Nombre" id="Nombre" title="Nombre" required>

            <label for="Apellidos">Apellidos</label>
            <input class="form__input" type="text" name="Apellidos" id="Apellidos" title="Apellidos" required>

            <label for="email">Correo Electronico</label>
            <input class="form__input" type="text" name="email" id="email"
                pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,}$" title="Introduca el email correcto" required>

            <label for="DNI">DNI</label>
            <input class="form__input" type="text" name="DNI" id="DNI" title="DNI" required>

            <label for="Direccion">Direccion</label>
            <input class="form__input" type="text" name="Direccion" id="Direccion" title="Direccion" required>

            <label for="Provincia">Provincia</label>
            <input class="form__input" type="text" name="Provincia" id="Provincia" title="Provincia" required>

            <label for="Telefono">Telefono</label>
            <input class="form__input" type="text" name="Telefono" id="Telefono" title="Telefono" required>


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
            <input class="button form__button" type="submit" value="Registrarte" name="sign">
            <a class="form__button" href="{{ route('inicioSesion') }}">Tienes cuenta?</a>
        </form>

    </main>
@endsection
