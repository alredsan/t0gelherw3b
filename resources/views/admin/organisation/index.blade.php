@extends('layouts.plantillaAdmin')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
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
                                        {{-- <th>No</th> --}}

										<th>Idong</th>
										<th>Name</th>
										<th>Direccionsede</th>
										<th>Fechacreacion</th>
										<th>IBAN</th>
										<th>Logo</th>
										<th>Email</th>
										<th>Telefono</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                        <tr>

											<td data-head="Idong">{{ $organisation->idONG }}</td>
											<td data-head="Nombre">{{ $organisation->Name }}</td>
											<td data-head="Direccion">{{ $organisation->DireccionSede }}</td>
											<td data-head="Fecha creacion">{{ $organisation->FechaCreacion }}</td>
											<td data-head="IBAN">{{ $organisation->IBANmetodoPago }}</td>
											<td data-head="Logo"><img src="{{ asset($organisation->FotoLogo) }}" class='w-25' alt="LogoONG"></td>
											<td data-head="Email">{{ $organisation->eMail }}</td>
											<td data-head="Telefono">{{ $organisation->Telefono }}</td>

                                            <td data-head="Acciones">
                                                <form action="{{ route('admin.ong.destroy',$organisation->idONG) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.ong.show',$organisation->idONG) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.ong.edit',$organisation->idONG) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
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
@endsection
