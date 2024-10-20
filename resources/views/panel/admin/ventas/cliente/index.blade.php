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
                        @if (count($ventas) > 0)
                            <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase text-center">#</th>
                                        <th scope="col" class="text-uppercase text-center">Fecha</th>
                                        <th scope="col" class="text-uppercase text-center">Forma de pago</th>
                                        <th scope="col" class="text-uppercase text-center">Costo total</th>
                                        <th scope="col" class="text-uppercase text-center">Estado</th>
                                        <th scope="col" class="text-uppercase text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td class="text-center">{{ $venta->id }}</td>
                                            <td> {{ $venta->created_at }} </td>
                                            <td class="text-center">{{ $venta->forma_pago->nombre }}</td>
                                            <td class="text-center">{{ $venta->total }}</td>

                                            <td>
                                                @if ($venta->estado == 0)
                                                    <span class="badge badge-warning">Pendiente</span>
                                                @elseif($venta->estado == 1)
                                                    <span class="badge badge-primary">Pagado</span>
                                                @elseif($venta->estado == 2)
                                                    <span class="badge badge-success">En preparacion</span>
                                                @elseif($venta->estado == 3)
                                                    <span class="badge badge-primary">Enviado</span>
                                                @elseif($venta->estado == 4)
                                                    <span class="badge badge-danger">Cancelado</span>
                                                @elseif($venta->estado == 5)
                                                    <span class="badge badge-success">Entregado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('detalle_ventas.index', $venta->id) }}"
                                                        title="Ver productos"
                                                        class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>

                                                    @if ($venta->estado == 0)
                                                        <a href="{{ $venta->link_pago }}" title="Pagar"
                                                            class="btn btn-sm btn-success text-white text-uppercase me-1 mr-2">
                                                            <i class="fa fa-money-bill-alt" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- <form id="cancel-form-{{ $venta->id }}"
                                                                action="{{ route('ventas.cliente.cancelar', $venta->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH') -->
                                                        <button id="cancel-button-{{ $venta->id }}" type="button"
                                                            class="btn btn-sm btn-secondary text-white text-uppercase me-1"
                                                            title="Cancelar pedido">
                                                            <i class="fas fa-times" aria-hidden="true"></i>
                                                        </button>
                                                        <!-- </form> -->
                                                    @endif
                                                    @if (in_array($venta->estado, [1, 2, 3, 5]))
                                                        <a href="{{ asset($venta->url_factura) }}" target="_blank"
                                                            title="Factura"
                                                            class="btn btn-sm btn-danger text-white text-uppercase me-1 mr-2">
                                                            <i class="fas fa-file-pdf" aria-hidden="true"></i>
                                                        </a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
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

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelButton = document.getElementById('cancel-button-{{-- $ventas->id --}}');
            const cancelForm = document.getElementById('cancel-form-{{-- $ventas->id --}}');

            if (cancelButton && cancelForm) {
                cancelButton.addEventListener('click', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: '¡Atención!',
                        html: `
                        <div style="text-align: center;">
                            <i class="fas fa-exclamation-triangle" style="color: #D91C35; font-size: 50px;"></i>
                            <h4 style="margin-top: 10px;">Confirmación de Cancelación</h4>
                            <p style="color: #343a40;">¿Estás seguro de que deseas cancelar la venta?</p>
                        </div> 
                    `,
                        showCancelButton: true,
                        confirmButtonColor: '#1AD992',
                        cancelButtonColor: '#D91C35',
                        confirmButtonText: 'Sí, cancelar!',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        console.log(result);

                        if (result.value) {
                            console.log('confirmado');
                            // Si el usuario confirma, enviamos el formulario
                            cancelForm.submit();
                        }
                    });
                });
            }
        });
    </script>
@stop
