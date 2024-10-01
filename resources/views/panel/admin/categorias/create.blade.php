@extends('adminlte::page')

@section('title', 'Crear Categoria')

@section('content_header')
    <h1>&nbsp;<strong>NUEVA CATEGORIA</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('categoria.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atras
            </a>
        </div>

        <div class="col-12">
            @include('panel.admin.categorias.forms.form')
        </div>

    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop