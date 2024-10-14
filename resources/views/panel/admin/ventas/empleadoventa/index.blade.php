@extends('adminlte::page')
@section('title', 'Ventas')
{{-- Titulo en el contenido de la Página --}}
@section('content_header')
    <h1>&nbsp;<strong>MIS VENTAS</strong></h1>
@stop

{{-- Contenido de la Página --}}
@section('content')
    <div class="container-fluid">
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
                    @if ($ventas->count() > 0)
                        <table id="datatable" class="table table-striped table-hover w-100 text-center">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-uppercase">CÓDIGO</th>
                                    <th scope="col" class="text-uppercase">CLIENTE</th>
                                    <th scope="col" class="text-uppercase">FECHA VENTA</th>
                                    <th scope="col" class="text-uppercase">HORA VENTA</th>
                                    <th scope="col" class="text-uppercase">ESTADO</th>
                                    <th scope="col" class="text-uppercase">TOTAL</th>
                                    <th scope="col" class="text-uppercase">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>{{ $venta->id }}</td>
                                        <td>{{ $venta->cliente->name }}</td>
                                        <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $venta->created_at->format('H:i:s') }}</td>
                                        <td>
                                            @if ($venta->estado == 0)
                                                <span class="badge badge-warning">Pendiente</span>
                                            @elseif ($venta->estado == 1)
                                                <span class="badge badge-success">Pagado</span>
                                            @elseif ($venta->estado == 2)
                                                <span class="badge badge-info">En preparación</span>
                                            @elseif ($venta->estado == 3)
                                                <span class="badge badge-primary">Enviado</span>
                                            @elseif ($venta->estado == 4)
                                                <span class="badge badge-danger">Cancelado</span>
                                            @endif
                                        </td>
                                        <td>${{ number_format($venta->total, 2) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('detalle_ventaempleado.index', $venta->id) }}" title="Detalles venta" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                                    <i class="far fa-eye" aria-hidden="true"></i>
                                                </a>
                                                @if (in_array($venta->estado, [1, 2, 3])) 
                                                    <a href="{{ route('ventas.empleadoventa.pdf', $venta->id) }}" title="Factura" class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                @if (in_array($venta->estado, [1, 2]))
                                                <a href="{{ route('ventas.empleadoventa.edit', $venta) }}" title="Editar" class="btn btn-sm btn-secondary text-white text-uppercase me-1 mr-2">
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
                            No hay ventas disponibles
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Importación de Archivos CSS --}}
@section('css')
@stop

{{-- Importación de Archivos JS --}}
@section('js')
@stop