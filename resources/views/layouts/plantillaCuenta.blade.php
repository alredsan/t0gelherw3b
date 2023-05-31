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

    {{-- <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <a class="navbar-brand" href="#">
                            <img class="logoAdmin" src="/img/logoB.png" alt="">
                        </a>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">

                        <li>
                            <a href="{{ route('cuenta') }}" class="nav-link px-2 p align-middle {{request()->RouteIs("cuenta")? "active":""}}">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">General</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('cuenta.perfil') }}" class="nav-link px-2 align-middle {{request()->RouteIs(["cuenta.perfil","cuenta.edit"])? "active":""}}">
                                <i class="fs-4 bi bi-person-fill"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('cuenta.pass.edit')}}" class="nav-link px-2 align-middle {{request()->RouteIs("cuenta.pass.edit")? "active":""}}">
                                <i class="fs-4 bi bi-key-fill"></i> <span class="ms-1 d-none d-sm-inline">Cambiar
                                    contraseña</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('cuenta.eventos') }}" class="nav-link px-2 align-middle {{request()->RouteIs("cuenta.eventos")? "active":""}}">
                                <i class="fs-4 bi bi-calendar-event-fill"></i> <span class="ms-1 d-none d-sm-inline">Eventos
                                    Apuntados</span> </a>
                        </li>

                    </ul>
                    <hr>
                    <div class="dropdown pb-4">

                        <a href="{{ route('/') }}" class="nav-link align-middle px-0 py-2">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Salir de
                                Ajustes</span>
                        </a>

                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(Auth::user()->Foto) }}" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('/') }}">Inicio</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                @yield('contenido')
            </div>
        </div>
    </div> --}}
    <nav class="navbar navbar-dark navbar-expand-lg" id="navBarCuenta">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('cuenta') }}">
                <img class="logoAdmin" src="/img/logoB.png" alt="Logo Inicio">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav navcuenta me-auto mb-2 mb-lg-0">

                    <li>
                        <a href="{{ route('cuenta') }}"
                            class="nav-link px-2 p align-middle {{ request()->RouteIs('cuenta') ? 'active' : '' }}">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">General</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('cuenta.perfil') }}"
                            class="nav-link px-2 align-middle {{ request()->RouteIs(['cuenta.perfil', 'cuenta.edit']) ? 'active' : '' }}">
                            <i class="fs-4 bi bi-person-fill"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cuenta.pass.edit') }}"
                            class="nav-link px-2 align-middle {{ request()->RouteIs('cuenta.pass.edit') ? 'active' : '' }}">
                            <i class="fs-4 bi bi-key-fill"></i> <span class="ms-1 d-none d-sm-inline">Cambiar
                                contraseña</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('cuenta.eventos') }}"
                            class="nav-link px-2 align-middle {{ request()->RouteIs('cuenta.eventos') ? 'active' : '' }}">
                            <i class="fs-4 bi bi-calendar-event-fill"></i> <span class="ms-1 d-none d-sm-inline">Eventos
                                Apuntados</span> </a>
                    </li>
                </ul>

                <div class="col-md-2 text-end">
                    <menu>
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a href="{{ route('/') }}" class="d-flex align-items-center text-white me-3">
                                <i class="fs-4 bi-house"></i> <span class="ms-1">Volver</span>
                            </a>
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
                                @if (Auth::user()->roles('1') || Auth::user()->id_ONG)
                                    <li><a class="dropdown-item" href="{{ route('Admin') }}">Cambiar a
                                            Administracion</a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesion</a></li>
                            </ul>
                        </li>
                    </menu>
                </div>
            </div>
        </div>
    </nav>

    <div class='container pt-5 '>
        {{-- @dump(request()->routeIs(['admin.ong','admin.ong.edit','admin.ong.update','admin.ong.event.index'])) --}}
        @yield('contenido')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    @stack('scriptsJS')
    {{-- <script src="/js/validation.js"></script> --}}
</body>

</html>
