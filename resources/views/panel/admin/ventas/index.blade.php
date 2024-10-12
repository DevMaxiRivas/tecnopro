@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Venta')

@section('content_header')
    <h1>&nbsp;<strong>MIS COMPRAS</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        
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
                   {{-- <div class="float-right ml-5">
                        <label for="filtroSelect">Filtrar por estado:</label>
                        <select id="filtroSelect" class="form-select">
                            <option value="">Mostrar todos</option>
                            <option value="1">Activado</option>
                            <option value="0">Desactivado</option>
                        </select>
                    </div>--}}
                    @if (count($ventas) > 0)
                    <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col" class="text-uppercase text-center">#</th>
                                <th scope="col" class="text-uppercase text-center">Fecha</th>  
                                <th scope="col" class="text-uppercase text-center">Forma de pago</th>
                                <th scope="col" class="text-uppercase text-center">Costo total</th>                         
                                <th scope="col" class="text-uppercase text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $ventas)
                            <tr>
                                <td class="text-center">{{ $ventas->id }}</td>
                                <td> {{ $ventas->created_at}} </td>
                                <td class="text-center">{{ $ventas->forma_pago->nombre }}</td>
                                <td class="text-center">{{ $ventas->total }}</td>
                        
                                <td>
                                        @if ($ventas->estado == 0)
                                            <span class="badge badge-warning">Pendiente</span>
                                        @elseif($ventas->estado == 1)
                                            <span class="badge badge-primary">Pagado</span>
                                        @elseif($ventas->estado == 2)
                                            <span class="badge badge-success">En preparacion</span>
                                        @elseif($ventas->estado == 3)
                                            <span class="badge badge-danger">Enviado</span>
                                         @elseif($ventas->estado == 4)
                                            <span class="badge badge-danger">Cancelado</span>
                                        @endif
                                 </td>
     {{-- <form action="{{ route('ventas.destroy', $ventas) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" id="miInterruptor" data-change-id="{{ $ventas->id }}" class="miInterruptor" value="{{ $ventas->activo }}" {{ $ventas->activo ? 'checked' : '' }}>
                                                <span class="slider"><p class="estadop" style="visibility: hidden">{{ $ventas->activo }}</p></span>
                                            </label>
                                        </div>
                                    </form> --}}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="#{{-- route('ventas.show', $ventas) --}}" title="Ver" data-toggle="modal" data-target="#ventasModal{{ $ventas->id }}" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="#{{-- route('ventas.edit', $ventas) --}}" title="Editar" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            {{-- @include('panel.admin.ventas.show') --}}
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-danger mb-0" role="alert">
                            No hay Compras disponibles
                        </div>                          
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
