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
                                <a href="{{ route('admin.types.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                                <form action="{{ route('admin.types.destroy',$type->idtypeONG) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('types.show',$type->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.types.edit',$type->idtypeONG) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
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
@endsection
