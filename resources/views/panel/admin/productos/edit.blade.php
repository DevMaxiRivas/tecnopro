@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>
        <strong>
            Editar producto "{{ $producto->nombre }}"
        </strong>
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('producto.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atras
            </a>
        </div>
        <div class="col-12">
            @include('panel.administrador.lista_productos.forms.form')
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop