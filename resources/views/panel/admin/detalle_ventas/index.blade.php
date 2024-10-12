@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Detalle de mis compras')

@section('content_header')
    <h1>&nbsp;<strong>Detalles de la compra N° {{ $venta->id }} </strong></h1>
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

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($productos) > 0)
                            <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase text-center">#</th>
                                        <th scope="col" class="text-uppercase text-center">Producto</th>
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
