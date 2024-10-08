@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Proveedor')

@section('content_header')
    <h1>&nbsp;<strong>MIS PROVEEDORES</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('proveedor.create') }}" class="btn btn-success text-uppercase">
                Nuevo Proveedor 
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
                    @if (count($proveedor) > 0)
                    <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col" class="text-uppercase text-center">#</th>
                                <th scope="col" class="text-uppercase text-center">Razón social</th>
                                <th scope="col" class="text-uppercase text-center">Cuit</th>
                                <th scope="col" class="text-uppercase text-center">Direccion</th>
                                <th scope="col" class="text-uppercase text-center">Telefono</th>
                                <th scope="col" class="text-uppercase text-center">Email</th>
                                <th scope="col" class="text-uppercase text-center">Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedor as $proveedor)
                            <tr>
                                <td class="text-center">{{ $proveedor->id }}</td>
                                <td class="text-center">{{ $proveedor->razon_social }}</td>
                                <td class="text-center">{{ $proveedor->cuit }}</td>
                                <td class="text-center">{{ $proveedor->direccion }}</td>
                                <td class="text-center">{{ $proveedor->telefono }}</td>
                                <td class="text-center">{{ $proveedor->email }}</td>
                                <td class="text-center">
                                    @if ($proveedor->activo == 0)
                                        <span class="badge badge-danger">INACTIVO</span>
                                    @else
                                        <span class="badge badge-success">ACTIVO</span>
                                    @endif
                                    {{-- <form action="{{ route('proveedor.destroy', $proveedor) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" id="miInterruptor" data-change-id="{{ $proveedor->id }}" class="miInterruptor" value="{{ $proveedor->activo }}" {{ $proveedor->activo ? 'checked' : '' }}>
                                                <span class="slider"><p class="estadop" style="visibility: hidden">{{ $proveedor->activo }}</p></span>
                                            </label>
                                        </div>
                                    </form> --}}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="#{{-- route('proveedor.show', $proveedor) --}}" title="Ver" data-toggle="modal" data-target="#proveedorModal{{ $proveedor->id }}" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="#{{-- route('proveedor.edit', $proveedor) --}}" title="Editar" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            {{-- @include('panel.admin.proveedor.show') --}}
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-danger mb-0" role="alert">
                            No hay Proveedores disponibles
                        </div>                          
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
