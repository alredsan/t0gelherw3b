@extends('layouts.plantillaCuenta')

@section('titulo')
    Eventos Apuntados
@endsection

@section('contenido')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Eventos Apuntados</span>
                    </div>
                    @if ($message = Session::get('success-events'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>


                                    <th>Idevento</th>
                                    <th>Nombre ONG</th>
                                    <th>Evento</th>
                                    <th>Descripcion</th>
                                    <th>Fecha</th>
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
                                {{-- bucle --}}
                                @foreach ($user->eventos as $event)
                                    <tr>


                                        <td>{{ $event->idEvento }}</td>
                                        <td>{{ $event->organisation->Name }}</td>
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
                                            <form
                                                action="{{ route('event.destroyParticipante', ['id' => $event->idEvento]) }}"
                                                method="POST">
                                                {{-- <a class="btn btn-sm btn-primary "
                                                    href="{{ route('events.show', $event->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}

                                                @csrf
                                                @if ($event->FechaEvento > time())
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i>
                                                        {{ __('Desapuntar') }}</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
