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
                                <a href="{{ route('admin.ong.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>

										<th>Idong</th>
										<th>Logo</th>
										<th>Name</th>
										<th>Direccionsede</th>
										<th>Fechacreacion</th>
										<th>IBAN</th>
										<th>Email</th>
										<th>Telefono</th>

                                        <th>Acciones</th>
                                        <th>Permisos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                        <tr>

											<td data-head="Idong">{{ $organisation->idONG }}</td>
											<td data-head="Logo"><img src="{{ asset($organisation->FotoLogo) }}"  class="imgTable" alt="LogoONG"></td>
											<td data-head="Nombre">{{ $organisation->Name }}</td>
											<td data-head="Direccion">{{ $organisation->DireccionSede }}</td>
											<td data-head="Fecha creacion">{{ $organisation->FechaCreacion }}</td>
											<td data-head="IBAN">{{ $organisation->IBANmetodoPago }}</td>
											<td data-head="Email">{{ $organisation->eMail }}</td>
											<td data-head="Telefono">{{ $organisation->Telefono }}</td>

                                            <td data-head="Acciones" class="formActions">

                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.ong.show',$organisation->idONG) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.ong.edit',$organisation->idONG) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>

                                                    <button type="submit"
                                                        data-action="{{ route('admin.ong.destroy', $organisation->idONG) }}"
                                                        class="btn btn-danger btn-sm btnDelete"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('admin.ong.usersassign',$organisation->idONG) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Ver Usuarios con permisos') }}</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $organisations->links() !!}
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
                <form action="" id="formDeleteModal" method="POST">
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
