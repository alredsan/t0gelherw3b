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

        <form class="form" name='fRegister' method="POST" action="{{ route('validar-registro') }}">
            @csrf
            <div class='d-flex align-items-center justify-content-center'>
                <img class='w-50' src="/img/logo.png" alt="">
            </div>
            <p class="form__title">Registro</p>
            @if ($errors->any())
                {{-- errores del parte servidor form --}}
                <div class='alert alert-danger'>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="input_group">
                <label for="Nombre">Nombre*</label>
                <input class="form__input form-control" type="text" name="name" id="Nombre" title="Nombre"
                    pattern="[A-Z a-z\-]{3,}" required value="{{old('name')}}">
                <div class="invalid-feedback">El Nombre es obligatorio.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>
            <div class="input_group">
                <label for="Apellidos">Apellidos*</label>
                <input class="form__input form-control" type="text" name="Apellidos" id="Apellidos" title="Apellidos"
                    pattern="[A-Z a-z\-]{3,}" required value="{{old('Apellidos')}}">
                <div class="invalid-feedback">Apellidos es obligatorio.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>
            <div class="input_group">
                <label for="email">Correo Electronico*</label>
                <input class="form__input form-control" type="text" name="email" id="email"
                    pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,}$" value="{{old('email')}}" title="Introduca el email correcto" required>

                <div class="invalid-feedback">El email es obligatorio.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>
            <div class="input_group">
                <label for="DNI">DNI*</label>
                <input class="form__input form-control" type="text" name="DNI" id="DNI" title="DNI"
                    pattern="^[a-zA-Z]{0,1}[0-9]{7,8}[a-zA-Z]{1}$" value="{{old('DNI')}}" required>
                <div class="invalid-feedback">El DNI es obligatorio y debe cumplir.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>
            <div class="input_group">
                <label for="Direccion">Direccion*</label>
                <input class="form__input form-control" type="text" name="Direccion" id="Direccion" title="Direccion"
                    pattern=".{4,}$" value="{{old('Direccion')}}" required>
                <div class="invalid-feedback">El Direccion es obligatorio.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>
            <div class="input_group">
                <label for="Provincia">Provincia*</label>
                <input class="form__input form-control" type="text" name="ProvinciaLocalidad" id="Provincia" title="Provincia"
                    pattern=".{4,}$" value="{{old('ProvinciaLocalidad')}}" required>
                <div class="invalid-feedback">La Provincia es obligatorio.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>
            <div class="input_group">
                <label for="Telefono">Telefono*</label>
                <input class="form__input form-control" type="text" name="Telefono" id="Telefono" title="Telefono"
                    pattern="([+]{0,1}[0-9]{10,12}|[0-9]{9})$" value="{{old('Telefono')}}" required>
                <div class="invalid-feedback">El Telefono es obligatorio.</div>
                <div class="valid-feedback">Correcto.</div>
            </div>

            <div class="input_group">
                <label for="passwd">Contraseña*</label>
                <div class="form__pass">
                    {{-- <input class="form__input form-control" type="password" name="passwd" id="passwd"
                        title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                        required autocomplete="on"> --}}
                    <input class="form__input form-control" type="password" name="passwd" id="passwd"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$"
                        title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                        required autocomplete="new-password">
                    <a class="pass__img" id='showPasswd'><i class="fs-4 bi bi-eye-fill"></i></a>
                    <div class="invalid-feedback">Debe contener 4-16 caracteres, un numero, letra mayúscula y letra
                        mayuscula.</div>
                    <div class="valid-feedback">Correcto.</div>
                </div>
            </div>

            <div class="input_group">
                <label for="passwdConfirm">Introduce de nuevo la contraseña*</label>

                {{-- <input class="form__input form-control" type="password" name="passwd" id="passwd"
                        title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                        required autocomplete="on"> --}}
                <input class="form__input form-control" type="password" name="passwdConfirm" id="passwdConfirm"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$"
                    title="Introduca la contraseña correcto 4-16 caracteres, un numero, letra mayúscula y letra mayuscula"
                    required autocomplete="new-password">
                <div class="invalid-feedback">No es la misma contraseña.</div>
                <div class="valid-feedback">Correcto.</div>

            </div>

            <input class="button form__button" type="submit" value="Registrarte" name="sign">
            <a class="form__button" href="{{ route('login') }}">Tienes cuenta?</a>
        </form>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/js/validation.js"></script>
</body>

</html>
