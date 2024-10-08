<div class="modal fade" id="proveedorModal{{ $proveedor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="proveedorModalLabel{{ $proveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1B9FD5; color: white;">
                <h5 class="modal-title" id="proveedorModalLabel{{ $proveedor->id }}">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Datos del Proveedor: "{{ $proveedor->razon_social }}"</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <div class="row">
                        <div class="col-sm-6 text-muted">Código {{ $proveedor->id }}</div>
                    </div>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Razón social:</strong>
                        <p class="mb-0">{{ $proveedor->razon_social }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Cuit:</strong>
                        <p class="mb-0">{{ $proveedor->cuit }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Dirección:</strong>
                        <p class="mb-0">{{ $proveedor->direccion }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Telefono:</strong>
                        <p class="mb-0">{{ $proveedor->telefono }}</p>
                    </li>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Email:</strong>
                        <p class="mb-0">{{ $proveedor->email }}</p>
                    </li>

                    <li class="list-group-item pb-0">
                        <strong>Estado:</strong>
                        <p class="mb-0">
                            @if ($proveedor->activo)
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
