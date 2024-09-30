{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
{{--@section('plugins.Datatables', true)--}}
{{--@section('plugins.Sweetalert2', true)--}}

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Categorias')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>&nbsp;<strong>CATEGORIAS</strong></h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('categoria.create') }}" class="btn btn-success text-uppercase">
                Nueva Categoria 
            </a>
</div>
    