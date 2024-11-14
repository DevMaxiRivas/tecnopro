@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>&nbsp;<strong>Mi Perfil - {{ $cliente->name }} </strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">

        @if (session('alert'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                      </button>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                      </button>
                </div>
            </div>
        @endif
        <div class="container-fluid col-12 d-flex justify-content-between flex-wrap align-items-baseline" style="gap: 30px">
            
            @include('panel.admin.cliente.forms.form')
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop