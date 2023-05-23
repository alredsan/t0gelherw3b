<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio Sesion</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/cssPage.css">
</head>

<body id="mainForm">

    <main class="d-flex justify-content-center align-items-center pt-5 pb-5">

        <form class="form" name='fLogin' method="POST" action="{{ route('inicia-sesion') }}">
            @csrf
            <div class='d-flex align-items-center justify-content-center'>
                <img class='w-50' src="/img/logo.png" alt="">
            </div>
            <p class="form__title">Iniciar Sesión</p>

            <label for="email">Correo Electronico</label>
            <input class="form__input form-control" type="text" name="email" id="email"
                pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,}$" title="Introduca el email correcto" required>
            <div class="invalid-feedback">El email es obligatorio.</div>

            <label for="pass">Contraseña</label>
            <div class="form__pass">
                {{-- <input class="form__input" type="password" name="passwd" id="passwd"
                    title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                    required autocomplete="on"> --}}
                <input class="form__input" type="password" name="passwd" id="passwd"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$"
                    title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                    required autocomplete="on">
                <a class="pass__img" id='showPasswd'><i class="fs-4 bi bi-eye-fill"></i></a>
                <div class="invalid-feedback">Debe contener 4-16 caracteres, un numero, letra mayúscula y letra
                    mayuscula.</div>
            </div>
            <div>
                <input type="checkbox" name="recordar"><label for="radio">Recordar cuenta</label>
            </div>
            @if ($message = Session::get('message'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <input class="button form__button" type="submit" value="Iniciar Sesión" name="sign">

            <div class='enlacesForm'>
                <a class="form__button" href="{{ route('/') }}">Volver a Inicio</a>
                <a class="form__button" href="{{ route('registro') }}">Registrarte</a>
            </div>

        </form>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/js/validation.js"></script>
</body>

</html>
