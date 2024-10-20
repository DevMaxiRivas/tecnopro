{{-- Extiende la misma plantilla --}}
@extends('adminlte::page')

{{-- Título --}}
@section('title', 'Órdenes de Compra Finalizadas')

{{-- Contenido --}}
@section('content')
    <h1>Órdenes de Compra Finalizadas</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (count($compras_finalizadas) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Proveedor</th>
                                        <th>Última modificación</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras_finalizadas as $compra)
                                        <tr>
                                            <td>{{ $compra->id }}</td>
                                            <td>{{ $compra->proveedor->razon_social }}</td>
                                            <td>{{ $compra->updated_at }}</td>
                                            <td>Finalizado</td>
                                            <td>
                                                {{-- Botón para agregar precios --}}
                                                <a href="{{ route('orden_compras.show', $compra) }}" class="btn btn-primary">Agregar Precio</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">No hay órdenes de compra finalizadas</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
