@extends('layouts.plantillaAdmin')

@section('titulo', 'Eventos')

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h1 id="card_title">
                                {{ __('Eventos') }}
                            </h1>

                             <div class="float-right">
                                <a href="{{ route('admin.ong.event.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo evento') }}
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
                                {!! $events->links() !!}
                            </div>
                        </div>
                        <div>
                            <table class="table table-striped table-hover" id='tableAdmin'>
                                <thead class="thead">
                                    <tr>

										<th>Idevento</th>
										<th>Nombre</th>
										<th>Fecha evento</th>
										<th>Nº max de voluntarios</th>
										<th>Direccion</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Aportaciones</th>

                                        <th>Acciones</th>
                                        <th>Usuarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                        <tr>

											<td data-head='Idevento'>{{ $event->idEvento }}</td>
											<td data-head='Nombre'>{{ $event->Nombre }}</td>
                                            <td data-head='Fecha evento'>{{ date('d-m-Y', $event->FechaEvento); }}</td>
											<td data-head='Nº max de voluntarios'>{{ $event->numMaxVoluntarios }}</td>
											<td data-head='Direccion'>{{ $event->Direccion }}</td>
											<td data-head='Latitud'>{{ $event->Latitud }}</td>
											<td data-head='Longitud'>{{ $event->Longitud }}</td>
											<td data-head='Aportaciones'>{{ $event->Aportaciones }}</td>

                                            <td data-head='Acciones'>
                                                <form action="{{ route('admin.ong.event.destroy',$event->idEvento) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('events.show',$event->idEvento) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.ong.event.edit',$event->idEvento) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ route('admin.ong.event.edit',$event->idEvento) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Ver participantes') }}</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>No hay registros</tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class='encabPie'>
                            <div></div>
                            <div>
                                {!! $events->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
