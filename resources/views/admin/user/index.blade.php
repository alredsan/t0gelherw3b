@extends('layouts.plantillaAdmin')

@section('titulo')
    Usuarios
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h1 id="card_title">
                                {{ __('Usuarios') }}
                            </h1>

                            <div class="float-right">
                                <a href="{{ route('admin.ong.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear nuevo Usuario') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $users->links() !!}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>
                                        {{-- <th>No</th> --}}

                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Fotografia</th>
                                        {{-- <th></th> --}}

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>

                                            <td data-head="DNI">{{ $user->DNI }}</td>
                                            <td data-head="Nombre">{{ $user->name }}</td>
                                            <td data-head="Apellidos">{{ $user->Apellidos }}</td>
                                            <td data-head="Email">{{ $user->email }}</td>

                                            <td data-head="Foto Perfil"><img src="{{ asset($user->Foto) }}"
                                                    style="width:100px" alt="Foto Perfil"></td>

                                            <td data-head="Acciones">

                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('admin.ong.show',$organisation->idONG) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.user.edit', $user->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf

                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btnDelete"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>

                                                </form>
                                            </td>
                                            {{-- <td>
                                                 <a class="btn btn-sm btn-success" href="{{ route('admin.ong.usersassign',$organisation->idONG) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Ver Usuarios con permisos') }}</a>

                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalDeleteUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDeleteUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteUserLabel">Eliminar Usuario ¿Estas Seguro?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.user.destroy') }}" id="formDeleteUserModal" method="POST">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Eliminar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scriptsJS')
    <script src="/js/validation.js"></script>
@endpush
