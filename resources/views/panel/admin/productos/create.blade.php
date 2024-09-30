@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content_header')
    <h1>&nbsp;<strong>NUEVO PRODUCTO</strong></h1>
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
            @if (count($categorias) > 0)
                @include('panel.admin.productos.forms.form')
            @else
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="alert alert-danger mb-0" role="alert">
                            Se necesita tener al menos una categoria cargada para dar de alta un producto
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop