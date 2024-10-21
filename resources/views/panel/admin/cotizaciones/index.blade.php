{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
{{-- @section('plugins.Datatables', true) --}}
{{-- @section('plugins.Sweetalert2', true) --}}

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Cotizaciones')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>&nbsp;<strong>MIS SOLICITUDES DE COTIZACION</strong></h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">

                <a href="{{ route('compras.create') }}" class="btn btn-success text-uppercase">
                    Nueva Solicitud de cotizacion 
                </a>

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

            @if (session('error'))
            <div class="col-12">
                <div class="alert alert-danger">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($compras) > 0)
                            <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase">Codigo</th>
                                        <th scope="col" class="text-uppercase">Proveedor</th>
                                        <th scope="col" class="text-uppercase">Última modificacion</th>
                                        <th scope="col" class="text-uppercase">Estado</th>
                                        <th scope="col" class="text-uppercase text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                    <tr>
                                        <td>{{ $compra->id }}</td>
                                        <td>
                                        {{ $compra->proveedor->razon_social }}
                                        <br>
                                        <span class="badge badge-light">{{ $compra->proveedor->email }}</span>
                                        </td>
                                        <td>{{ $compra->updated_at }}</td>
                                        <td>
                                            @if ($compra->estado_pedido == 0)
                                                <span class="badge badge-warning">Pendiente</span>
                                            @elseif($compra->estado_pedido == 1)
                                                <span class="badge badge-primary">En espera</span>
                                            @elseif($compra->estado_pedido == 2)
                                                <span class="badge badge-success">Recibido</span>
                                            @elseif($compra->estado_pedido == 3)
                                                <span class="badge badge-danger">Cancelado</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                
            

                                                <a href="{{ route('detalle-orden-compra.index', $compra->id) }}" title="Cargar producto" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>

                                                </a>

                                                @if ($compra->estado_pedido == 1 || $compra->estado_pedido == 2)
                                                    {{-- <a href="{{ route('compras.pdf', $compra->id) }}" title="Generar Reporte" class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a> --}}
                                                    <a href="{{ asset($compra->url_factura_pedido) }}" target="_blank" rel="noopener noreferrer" title="Generar Reporte" class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @endif

                                                @if ($compra->estado_pedido == 0 || $compra->estado_pedido == 1)
                                                    <a href="{{ route('compras.edit', $compra) }}" title="Editar OC" class="btn btn-sm btn-secondary text-white text-uppercase me-1">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <!--    SUBIR PRESUPUESTO    -->
                                                @if ($compra->estado_pedido == 2) 
                                                    <a href="{{ route('compras.solicitarCotizacion',$compra) }}" title="Subir Presupuesto" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                                        <i class="bi bi-file-earmark-arrow-up-fill"></i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
                                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707z"/>
                                                        </svg>
                                                    </a>                                                   
                                                @endif
                                                
                                                <!--    DESCARGAR IMAGEN DE PRESUPUESTO    -->

                                                @if ($compra->estado_pedido == 2 && $compra->url_presupuesto)
                                                    {{-- <a href="{{ route('compras.descargarImagen', $compra->id) }}" title="Descargar Presupuesto" class="btn btn-sm btn-success text-white text-uppercase me-1 mr-2">
                                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                                                        </svg>
                                                    </a> --}}
                                                    <a href="{{ $compra->url_presupuesto }}" download target="_blank" title="Descargar Presupuesto" class="btn btn-sm btn-success text-white text-uppercase me-1 mr-2">
                                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                                                        </svg>
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
                                No hay solicitud de cotizacion disponibles
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