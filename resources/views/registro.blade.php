<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TOGETHER | Registro</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/cssPage.css">
</head>

<body id="mainForm">
    <main id="mainFormRegister" class="d-flex justify-content-center align-items-center p-5">

        <form class="form" method="POST" action="{{ route('validar-registro') }}">
            @csrf
            <div class='d-flex align-items-center justify-content-center'>
                <img class='w-50' src="/img/logo.png" alt="">
            </div>
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
                <a class="pass__img" onclick="mostrarContrasena()"><i class="fs-4 bi bi-eye-fill"></i></a>

            </div>
            <input class="button form__button" type="submit" value="Registrarte" name="sign">
            <a class="form__button" href="{{ route('login') }}">Tienes cuenta?</a>
        </form>

    </main>
    <script src="/js/form.js"></script>
</body>

</html>
