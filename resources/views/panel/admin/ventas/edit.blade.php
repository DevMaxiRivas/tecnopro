@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>
        <strong>
            Editar Venta N° {{ $venta->id }}  
        </strong>
    </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('ventas.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                    Volver Atrás
                </a>
            </div>
            <div class="col-12">
                @include('panel.admin.ventas.forms.form')
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

