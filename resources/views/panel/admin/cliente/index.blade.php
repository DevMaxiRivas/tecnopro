@extends('adminlte::page')

@section('title', 'Inicio')



@section('content_header')
<h1>&nbsp;<strong>Bienvenido a su Panel</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            {{-- <h1>Bienvenido a su Panel</h1> --}}
            <a href= # {{--"{{  route('home') }}"--}}  class="btn btn-sm btn-info text-uppercase p-2">
                <i class="fas fa-shopping-cart"></i> Seguir comprando
            </a>
        </div>
    </div>
</div>
    
@stop  


