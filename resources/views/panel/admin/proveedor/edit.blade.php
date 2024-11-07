@extends('adminlte::page')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> --}}

@section('plugins.Sweetalert2', true)

@section('title', 'Editar')
@section('content_header')
    <h1>
        <strong>
            Editar Proveedor "{{ $proveedor->razon_social }}"
        </strong>
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Centrado horizontalmente -->
        <div class="col-12 mb-3">
            <a href="{{ route('proveedor.index') }}" class="btn btn-sm" style="background-color: #022340; color: white; text-transform: uppercase;">
                Volver Atrás
            </a>
        </div>
        <div class="col-12">
            @include('panel.admin.proveedor.forms.form')
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop


