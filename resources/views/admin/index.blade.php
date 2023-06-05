@extends('layouts.plantillaAdmin')

@section('titulo', 'Admin')

@section('contenido')
   <h1>Hola {{ Auth::user()->name }}</h1>
@endsection
