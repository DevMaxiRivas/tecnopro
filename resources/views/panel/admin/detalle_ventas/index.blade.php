@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Detalle de mis compras')

@section('content_header')
<h1>&nbsp;<strong>Detalles de la compra N° {{ $venta->id }} del cliente {{ $venta->cliente->name }}</strong></h1>
@stop

@section('content')

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

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Información de la Venta</h5>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-file-invoice"></i> <strong>Código de Venta:</strong> {{ $venta->id }}</p>
                        <p><i class="fas fa-calendar-alt"></i> <strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
                        <p><i class="fas fa-clock"></i> <strong>Hora:</strong> {{ $venta->created_at->format('H:i') }}</p>
                        <p><i class="fas fa-dollar-sign"></i> <strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Información del Cliente</h5>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-user"></i> <strong>Nombre:</strong> {{ $venta->cliente->name }}</p>
                        <p><i class="fas fa-id-card"></i> <strong>DNI:</strong> {{ $venta->cliente->dni }}</p>
                        <p><i class="fas fa-home"></i> <strong>Domicilio:</strong> {{ $venta->cliente->domicilio }}</p>
                        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $venta->cliente->email }}</p>
                        <p><i class="fas fa-phone"></i> <strong>Teléfono:</strong> {{ $venta->cliente->telefono }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($productos) > 0)
                            
                            <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase text-center">#</th>
                                        <th scope="col" class="text-uppercase text-center">Producto</th>
                                        <th scope="col" class="text-uppercase">Imagen</th>
                                        <th scope="col" class="text-uppercase text-center">Precio</th>
                                        <th scope="col" class="text-uppercase text-center">Cantidad</th>
                                        <th scope="col" class="text-uppercase text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td class="text-center">{{ $producto->id }}</td>
                                            <td class="text-center">{{ $producto->producto->nombre }}</td>
                                            <td>
                                                <img src="{{ $producto->producto->url_imagen }}" alt="{{ $producto->producto->nombre }}"
                                                    class="img-fluid" style="width: 150px;">
                                            </td>
                                            <td class="text-center">
                                                @if ($producto->precio > 0)
                                                    {{ $producto->precio }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $producto->cantidad }}</td>
                                            <td class="text-center">
                                                @if ($producto->subtotal > 0)
                                                    {{ $producto->subtotal }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            {{-- @include('panel.admin.categorias.show') --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
