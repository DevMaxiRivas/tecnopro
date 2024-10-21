@extends('adminlte::page')

@section('title', 'Detalle de Venta')

@section('content_header')
    <h1>&nbsp;<strong>Detalles de la Venta N° {{ $venta->id }} del cliente {{ $venta->cliente->name }}</strong></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('ventas.empleadoventa.index') }}" class="btn btn-sm btn-secondary text-uppercase">
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

            
            <div class="d-flex justify-content-between col-12 m-0 p-0">
                <div class="col-md-6">
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Información del Cliente</h5>
                        </div>
                        <div class="card-body">
                            <p><i class="fas fa-user"></i> <strong>Nombre:</strong> {{ $venta->cliente->name }}</p>
                            <p><i class="fas fa-id-card"></i> <strong>DNI:</strong> {{ $venta->cliente->dni }}</p>
                            <p><i class="fas fa-home"></i> <strong>Domicilio:</strong> {{ $venta->cliente->domicilio }}</p>
                            <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $venta->cliente->email }}</p>
                            <!-- <p><i class="fas fa-phone"></i> <strong>Teléfono:</strong> {{ $venta->cliente->telefono }}</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Productos de la Venta</h5>
                    </div>
                    <div class="card-body">
                        @if (count($productos) > 0)
                            <table id="datatable" class="table table-striped table-hover w-100 text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase">#</th>
                                        <th scope="col" class="text-uppercase">Producto</th>
                                        <th scope="col" class="text-uppercase">Precio</th>
                                        <th scope="col" class="text-uppercase">Cantidad</th>
                                        <th scope="col" class="text-uppercase">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>{{ $producto->producto->nombre }}</td>
                                            <td>
                                                {{ $producto->precio > 0 ? $producto->precio : '-' }}
                                            </td>
                                            <td>{{ $producto->cantidad }}</td>
                                            <td>
                                                {{ $producto->subtotal > 0 ? $producto->subtotal : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger mb-0" role="alert">
                                Ningún dato disponible 
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
