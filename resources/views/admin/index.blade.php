@extends('layouts.plantillaAdmin')

@section('titulo', 'Admin')

@section('contenido')
   <h1>Hola {{ Auth::user()->name }}</h1>
   <img src="img/eventWithoutPhoto.png" class="img-fluid rounded mx-auto d-block shadow mt-5" alt="Inicio Admin">
@endsection
