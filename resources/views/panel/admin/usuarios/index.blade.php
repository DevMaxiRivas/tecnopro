@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>&nbsp;<strong>MIS USUARIOS</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('usuarios.create') }}" class="btn btn-success text-uppercase">
                Nuevo Usuario 
            </a>
        </div>

        @if (session('alert'))
        <div class="col-12">
            {{ session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (count($usuarios) > 0)
                        <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                            <thead>
                                <th scope="col" class="text-uppercase text-center">#</th>
                                <th scope="col" class="text-uppercase text-center">Apellido y Nombre</th>
                                <th scope="col" class="text-uppercase text-center">DNI</th>
                                <th scope="col" class="text-uppercase text-center">Rol</th>
                                <th scope="col" class="text-uppercase text-center">Email</th>
                                <th scope="col" class="text-uppercase text-center">Fecha de creacion</th>
                                <th scope="col" class="text-uppercase text-center">Estado</th>
                                <th scope="col" class="text-uppercase text-center">Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="text-center">{{ $usuario->id }}</td>
                                    <td class="text-center">{{ $usuario->name }}</td>
                                    <td class="text-center">{{ $usuario->dni }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-secondary text-uppercase">
                                            {{ str_replace('_', ' ', $usuario->rol) }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $usuario->email }}</td>
                                    <td class="text-center">{{ $usuario->created_at}}</td>
                                    <td class="text-center">
                                        @if ($usuario->activo == 0)
                                            <span class="badge badge-danger">INACTIVO</span>
                                        @else
                                            <span class="badge badge-success">ACTIVO</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button title="Ver" data-toggle="modal" data-target="#usuarioModal{{ $usuario->id }}" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ route('usuarios.edit', $usuario) }}" title="Editar" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- @include('panel.admin.proveedor.show') --}}
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger mb-0" role="alert">
                            No hay usuarios disponibles
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    
@stop  