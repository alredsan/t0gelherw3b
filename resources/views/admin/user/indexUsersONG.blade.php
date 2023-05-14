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
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <h5>Usuarios con Permisos</h5>
                            </span>

                            <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Añadir Persona
                                </button>
                                {{-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>

                                        <th>Name</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Provincialocalidad</th>
                                        <th>Telefono</th>

                                        <th>Roles</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->Apellidos }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->ProvinciaLocalidad }}</td>
                                            <td>{{ $user->Telefono }}</td>
                                            <td>
                                                @foreach ($user->usersRole as $role)
                                                    <div class='alert alert-info p-0 m-0 text-center'>
                                                        <span class="infoRol">{{ $role->NombreRol }}</span>
                                                    </div>
                                                @endforeach
                                            </td>

                                            <td>
                                                <button type='button' class="btn btn-sm btn-success btnEdit"
                                                    data-src="{{ route('admin.ong.usersassign.edit', $user->id) }}">Editar Rol</button>
                                                <form action="{{ route('admin.ong.usersassign.delete', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @if (Auth::User()->id != $user->id)
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.ong.usersassign.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        {{-- <form action="{{ route('api.searchUsers') }}" method="get" name='searchUser' id='searchUser'> --}}
                        <div data-route="{{ route('api.searchUsers') }}" name='searchUser' id='searchUser'>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name='email'
                                    placeholder="Buscar ..." autocomplete="off">
                                <label for="floatingInput">Buscar por palabra</label>
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
