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

                            {{-- <div class="float-right">
                                <a href="{{ route('admin.ong.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear nuevo Usuario') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body bg-white mb-3">

                        <form action="{{ route('admin.users.index') }}" method="get">

                            {{-- @csrf --}}
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="name">Buscar por nombre</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="@php echo isset($_GET['name']) ? $_GET['name']:"" @endphp" placeholder="Buscar ...">

                                </div>
                                <div class="form-group col-sm">
                                    <label for="name">Buscar por Apellidos</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname"
                                        value="@php echo isset($_GET['lastname']) ? $_GET['lastname'] :"" @endphp" placeholder="Buscar ...">

                                </div>
                                <div class="box-footer text-end mt-2">
                                    @if(isset($_GET['name']) || isset($_GET['lastname']) )
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i class="bi bi-eraser me-2"></i>Eliminar Busqueda</a>
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
                                {!! $users->links() !!}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Fotografía</th>

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

                                            <td data-head="Foto Perfil"><img src="{{ asset($user->Foto) }}" class="imgTable"
                                                    alt="Foto Perfil"></td>

                                            <td data-head="Acciones">
                                                <div>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.user.edit', $user->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @if ($user->id != $userAuth->id)
                                                        <button type="submit"
                                                            data-action="{{ route('admin.user.destroy', $user->id) }}"
                                                            class="btn btn-danger btn-sm btnDelete"><i
                                                                class="fa fa-fw fa-trash"></i>
                                                            {{ __('Eliminar') }}</button>
                                                    @endif
                                                </div>
                                            </td>
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


    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteLabel">Eliminar Usuario ¿Estas Seguro?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.user.destroy') }}" id="formDeleteModal" method="POST">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scriptsJS')
    <script src="/js/validation.js"></script>
    <script src="/js/modalDelete.js"></script>
@endpush
