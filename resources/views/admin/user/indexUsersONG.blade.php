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
                {{-- <h1>Usuarios con Permisos</h1> --}}

                <div class="">
                    <div class="card-header">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span id="card_title">
                                    <h1>Usuarios con Permisos <i>"{{$organisation->Name }}"</i></h1>
                                </span>

                                <div class="float-right">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalAddAssign">
                                        Añadir Persona
                                    </button>
                                    {{-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a> --}}
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
                                                    @foreach ($user->usersRole as $role)
                                                        <div class='alert alert-info p-0 m-0 text-center'>
                                                            <span class="infoRol">{{ $role->NombreRol }}</span>
                                                        </div>
                                                    @endforeach
                                                </td>

                                                <td data-head="Acciones">
                                                    @if (Auth::User()->id != $user->id)
                                                        <button type='button' class="btn btn-sm btn-success btnEdit"
                                                            data-src="{{ route('api.ong.usersassign', $user->id) }}">Editar
                                                            Rol</button>
                                                        <form
                                                            action="{{ route('admin.ong.usersassign.delete', $user->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Eliminar</button>
                                                        </form>
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
                        <h1 class="modal-title fs-5" id="modalAddAssignLabel">Nueva Persona</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name='fAssignUser' action="{{ route('admin.ong.usersassign.add',$organisation->idONG) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            {{-- <form action="{{ route('api.searchUsers') }}" method="get" name='searchUser' id='searchUser'> --}}
                            <div data-route="{{ route('api.searchUsers') }}" name='searchUser' id='searchUser'>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="email" name='email'
                                        placeholder="Buscar ..." autocomplete="off">
                                    <label for="floatingInput">Buscar por Correo electronico</label>
                                </div>
                                <div id="listUsers"></div>
                                {{-- </form> --}}
                            </div>
                            @foreach ($roles as $role)
                                <input type="checkbox" name="chxRol[{{ $role->idRol }}]" id="role{{ $role->idRol }}">
                                <label for="role{{ $role->idRole }}">{{ $role->NombreRol }}</label>
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
                                    <input type="checkbox" class='chkRoleEdit' name="chxRolEdit[{{ $role->idRol }}]"
                                        id="role[{{ $role->idRol }}]">
                                    <label for="role{{ $role->idRole }}">{{ $role->NombreRol }}</label>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('scriptsJS')
        <script src="/js/scriptAssign.js"></script>
    @endpush
