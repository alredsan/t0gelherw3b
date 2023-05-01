@extends('layouts.plantillaAdmin')

@section('titulo')
    {{-- {{ $user->name ?? "{{ __('Show') User" }} --}}
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Organisation') }}
                            </span>

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

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        {{-- <th>No</th> --}}

										<th>Idong</th>
										<th>Name</th>
										<th>Direccionsede</th>
										<th>Descripcion</th>
										<th>Fechacreacion</th>
										<th>Ibanmetodopago</th>
										<th>Fotologo</th>
										<th>Email</th>
										<th>Telefono</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                        <tr>
                                            {{-- <td>{{ ++$i }}</td> --}}

											<td>{{ $organisation->idONG }}</td>
											<td>{{ $organisation->Name }}</td>
											<td>{{ $organisation->DireccionSede }}</td>
											<td>{{ $organisation->Descripcion }}</td>
											<td>{{ $organisation->FechaCreacion }}</td>
											<td>{{ $organisation->IBANmetodoPago }}</td>
											<td><img src="{{ asset($organisation->FotoLogo) }}" class='w-25' alt="LogoONG"></td>

											<td>{{ $organisation->eMail }}</td>
											<td>{{ $organisation->Telefono }}</td>

                                            <td>
                                                <form action="{{ route('admin.ong.destroy',$organisation->idONG) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.ong.show',$organisation->idONG) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.ong.edit',$organisation->idONG) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
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
