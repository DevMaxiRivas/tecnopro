<div class="modal fade" id="ventasModal{{ $ventas->id }}" tabindex="-1" role="dialog"
    aria-labelledby="ventasModalLabel{{ $ventas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1B9FD5; color: white;">
                <h5 class="modal-title" id="ventasModalLabel{{ $ventas->id }}">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Datos de las compras: "{{ $ventas->id }}"</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <div class="row">
                        <div class="col-sm-6 text-muted">Código {{ $ventas->id }}</div>
                    </div>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Fecha:</strong>
                        <p class="mb-0">{{ $ventas->create_at }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Forma de pago:</strong>
                        <p class="mb-0">{{ $ventas->id_forma_pago }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Costo total:</strong>
                        <p class="mb-0">{{ $ventas->total }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Estado:</strong>
                        <p class="mb-0">
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
                        </p>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #022340; color: white;" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
