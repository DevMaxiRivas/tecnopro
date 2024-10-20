@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Detalle de Orden de Compra')

@section('content_header')
    <h1>&nbsp;<strong>Detalles de la orden de compra N° {{ $orden_compra->id }} para el proveedor
            {{ $orden_compra->proveedor->razon_social }}</strong></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('orden_compras.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                    Volver Atrás
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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Información de la Orden de Compra N° {{ $orden_compra->id }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Número de Orden de Compra:</strong> {{ $orden_compra->id }}</p>
                       {{-- <p><strong>Número de Solicitud de Cotización:</strong> {{ $orden_compra-> }}</p>--}}
                        <p><strong>Proveedor:</strong> {{ $orden_compra->proveedor->razon_social }}</p>
                        <p><strong>Fecha de creación:</strong> {{ $orden_compra->created_at->format('d/m/Y') }}</p>
                        <p><strong>Hora de creación:</strong> {{ $orden_compra->created_at->format('H:i:s') }}</p>
                        <p><strong>Total:</strong> ${{ number_format($orden_compra->total, 2) }}</p>
                    </div>
                </div>
            </div>
            

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($productos) > 0)
                            <form action="{{ route('orden_compras.update_precio', $orden_compra->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase text-center">#</th>
                                            <th scope="col" class="text-uppercase text-center">Producto</th>
                                            <th scope="col" class="text-uppercase text-center">Precio</th>
                                            <th scope="col" class="text-uppercase text-center">Cantidad</th>
                                            <th scope="col" class="text-uppercase text-center">Subtotal</th>
                                            <th scope="col" class="text-uppercase text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td class="text-center">{{ $producto->id }}</td>
                                                <td class="text-center">{{ $producto->producto->nombre }}</td>
                                                <td class="text-center">
                                                    <input type="number" step="1" name="precios[{{ $producto->id }}]" value="{{ $producto->precio ?? '' }}" 
                                                    class="form-control" {{ $orden_compra->estado == 'enviada' ? 'disabled' : '' }}>
                                                </td>
                                                <td class="text-center">{{ $producto->cantidad }}</td>
                                                <td class="text-center">{{ $producto->subtotal ?? '-' }}</td>
                                                <td class="text-center">
                                                    <!-- Botón verde -->
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                                    <!-- Botón rojo -->
                                                    <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Guardar Precios</button>
                            </form>
                        @else
                            <div class="alert alert-danger mb-0" role="alert">
                                Ningún dato disponible en esta tabla
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
