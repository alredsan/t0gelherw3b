@extends('layouts.plantillaAdmin')

@section('titulo')
    Permisos de Usuarios
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
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

                <div class="">
                    <div class="card-header">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h1>Usuarios con Permisos <i>"{{ $organisation->Name }}"</i></h1>
                                <div class="float-right">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalAddAssign">
                                        Añadir Persona
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id='tableAdmin'>
                                    <thead class="thead">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Email</th>
                                            <th>Provincia</th>
                                            <th>Telefono</th>
                                            <th>Roles</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>

                                                <td data-head="Nombre">{{ $user->name }}</td>
                                                <td data-head="Apellidos">{{ $user->Apellidos }}</td>
                                                <td data-head="Email">{{ $user->email }}</td>
                                                <td data-head="Provincia">{{ $user->ProvinciaLocalidad }}</td>
                                                <td data-head="Telefono">{{ $user->Telefono }}</td>
                                                <td data-head="Roles">
                                                    <div class='alert alert-info p-0 m-0 text-center'>
                                                        <span class="infoRol"> {{ $user->rol->NombreRol }}</span>
                                                    </div>
                                                </td>

                                                <td data-head="Acciones">
                                                    @if (Auth::User()->id != $user->id)
                                                        <button type='button' class="btn btn-sm btn-success btnEdit"
                                                            data-src="{{ route('api.ong.usersassign', $user->id) }}">Editar
                                                            Rol</button>

                                                        <button type="submit"
                                                            data-action="{{ route('admin.ong.usersassign.delete', $user->id) }}"
                                                            class="btn btn-danger btn-sm btnDelete">Eliminar</button>
                                                    @else
                                                        <p class='fw-lighter'>No esta permitido</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <th colspan="10" class="text-center">No hay Usuarios con permisos</th>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAddAssign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalAddAssignLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAddAssignLabel">Asignar Persona</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name='fAssignUser' action="{{ route('admin.ong.usersassign.add', $organisation->idONG) }}"
                        method="post">
                        @csrf
                        <div class="modal-body">
                            <div data-route="{{ route('api.searchUsers') }}" id='searchUser'>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="email" name='email'
                                        placeholder="Buscar ..." autocomplete="off">
                                    <label for="email">Buscar por Correo electronico</label>
                                    <div class="invalid-feedback">Debes seleccionar una persona de la lista para continuar
                                    </div>
                                </div>
                                <div id="listUsers"></div>
                            </div>
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input type="radio" name="chxRol" value="{{ $role->idRol }}"
                                        id="{{ $role->idRol }}" required>
                                    <label for="{{ $role->idRol }}">{{ $role->NombreRol }}</label>
                                    @if ($loop->last)
                                        <div id="msgRadio" class="invalid-feedback">Debes seleccionar un rol</div>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Añadir Persona</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditAssign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditAssignLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditAssignLabel">Editar Permisos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.ong.usersassign.edit') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <p id='pName'></p>
                            <input type="hidden" name="idUser" id='idUser' value=''>
                            <strong>Permisos:</strong>
                            <div>
                                @foreach ($roles as $role)
                                    <input type="radio" class='chkRoleEdit' name="chxRolEdit"
                                        value="{{ $role->idRol }}" id="role{{ $role->idRol }}">
                                    <label for="role{{ $role->idRol }}">{{ $role->NombreRol }}</label>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Editar Rol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDeleteLabel">Eliminar privilegios del usuario ¿Estas Seguro?
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="formDeleteModal" method="POST">
                        <div class="modal-body">
                            @csrf

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Quitar privilegios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scriptsJS')
    <script src="/js/scriptAssign.js"></script>
    <script src="/js/validation.js"></script>
    <script src="/js/modalDelete.js"></script>
@endpush
