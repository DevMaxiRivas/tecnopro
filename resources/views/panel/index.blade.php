@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1><b>¡Bienvenido {{ auth()->user()->name }}!</b></h1>
@stop

@section('content')
<div class="row">

    @role('admin|empleado_ventas|empleado_compras')

        {{-- @foreach ($results as $result)
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body border-left-blue">
                    <h5 class="card-title text-lg font-weight-bold ">{{ $result['nombre'] }}</h5>
                    <p class="card-text text-xl font-weight-bold text-right">{{ $result['cantidad']}}</p>
                </div>
            </div>
        </div>
        @endforeach --}}

        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body border-left-blue">
                    <h5 class="card-title text-lg font-weight-bold">
                        <i class="fas fa-map-marked-alt"></i>
                        Mapa de Ventas
                    </h5>
                    <p class="card-text text-xl font-weight-bold text-right m-0">
                        <button id="button_map" class="card-text btn btn-sm btn-primary">
                            Abrir
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-mapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">  
                <div id="content" class="modal-content">

                    <div class="modal-header bg-primary">
                        <h6 class="modal-title">Mapa de Ventas (PAGADO, EN PREPARACION y ENVIADO)</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div id="map_2"></div>

                </div>
            </div>
        </div>
    @endrole
</div>
@stop

@section('css')
    @role('admin|empleado_ventas|empleado_compras')
        <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet-gesture-handling.min.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/leaflet/control-fullscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/leaflet/markercluster.css') }}">

        <link rel="stylesheet" href="{{ asset('css/mapa.css') }}">
    @endrole
@stop

@section('js')
    @role('admin|empleado_ventas|empleado_compras')
        <script src="{{ asset('js/leaflet/leaflet.min.js') }}"></script>
        {{-- <script src="{{ asset('js/leaflet/leaflet-gesture-handling.min.js') }}"></script> --}}
        <script src="{{ asset('js/leaflet/control-fullscreen.js') }}"></script>
        <script src="{{ asset('js/leaflet/markercluster.min.js') }}"></script>

        <script src="{{ asset('js/util/mapa.js') }}"></script>
        <script src="{{ asset('js/util/modal.js') }}"></script>
        <script src="{{ asset('js/panel/home.js') }}"></script>
    @endrole
@stop
