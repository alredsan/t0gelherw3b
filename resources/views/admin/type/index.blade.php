@extends('layouts.plantillaAdmin')

@section('titulo')
    Tipos
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h1 id="card_title">
                                {{ __('Tipos Evento') }}
                            </h1>

                            <div class="float-right">
                                <a href="{{ route('admin.types.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear nuevo tipo') }}
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>

                                        <th>Id</th>
                                        <th>Nombre</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td data-head="Id">{{ $type->idtypeONG }}</td>
                                            <td data-head="Nombre">{{ $type->Nombre }}</td>
                                            <td data-head="Acciones">
                                                <a class="btn btn-sm btn-success" href="{{ route('admin.types.edit', $type->idtypeONG) }}">{{ __('Editar') }}</a>

                                                <button type="submit"
                                                    data-action="{{ route('admin.types.destroy', $type->idtypeONG) }}"
                                                    class="btn btn-danger btn-sm btnDelete"> {{ __('Eliminar') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $types->links() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteLabel">Eliminar Tipo ¿Estas Seguro?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="formDeleteModal" method="POST">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar tipo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scriptsJS')
    <script src="/js/modalDelete.js"></script>
@endpush
