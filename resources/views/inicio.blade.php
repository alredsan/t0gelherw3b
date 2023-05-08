@extends('layouts.plantilla')

@section('titulo', 'INICIO')


@section('contenido')
    <main>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/2.jpg" class="d-block w-100" alt="Fotografia">
                </div>
                <div class="carousel-item">
                    <img src="img/3.jpg" class="d-block w-100" alt="Fotografia">
                </div>
                <div class="carousel-item">
                    <img src="img/2.jpg" class="d-block w-100" alt="Fotografia">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <div class="contanier_form">
            <form action="{{ route('eventsFilter') }}" class="form_principal" method="GET">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Buscar ..."
                                name='nombre'>
                            <label for="floatingInput">Buscar por palabra</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name='selectType' aria-label="select tipo ">
                                <option value='0'>Tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value={{ $tipo->idtypeONG }}> {{ $tipo->Nombre }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Tematica</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name='fecha' min="{{date('Y-m-d')}}">
                            <label for="floatingInput">Fecha</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="localidad" name='localidad'
                                placeholder="Buscar ...">
                            <label for="floatingInput">Localidad</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name='selectRadio' aria-label="select tipo ">
                                <option value='0'>Sin limite</option>
                                <option value='1'>1 km</option>
                                <option value='5'>5 km</option>
                                <option value='10'>10 km</option>
                                <option value='20'>20 km</option>
                                <option value='50'>50 km</option>
                                <option value='100'>100 km</option>
                                <option value='200'>200 km</option>
                            </select>
                            <label for="floatingInput">Radio</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary botonSearch" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="text-center border-bottom">
            <h1 class="display-4 fw-bold">Ayudar puede cambiar las cosas por un mundo mejor</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Transformando el mundo a través de la ayuda mutua.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <a type="button" href='{{ route('eventsFilter') }}' class="btn btn-primary btn-lg px-4 me-sm-3">Ver eventos</a>
                </div>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
                <div class="container px-5">
                    <img src="img/banner.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Imagen Ayuda"
                        width="700" height="500" loading="lazy">
                </div>
            </div>
        </div>

        <div class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold">Únete a la comunidad</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Transformando el mundo a través de la ayuda mutua.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <a type="button" href='{{route('login')}}' class="btn btn-primary btn-lg px-4 me-sm-3">Iniciar sesion</a>
                    <a type="button" href='{{route('registro')}}' class="btn btn-outline-secondary btn-lg px-4">Registrarte</a>
                </div>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
                <div class="container px-5">
                    <img src="img/banner.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image"
                        width="700" height="500" loading="lazy">
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="/js/script.js"></script>
@endsection
