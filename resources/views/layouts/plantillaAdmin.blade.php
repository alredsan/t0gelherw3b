<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <meta name="description" content="Administracion.">
    <title>Thogeter - @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/css/cssPage.css">
    @yield('styleCssPag')
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('Admin') }}">
                <img class="logoAdmin" src="/img/logoB.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- ADMINISTRADOR WEB --}}
                    @if (Auth::user()->roles('1'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fs-4 bi bi-globe2"></i><span class="ms-1">Administrador
                                    WEB</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{ route('admin.ong.index') }}" class="dropdown-item">
                                        <i class="fs-4 bi-table"></i>
                                        <span class="ms-1">ONGs</span></a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <i class="fs-4 bi-table"></i>
                                        <span class="ms-1">Eventos</span></a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <i class="fs-4 bi-table"></i>
                                        <span class="ms-1">Usuarios</span></a>
                                </li>
                                {{-- <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->roles('2'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fs-4 bi-building-gear"></i><span class="ms-1">Administrador
                                    ONG</span>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{ route('admin.ong') }}" class="dropdown-item">
                                        <i class="fs-4 bi-table"></i> <span class="ms-1">Perfil
                                            ONG</span></a>
                                </li>
                                @if (Auth::user()->roles('2') || Auth::user()->roles('3') || Auth::user()->roles('4'))
                                    <li>
                                        <a href="{{ route('admin.ong.event.index') }}" class="dropdown-item">
                                            <i class="fs-4 bi-table"></i> <span class="ms-1">Eventos
                                                ONG</span></a>
                                    </li>
                                @endif
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <i class="fs-4 bi-table"></i> <span class="ms-1">Permisos
                                            Usuarios</span></a>
                                </li>

                            </ul>

                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('/') }}" class="nav-link">
                            <i class="fs-4 bi-house"></i> <span class="ms-1">Salir de
                                Ajustes</span>
                        </a>
                    </li>
                </ul>

                <div class="col-md-2 text-end">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(Auth::user()->Foto) }}" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="mx-1">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark shadow">
                            <li><a class="dropdown-item" href="{{ route('/') }}">Inicio</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('cuenta') }}">Cambiar a Voluntario</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <div class='container pt-5'>
        @yield('contenido')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    @stack('scriptsJS')

</body>

</html>
