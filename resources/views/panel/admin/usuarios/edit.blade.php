@extends('adminlte::page')

@section('title', 'Editar usuario')

@section('content_header')
    <h1>
        <strong>
            Editar datos del usuario "{{ $usuario->name }}"
        </strong>
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Centrado horizontalmente -->
        <div class="col-12 mb-3">
            <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atrás
            </a>
        </div>
        <div class="col-12">
            @include('panel.admin.usuarios.forms.form')
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')

@stop


