@extends('layouts.plantillaAdmin')

@section('titulo')
    Voluntarios Apuntados
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
                                <h1>Voluntarios Apuntados <i>"{{ $event->Nombre }}"</i></h1>
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
                                            <th>Fecha Apuntado</th>
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
                                                <td data-head="Fecha Apuntado">
                                                    {{ date('d-m-Y H:m', $user->pivot->registration_date) }}</td>

                                                <td data-head="Acciones">
                                                    {{-- @if (Auth::User()->id != $user->id)
                                                        <button type='button' class="btn btn-sm btn-success btnEdit"
                                                            data-src="{{ route('api.ong.usersassign', $user->id) }}">Editar
                                                            Rol</button> --}}
                                                    @if (!Auth::user()->roles('4') || Auth::user()->roles('1'))
                                                        <form
                                                            action="{{ route('admin.event.destroyParticipante', ['idEvent' => $event->idEvento, 'idUser' => $user->id]) }}"
                                                            method="POST">
                                                            @csrf

                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar
                                                                Participante</button>
                                                        </form>
                                                    @endif
                                                    {{-- @else
                                                        <p class='fw-lighter'>No esta permitido</p>
                                                    @endif  --}}
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
    </div>
@endsection
