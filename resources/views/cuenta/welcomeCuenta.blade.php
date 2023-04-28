@extends('layouts.plantillaCuenta')

@section('titulo', 'Cuenta')

@section('contenido')
   {{-- <h1>Hola</h1> --}}
   <h1>Bienvenido, {{ Auth::user()->name }}</h1>
@endsection
