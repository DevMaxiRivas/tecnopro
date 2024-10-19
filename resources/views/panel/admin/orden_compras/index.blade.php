{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
{{-- @section('plugins.Datatables', true) --}}
{{-- @section('plugins.Sweetalert2', true) --}}

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'OrdenDeCompras')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>&nbsp;<strong>ORDENES DE COMPRAS NUEVA VERSION</strong></h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">

                <a href="{{ route('orden_compras.create') }}" class="btn btn-success text-uppercase">
                    Nueva Orden de compra
                </a>

                {{-- <a href="{{ route('exportar-productos-pdf') }}" class="btn btn-danger" title="PDF" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                </a>

                <a href="{{ route('exportar-productos-excel') }}" class="btn btn-success" title="Excel">
                    <i class="fas fa-file-excel"></i>
                </a> --}}


            </div>

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

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($o_compras) > 0)
                            <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase">Codigo</th>
                                        <th scope="col" class="text-uppercase">Proveedor</th>
                                        <th scope="col" class="text-uppercase">Última modificacion</th>
                                        <th scope="col" class="text-uppercase">Estado</th>
                                        <th scope="col" class="text-uppercase text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($o_compras as $o_compra)
                                    <tr>
                                        <td>{{ $o_compra->id }}</td>
                                        <td>
                                        {{ $o_compra->proveedor->razon_social }}
                                        <br>
                                        <span class="badge badge-light">{{ $o_compra->proveedor->email }}</span>
                                        </td>
                                        <td>{{ $o_compra->updated_at }}</td>
                                        <td>
                                            @if ($o_compra->estado_pedido == 0)
                                                <span class="badge badge-warning">Pendiente</span>
                                            @elseif($o_compra->estado_pedido == 1)
                                                <span class="badge badge-primary">En espera</span>
                                            @elseif($o_compra->estado_pedido == 2)
                                                <span class="badge badge-success">Recibido</span>
                                            @elseif($o_compra->estado_pedido == 3)
                                                <span class="badge badge-danger">Cancelado</span>
                                            @endif
                                        </td>
                                        
                                       {{-- <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('detalle-orden-compra.index', $o_compra->id) }}" title="Cargar producto" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>

                                                </a>
                                                @if ($o_compra->estado_pedido == 1 || $o_compra->estado_pedido == 2)
                                                    <a href="{{ route('compras.pdf', $o_compra->id) }}" title="Generar Reporte" class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @endif

                                                {{-- <a href="#" title="Cancelar OC" class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a> 

                                                @if ($o_compra->estado_pedido == 0 || $o_compra->estado_pedido == 1)
                                                    <a href="{{ route('compras.edit', $o_compra) }}" title="Editar OC" class="btn btn-sm btn-secondary text-white text-uppercase me-1">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                
                                            </div>
                                        </td>--}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger mb-0" role="alert">
                                No hay ordenes de compras disponibles
                            </div>                          
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @stop

    {{-- Importacion de Archivos CSS --}}
    @section('css')

    @stop


    {{-- Importacion de Archivos JS --}}
    @section('js')
        
    @stop
