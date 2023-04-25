@extends('layouts.app')

@section('template_title')
    Event
@endsection

@section('content')
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
                                <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
                                        
										<th>Idevento</th>
										<th>Id Ong</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Fechaevento</th>
										<th>Nummaxvoluntarios</th>
										<th>Direccion</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Aportaciones</th>
										<th>Foto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $event->idEvento }}</td>
											<td>{{ $event->id_ONG }}</td>
											<td>{{ $event->Nombre }}</td>
											<td>{{ $event->Descripcion }}</td>
											<td>{{ $event->FechaEvento }}</td>
											<td>{{ $event->numMaxVoluntarios }}</td>
											<td>{{ $event->Direccion }}</td>
											<td>{{ $event->Latitud }}</td>
											<td>{{ $event->Longitud }}</td>
											<td>{{ $event->Aportaciones }}</td>
											<td>{{ $event->Foto }}</td>

                                            <td>
                                                <form action="{{ route('events.destroy',$event->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('events.show',$event->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('events.edit',$event->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
