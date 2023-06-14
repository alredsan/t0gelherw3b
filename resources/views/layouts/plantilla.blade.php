<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOGETHER. | @yield('titulo') </title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/cssPage.css">
    @yield('styleCssPag')
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg shadow" id="navApp">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('/') }}" aria-label="Ir a inicio">
                <img class="logo" src="/img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quien somos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">¿Eres una ONG?</a>
                    </li>
                </ul>
                <div class="col-md-3 text-end">
                    @if (Auth::check())
                        <menu>
                            <li class="nav-item dropdown d-flex align-items-center">
                                <a href="#"
                                    class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset(Auth::user()->Foto) }}" alt="hugenerd" width="30"
                                        height="30" class="rounded-circle">
                                    <span class="mx-1">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item" href="{{ route('acceso') }}"><i
                                                class="bi bi-gear pe-2"></i>Administracion</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <a href='{{ route('logout') }}' class="dropdown-item"><i
                                                class="bi bi-box-arrow-right pe-2"></i>Cerrar Sesión</a>
                                    </li>
                                </ul>

                            </li>
                        </menu>
                    @else
                        <div class="d-flex flex-row">
                            <a href='{{ route('login') }}' class="btn btn-outline-primary me-2">Iniciar Sesión</a>
                            <a href='{{ route('registro') }}' class="btn btn-primary">Registrarte</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>


    {{-- contenido --}}
    @yield('contenido')


    @include('layouts.alertCookie')

    <div id='footerApp'>
        <footer
            class="container align-items-center justify-content-center row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 mt-5 border-top">
            <div class="col mb-3">
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                    <img class="w-75" src="/img/logo.png" alt="Logotipo">
                </a>
                <p class="text-muted">TOGETHER &copy; 2023</p>
                <div class="d-flex flex-row gap-5">
                    <i class="fs-4 bi bi-facebook"></i>
                    <i class="fs-4 bi bi-instagram"></i>
                    <i class="fs-4 bi bi-twitter"></i>
                    <i class="fs-4 bi bi-telephone-fill"></i>
                </div>
            </div>

            <div class="col mb-3">

            </div>

            <div class="col mb-3">
                <h5>General</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Inicio</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Términos y Aviso de
                            privacidad</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Mapa Web</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Envianos tus
                            comentarios</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ayuda</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Más información</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Aviso sobre
                            cookies</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Preguntas Frecuentes</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">¿Eres una ONG?</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Beneficios</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Acerca de</a></li>
                </ul>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    @yield('scripts')
    @stack('scriptsJS')
</body>

</html>
