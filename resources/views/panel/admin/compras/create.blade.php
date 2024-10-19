@extends('adminlte::page')

@section('title', 'Crear OC')

@section('content_header')
    <h1>&nbsp;<strong> NUEVA SOLICITUD DE COMPRA</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('compras.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atras
            </a>
        </div>

        <div class="col-12">
            @if (count($proveedores) > 0)
                @include('panel.admin.compras.forms.form')
            @else
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="alert alert-danger mb-0" role="alert">
                            "No hay proveedores activos disponibles"
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