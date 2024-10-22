@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Detalle de Orden de Compra')

@section('content_header')
    <h1>&nbsp;<strong>Detalles de la orden de compra N° {{ $orden_compras->id }} para el proveedor
            {{ $orden_compras->proveedor->razon_social }}</strong></h1>
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
                        <h5 class="card-title">Información de la Orden de Compra N° {{ $orden_compras->id }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Número de Orden de Compra:</strong> {{ $orden_compras->id }}</p>
                       {{-- <p><strong>Número de Solicitud de Cotización:</strong> {{ $orden_compras-> }}</p>--}}
                        <p><strong>Proveedor:</strong> {{ $orden_compras->proveedor->razon_social }}</p>
                        <p><strong>Fecha de creación:</strong> {{ $orden_compras->created_at->format('d/m/Y') }}</p>
                        <p><strong>Hora de creación:</strong> {{ $orden_compras->created_at->format('H:i:s') }}</p>
                        <p><strong>Total:</strong> ${{ number_format($orden_compras->total, 2) }}</p>
                    </div>
                </div>
            </div>
            

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($productos) > 0)
                            <form action="{{ route('orden_compras.update_precio', $orden_compras->id) }}" method="POST">
                                @csrf

                                @method('PUT')
                                
                                @if ($orden_compras->estado_compra == 0)
                                    <button type="submit" class="btn btn-primary mb-3">Guardar Precios</button>
                                @endif
                                

                                <table id="no-datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase text-center">#</th>
                                            <th scope="col" class="text-uppercase text-center">Producto</th>
                                            <th scope="col" class="text-uppercase text-center">Precio</th>
                                            <th scope="col" class="text-uppercase text-center">Cantidad</th>
                                            <th scope="col" class="text-uppercase text-center">Subtotal</th>
                                            <th scope="col" class="text-uppercase text-center">Estado</th>
                                            @if ($orden_compras->estado_compra == 0)
                                                <th scope="col" class="text-uppercase text-center">Acciones</th>        
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td class="text-center">{{ $producto->id_producto }}</td>
                                                <td class="text-center">{{ $producto->producto->nombre }}</td>
                                                <td class="text-center">
                                                    <input 
                                                        type="number" 
                                                        step="1"
                                                        id="input-{{ $producto->id_producto }}"
                                                        name="precios[{{ $producto->id_producto }}]" 
                                                        value="{{ $producto->precio ?? '' }}"
                                                        class="form-control" {{ $producto->estado == '0' ? 'disabled' : '' }}
                                                    >
                                                </td>
                                                <td class="text-center">{{ $producto->cantidad }}</td>
                                                <td class="text-center">{{ $producto->subtotal ?? '-' }}</td>
                                                <td class="text-center">
                                                    @if($producto->estado == 1)
                                                        <span id="estado-{{ $producto->id_producto }}" class="badge badge-success">Agregado</span>
                                                    @else
                                                        <span id="estado-{{ $producto->id_producto }}" class="badge badge-danger">Eliminado</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($orden_compras->estado_compra == 0)
                                                        @if($producto->estado == 0)
                                                            <button data-id-compra="{{ $producto->id_compra }}" data-id-producto="{{ $producto->id_producto }}" data-estado="1" type="button" class="btn btn-success cambiar-estado" title="Agregar">
                                                                <i id="icon-button-{{ $producto->id_producto }}" class="fas fa-check"></i>
                                                            </button>
                                                        @else
                                                            <button data-id-compra="{{ $producto->id_compra }}" data-id-producto="{{ $producto->id_producto }}" data-estado="0" type="button" class="btn btn-danger cambiar-estado" title="Eliminar">
                                                                <i id="icon-button-{{ $producto->id_producto }}" class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@section('js')
    <script>

        $('.cambiar-estado').click(function() {
            
            // Referencia del Boton, icono
            var button = $(this);

            // Datos del boton
            var estadoNuevo = button.attr('data-estado');
            var id_compra = button.attr('data-id-compra');
            var id_producto = button.attr('data-id-producto');

            var icon = $('#icon-button-'+id_producto);
            var badge = $('#estado-'+id_producto);
            var input = $('#input-'+id_producto);

            // Ruta
            var routeUrl = `/panel/orden_compras/update_estado`;
            
            // Datos para la API
            var data = {
                'id_compra': id_compra,
                'id_producto': id_producto,
                'estado': estadoNuevo
            };

            // Peticion AJAX
            $.ajax({
                type: 'POST',
                url: routeUrl,
                data: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {

                        if(estadoNuevo == 0) {
                            // Remover clases
                            button.removeClass('btn-danger');
                            icon.removeClass('fa-times');

                            // Agregar clasess
                            button.addClass('btn-success');
                            icon.addClass('fa-check');

                            // Actualizar data del boton
                            button.attr('data-estado', '1');
                            button.attr('title', 'Agregar');

                            // Actualizar badge
                            badge.text('Eliminado');
                            badge.removeClass('badge-success');
                            badge.addClass('badge-danger');

                            // Actualizar input
                            input.addClass('disabled');
                            input.attr('disabled', true);
                            
                        } else {
                            // Remover clases
                            button.removeClass('btn-success');
                            icon.removeClass('fa-check');

                            // Agregar clasess
                            button.addClass('btn-danger');
                            icon.addClass('fa-times');

                            // Actualizar data del boton
                            button.attr('data-estado', '0');
                            button.attr('title', 'Eliminar');

                            // Actualizar badge
                            badge.text('Agregado');
                            badge.removeClass('badge-danger');
                            badge.addClass('badge-success');

                            // Actualizar input
                            input.removeClass('disabled');
                            input.attr('disabled', false);
                        }
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

    </script>
@stop
