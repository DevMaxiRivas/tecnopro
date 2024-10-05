<div class="modal fade" id="regproveedorModal{{ $regproveedor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="regproveedorModalLabel{{ $regproveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1B9FD5; color: white;">
                <h5 class="modal-title" id="regproveedorModalLabel{{ $regproveedor->id }}">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Datos del Proveedor: "{{ $regproveedor->nombre }}"</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-light pb-0">
                        <strong>Nombre:</strong>
                        <p class="mb-0">{{ $regproveedor->nombre }}</p>
                    </li>
                    <li class="list-group-item pb-0">
                        <strong>Estado:</strong>
                        <p class="mb-0">
                            @if ($regproveedor->activo)
                                <span class="badge badge-success">Activado</span>
                            @else
                                <span class="badge badge-danger">Desactivado</span>
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
