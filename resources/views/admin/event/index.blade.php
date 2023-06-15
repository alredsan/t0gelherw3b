@extends('layouts.plantillaAdmin')

@section('titulo', 'Eventos')

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h1 id="card_title">
                                {{ __('Eventos') }}
                            </h1>

                            <div class="float-right">
                                @if (!request()->RouteIs('admin.events.index') && $userAuth->Role >= 2)
                                    <a href="{{ route('admin.ong.event.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Crear nuevo evento') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('fail'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body bg-white mb-3">
                        @if (!request()->RouteIs('admin.events.index'))
                            <form action="{{ route('admin.ong.event.index') }}" method="get">
                        @else
                                <form action="{{ route('admin.events.index') }}" method="get">
                        @endif

                        <div class="form-group">
                            <label for="name">Buscar por nombre de evento</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="@php echo isset($buscador) ? "$buscador":"" @endphp" placeholder="Buscar ...">
                            <div class="invalid-feedback">Introduce mas de 3 caracteres</div>
                        </div>
                        <input type="hidden" name="idONG" value="@php echo isset($_GET['idONG']) ? $_GET['idONG'] :"" @endphp">
                        <div class="box-footer text-end mt-2">
                            @if (isset($buscador) || isset($_GET['idONG']))
                                @if (!request()->RouteIs('admin.events.index'))
                                    <a href="{{ route('admin.ong.event.index') }}" class="btn btn-danger"><i
                                            class="bi bi-eraser me-2"></i>Eliminar Busqueda</a>
                                @else
                                    <a href="{{ route('admin.events.index') }}" class="btn btn-danger"><i
                                            class="bi bi-eraser me-2"></i>Eliminar Busqueda</a>
                                @endif

                            @endif
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search me-2"></i>Filtrar</button>
                        </div>
                        </form>
                    </div>
                    <div class="card-body bg-white">
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $events->links() !!}
                            </div>
                        </div>
                        <div>
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>

                                        <th>Idevento</th>
                                        @if ($showONG)
                                            <th data-head='ONG'>ONG</th>
                                        @endif
                                        <th>Nombre Evento</th>
                                        <th>Fecha evento</th>
                                        <th>Nº max de voluntarios</th>
                                        <th>Direccion</th>
                                        <th>Aportaciones</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                        <th>Usuarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                        <tr>

                                            <td data-head='Idevento'>{{ $event->idEvento }}</td>
                                            @if ($showONG)
                                                <td data-head='ONG'>{{ $event->organisation->Name }}</td>
                                            @endif
                                            <td data-head='Nombre'>{{ $event->Nombre }}</td>
                                            <td data-head='Fecha evento'>{{ date('d-m-Y', $event->FechaEvento) }}</td>
                                            <td data-head='Nº max de voluntarios'>{{ $event->numMaxVoluntarios }}</td>
                                            <td data-head='Direccion'>{{ $event->Direccion }}</td>
                                            <td data-head='Aportaciones'>{{ $event->Aportaciones }}</td>
                                            <td data-head='Estado'>
                                                @if ($event->Visible)
                                                    <div class='alert alert-success p-1 m-0 text-center'>
                                                        <span>Visible</span>
                                                    </div>
                                                @else
                                                    <div class='alert alert-secondary p-1 m-0 text-center'>
                                                        <span>Oculto</span>
                                                    </div>
                                                @endif
                                            </td>

                                            <td data-head="Acciones">
                                                <div class="formActions">
                                                @if ($userAuth->Role >= 2)
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('events.show', $event->idEvento) }}">
                                                        {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.ong.event.edit', $event->idEvento) }}">{{ __('Editar') }}</a>

                                                    <button type="submit"
                                                        data-action="{{ route('admin.ong.event.destroy', $event->idEvento) }}"
                                                        class="btn btn-danger btn-sm btnDelete">{{ __('Eliminar') }}</button>
                                                @else
                                                    <div class="formActions">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('events.show', $event->idEvento) }}">{{ __('Mostrar') }}</a>

                                                    </div>
                                                @endif
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info"
                                                    href="{{ route('admin.ong.event.users', $event->idEvento) }}">{{ __('Ver participantes') }}</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="9">No hay registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $events->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteLabel">Eliminar Evento ¿Estas Seguro?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="formDeleteModal" method="POST">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scriptsJS')
    <script src="/js/modalDelete.js"></script>
@endpush
