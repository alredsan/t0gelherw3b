@extends('layouts.plantillaCuenta')

@section('titulo')
    Eventos Apuntados
@endsection

@section('contenido')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h1 class="card-title pb-5">Eventos Apuntados Proximos</h1>

                            @if ($message = Session::get('success-events'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableAdmin">
                                <thead class="thead">
                                    <tr>
                                        <th>Idevento</th>
                                        <th>Nombre ONG</th>
                                        <th>Evento</th>
                                        <th>Fecha</th>
                                        <th>Direccion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- bucle --}}
                                    @foreach ($user->eventos as $event)
                                        <tr>
                                            @if ($event->Visible == 1)
                                                <td data-head="Identificacion">{{ $event->idEvento }}</td>
                                                <td data-head="Nombre ONG">{{ $event->organisation->Name }}</td>
                                                <td data-head="Nombre">{{ $event->Nombre }}</td>
                                                <td data-head="Fecha">{{ date('d-m-Y H:m', $event->FechaEvento) }}</td>

                                                <td data-head="Direccion">{{ $event->Direccion }}</td>

                                                <td data-head="Acciones">
                                                    <form
                                                        action="{{ route('event.destroyParticipante', ['id' => $event->idEvento]) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('events.show', $event->idEvento) }}"><i
                                                                class="fa fa-fw fa-eye"></i> Ver</a>

                                                        @csrf
                                                        @if ($event->FechaEvento > time())
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                                    class="bi bi-eraser"></i>
                                                                {{ __('Desapuntar') }}</button>
                                                        @else
                                                            <i>Evento Finalizado</i>
                                                        @endif
                                                    </form>
                                                </td>
                                            @else
                                                <td colspan="6" class="text-center"><i>Este Evento ha sido ocultado</i>
                                                </td>
                                            @endif
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
