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
    <div class='d-flex gap-5 m-5 flex-wrap'>
        @foreach ($events as $event)
            <div class="card" style="width: 18rem;">
                <div style="background-image:url({{ asset($event->Foto) }});height:20vh;background-repeat: no-repeat;background-size: cover;background-position: center;" class="card-img-top" alt="{{$event->Nombre}}"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $event->Nombre }}</h5>
                    <p class="card-text">{{ $event->FechaEvento }}</p>
                    <a href="{{route('events.show',$event->idEvento)}}" class="btn btn-primary">Más información</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {!! $events->links() !!}
            </div>
        </div>
    </div>
@endsection
