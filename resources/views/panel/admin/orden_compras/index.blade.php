{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables y Sweetalert2 --}}
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

{{-- Título en la pestaña del navegador --}}
@section('title', 'Órdenes de Compra Finalizadas')

{{-- Título en el contenido de la Página --}}
@section('content_header')
    <h1>&nbsp;<strong>ÓRDENES DE COMPRA FINALIZADAS</strong></h1>
@stop

{{-- Contenido de la Página --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                
                <a href="{{ route('orden_compras.create') }}" class="btn btn-success text-uppercase">
                    Nueva Orden de Compra
                </a> 
            </div>

            {{-- Mostrar alertas en caso de actualizaciones o errores --}}
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
                        @if (count($compras_finalizadas) > 0)
                            <table id="datatable-ordenes" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase">Código</th>
                                        <th scope="col" class="text-uppercase">Proveedor</th>
                                        <th scope="col" class="text-uppercase">Última modificación</th>
                                        <th scope="col" class="text-uppercase">Estado</th>
                                        <th scope="col" class="text-uppercase text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras_finalizadas as $compra)
                                    <tr>
                                        <td>{{ $compra->id }}</td>
                                        <td>
                                            {{ $compra->proveedor->razon_social }}
                                            <br>
                                            <span class="badge badge-light">{{ $compra->proveedor->email }}</span>
                                        </td>
                                        <td>{{ $compra->updated_at }}</td>
                                        <td>
                                            @if ($compra->estado_compra == 4)
                                                <span class="badge badge-warning">Enviada</span>
                                            @elseif($compra->estado_compra== 5)
                                                <span class="badge badge-primary">Confirmada</span>
                                            @elseif($compra->estado_compra == 6)
                                                <span class="badge badge-success">Finalizada</span>
                                            @elseif($compra->estado_compra == 0)
                                                <span class="badge badge-success">Pendiente</span>
                                            @elseif($compra->estado_compra == 3)
                                                <span class="badge badge-success">Cancelada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                @if ($compra->estado_compra !=3 )
                                                <a href="{{ route('orden_compras.pdf', $compra->id) }}" title="Generar Factura" class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                 @endif

                                                <a href="{{ route('orden_compras.show', $compra) }}" title="Agregar Precio" class="btn btn-sm btn-primary text-white text-uppercase mr-2">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>
                                            
                                                @if ($compra->estado_compra != 6 || $compra->estado_compra != 3)
                                                <a href="{{ route('orden_compras.edit', $compra) }}" title="Editar OC" class="btn btn-sm btn-secondary text-white text-uppercase me-1">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                                @endif                                            
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger mb-0" role="alert">
                                No hay órdenes de compra finalizadas disponibles.
                            </div>                          
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Importación de archivos CSS --}}
@section('css')
    <style>
        /* Puedes agregar aquí estilos adicionales si los necesitas */
    </style>
@stop

{{-- Importación de archivos JS --}}
@section('js')
   
@stop
