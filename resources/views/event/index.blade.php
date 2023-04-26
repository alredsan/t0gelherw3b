@extends('layouts.plantilla')

@section('titulo')
    Eventos
@endsection

@section('contenido')
    <div class="contanier_form_events">
        <h1>Busqueda</h1>
        <form action="{{ route('eventsFilter') }}" class="form_principal" method="GET">
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Buscar ..." name='nombre' value={{$request->get('nombre')}}>
                        <label for="floatingInput">Buscar por palabra</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name='selectType' aria-label="select tipo ">
                            @foreach($tipos as $tipo)
                                <option value={{$tipo->idtypeONG }}
                                @if($request->get('selectType') == $tipo->idtypeONG)
                                    selected
                                @endif
                                 > {{$tipo->Nombre}}</option>

                            @endforeach
                        </select>
                        <label for="floatingSelect">Tematica</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name='fecha' value={{$request->get('fecha')}}>
                        <label for="floatingInput">Fecha</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name='localidad'
                            placeholder="Buscar ...">
                        <label for="floatingInput">Localidad</label>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary botonSearch" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class='d-flex gap-5 m-5'>
        @foreach ($events as $event)
            <div class="card" style="width: 18rem;">
                <img src={{ 'data:image/jpeg;base64,' . base64_encode($event->Foto) . '' }} class="card-img-top" alt="{{$event->Nombre}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->Nombre }}</h5>
                    <p class="card-text">{{ $event->FechaEvento }}</p>
                    <a href="#" class="btn btn-primary">Más información</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Event') }}
                            </span>

                            {{-- <div class="float-right">
                                <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}
{{--
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr> --}}
                                        {{-- <th>No</th> --}}
{{--
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
                                            {{-- <td>{{ ++$i }}</td> --}}
{{--
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
                                            <td><img src={{ 'data:image/jpeg;base64,' . base64_encode($event->Foto) . '' }}
                                                    alt="HOla" /></td> --}}

                                                    {{-- <td> --}}
                                                {{-- <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('events.show', $event->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('events.edit', $event->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form> --}}
                                        {{--    </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                {!! $events->links() !!}
            </div>
        </div>
    </div>
@endsection
