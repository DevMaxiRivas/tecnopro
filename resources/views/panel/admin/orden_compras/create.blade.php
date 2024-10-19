@extends('adminlte::page')

@section('title', 'Crear OC')

@section('content_header')
    <h1>&nbsp;<strong> NUEVA ORDEN COMPRA</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('orden_compras.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atras
            </a>
        </div>

        <div class="col-12">
            @if (count($proveedores) > 0)
                @include('panel.admin.orden_compras.forms.form')
            @else
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="alert alert-danger mb-0" role="alert">
                            "No hay proveedores activos disponibles"
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
<script>
    function getSolicitudesPorProveedor(proveedorId) {
        // Hacer una petición al servidor para obtener las solicitudes de cotización por proveedor
        fetch(`/solicitudes-por-proveedor/${proveedorId}`)
            .then(response => response.json())
            .then(data => {
                // Limpiar el campo de selección de solicitudes
                const solicitudesSelect = document.getElementById('id_solicitud');
                solicitudesSelect.innerHTML = '<option disabled selected>Seleccione una Solicitud de Cotización</option>';
    
                // Añadir las nuevas opciones basadas en las solicitudes recibidas
                data.solicitudes.forEach(solicitud => {
                    const option = document.createElement('option');
                    option.value = solicitud.id;
                    option.textContent = solicitud.numero;
                    solicitudesSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
@stop