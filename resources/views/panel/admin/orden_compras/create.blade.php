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
                            No hay cotizaciones de proveedores disponibles
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
    $('#id_proveedor').change(function(){
        const select_provedor = $(this);
        console.log(select_provedor.val());
        getSolicitudesPorProveedor(select_provedor.val());
    })

    function getSolicitudesPorProveedor(proveedorId) {
        // Hacer una petición al servidor para obtener las solicitudes de cotización por proveedor
        fetch(`/panel/solicitudes-por-proveedor/${proveedorId}`)
            .then(response => response.json())
            .then(data => {
                // Limpiar el campo de selección de solicitudes
                const solicitudesSelect = document.getElementById('id_compra');
                //const solicitudesSelect = $('#id_proveedor');
                solicitudesSelect.innerHTML = '<option disabled selected>Seleccione una Solicitud de Cotización</option>';
                console.log(solicitudesSelect);
                // Añadir las nuevas opciones basadas en las solicitudes recibidas
                data.solicitudes.forEach(solicitud => {
                    //var option = $('<option>').text(solicitud.numero).attr('value', solicitud.id);
                    const option = document.createElement('option');
                    option.value = solicitud.id;
                    option.textContent = 'Nro de solicitud '+ solicitud.id;
                    solicitudesSelect.appendChild(option);
                    //solicitudesSelect.append(option);
                    //solicitudesSelect.append($('<option>', { value: solicitud.id, text: `Solicitud #${solicitud.id} - ${solicitud.descripcion}` }));
                    console.log(solicitud);
                    console.log(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
    </script>



@stop