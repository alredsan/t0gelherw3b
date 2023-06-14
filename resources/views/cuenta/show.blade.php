@extends('layouts.plantillaCuenta')

@section('titulo')
    Perfil
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="p-3">
                            <div class="float-left">
                                <p class="card-title fs-1 fw-bold">{{ __('Perfil Voluntario') }}</p>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('cuenta.edit') }}"> {{ __('Editar Perfil') }}</a>

                                <button data-action="{{ route('cuenta.user.destroy') }}" class="btn btn-danger btnDelete">
                                    <i class="bi bi-eraser me-2"></i>Eliminar Usuario</button>
                            </div>

                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="card-body row">
                        <div class="col-lg">
                            <div class="form-group">
                                <strong>DNI:</strong>
                                {{ $user->DNI }}
                            </div>
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {{ $user->name }}
                            </div>
                            <div class="form-group">
                                <strong>Apellidos:</strong>
                                {{ $user->Apellidos }}
                            </div>
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                            <div class="form-group">
                                <strong>Dirección:</strong>
                                {{ $user->Direccion }}
                            </div>
                            <div class="form-group">
                                <strong>Provincia:</strong>
                                {{ $user->ProvinciaLocalidad }}
                            </div>
                            <div class="form-group">
                                <strong>Teléfono:</strong>
                                {{ $user->Telefono }}
                            </div>
                            @if ($user->id_ONG)
                                <div class="form-group">
                                    <strong>ONG al que tienes permiso:</strong>
                                    {{ $user->organisation->Name }}
                                </div>
                            @endif

                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <img src={{ asset($user->Foto) }} class="card-img-top w-50" alt="Foto Perfil">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteLabel">Eliminar Usuario ¿Estas Seguro?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cuenta.user.destroy') }}" id="formDeleteModal" method="POST">
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
    <script src="/js/modalDelete.js"></script>
@endpush
