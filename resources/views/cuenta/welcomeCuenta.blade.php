@extends('layouts.plantillaCuenta')

@section('titulo', 'Cuenta')

@section('contenido')

    <h1 class="pb-5">Bienvenido, {{ Auth::user()->name }}</h1>

    <div class='d-flex flex-wrap gap-5 justify-content-around'>

        <div class="col-lg-5">
            <div>
                <h2>Eventos Proximos</h2>
            </div>
            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->eventos->take(3) as $evento)
                                @if ($evento->FechaEvento > time())
                                    <tr>
                                        <td data-head="Acciones">{{ $evento->Nombre }}</td>
                                        <td>{{ date('d-m-Y H:m', $evento->FechaEvento) }}</td>
                                        <td><a class="btn btn-sm btn-primary"
                                                href="{{ route('events.show', $evento->idEvento) }}">Ver</a></td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <th class="text-center" colspan="5">No hay eventos proximos</th>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">

                        <a href="{{ route('cuenta.eventos') }}">Ver más ... ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
