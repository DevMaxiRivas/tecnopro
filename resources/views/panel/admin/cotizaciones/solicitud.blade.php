
@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>
        <strong>
        <i class="fa fa-upload" aria-hidden="true"></i>
        SUBIR PRESUPUESTO   
            
        </strong>
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @include('panel.admin.cotizaciones.forms.form')
            
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop






















