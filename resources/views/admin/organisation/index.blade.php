@extends('layouts.plantillaAdmin')

@section('titulo')
    Organizaciones
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h1 id="card_title">
                                {{ __('Organizaciones') }}
                            </h1>

                            <div class="float-right">
                                <a href="{{ route('admin.ong.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear nuevo ONG') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white mb-3">

                        <form action="{{ route('admin.ong.index') }}" method="get">

                            {{-- @csrf --}}
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="nameONG">Buscar por nombre</label>
                                    <input type="text" class="form-control" name="nameONG" id="nameONG"
                                        value="@php echo isset($_GET['nameONG']) ? $_GET['nameONG']:"" @endphp"
                                        placeholder="Buscar ...">
                                </div>

                                <div class="box-footer text-end mt-2">
                                    @if (isset($_GET['nameONG']))
                                        <a href="{{ route('admin.ong.index') }}" class="btn btn-danger"><i
                                                class="bi bi-eraser me-2"></i>Eliminar Busqueda</a>
                                    @endif
                                    <button type="submit" class="btn btn-primary"><i
                                            class="bi bi-search me-2"></i>Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body bg-white">
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $organisations->links() !!}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>

                                        <th>Id ong</th>
                                        <th>Logo</th>
                                        <th>Nombre</th>
                                        <th>Dirección sede</th>
                                        <th>Fecha creación</th>
                                        {{-- <th>IBAN</th> --}}
                                        <th>Email</th>
                                        <th>Teléfono</th>

                                        <th>Acciones</th>
                                        <th>Permisos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                        <tr>

                                            <td data-head="Idong">{{ $organisation->idONG }}</td>
                                            <td data-head="Logo"><img src="{{ asset($organisation->FotoLogo) }}"
                                                    class="imgTable" alt="LogoONG"></td>
                                            <td data-head="Nombre">{{ $organisation->Name }}</td>
                                            <td data-head="Direccion">{{ $organisation->DireccionSede }}</td>
                                            <td data-head="Fecha creacion">{{ date('d-m-Y', $organisation->FechaCreacion) }}</td>
                                            {{-- <td data-head="IBAN">{{ $organisation->IBANmetodoPago }}</td> --}}
                                            <td data-head="Email">{{ $organisation->eMail }}</td>
                                            <td data-head="Telefono">{{ $organisation->Telefono }}</td>

                                            <td data-head="Acciones">
                                                <div class="formActions">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('admin.ong.show', $organisation->idONG) }}"> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.ong.edit', $organisation->idONG) }}">{{ __('Editar') }}</a>

                                                    <button type="submit"
                                                        data-action="{{ route('admin.ong.destroy', $organisation->idONG) }}"
                                                        class="btn btn-danger btn-sm btnDelete"> {{ __('Eliminar') }}</button>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success w-100 mb-3 me-2"
                                                    href="{{ route('admin.ong.usersassign', $organisation->idONG) }}"><i
                                                        class="fa fa-fw fa-edit"></i>
                                                    {{ __('Ver Usuarios con permisos') }}</a>

                                                <a class="btn btn-sm btn-success w-100 mb-3"
                                                    href="{{ route('admin.events.index', ['idONG' => $organisation->idONG])}}"><i
                                                        class="fa fa-fw fa-edit"></i>
                                                    {{ __('Ver Eventos') }}</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $organisations->links() !!}
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
                    <h1 class="modal-title fs-5" id="modalDeleteLabel">Eliminar ONG ¿Estas Seguro?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="." id="formDeleteModal" method="POST">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar ONG</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scriptsJS')
    <script src="/js/modalDelete.js"></script>
@endpush
