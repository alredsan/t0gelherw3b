@extends('layouts.plantillaAdmin')

@section('titulo', 'Eventos')

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Event') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.ong.event.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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

										<th>Idevento</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Fechaevento</th>
										<th>Nummaxvoluntarios</th>
										<th>Direccion</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Aportaciones</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>

											<td>{{ $event->idEvento }}</td>
											<td>{{ $event->Nombre }}</td>
											<td>{{ $event->Descripcion }}</td>
                                            <td>{{ date('d-m-Y', $event->FechaEvento); }}</td>
											<td>{{ $event->numMaxVoluntarios }}</td>
											<td>{{ $event->Direccion }}</td>
											<td>{{ $event->Latitud }}</td>
											<td>{{ $event->Longitud }}</td>
											<td>{{ $event->Aportaciones }}</td>

                                            <td>
                                                <form action="{{ route('admin.ong.event.destroy',$event->idEvento) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('events.show',$event->idEvento) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.ong.event.edit',$event->idEvento) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $events->links() !!}
            </div>
        </div>
    </div>
@endsection
