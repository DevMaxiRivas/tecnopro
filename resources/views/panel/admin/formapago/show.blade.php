<div class="modal fade" id="formapagoModal{{ $formapago->id }}" tabindex="-1" role="dialog"
    aria-labelledby="formapagoModalLabel{{ $formapago->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1B9FD5; color: white;">
                <h5 class="modal-title" id="formapagoModalLabel{{ $formapago->id }}">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Datos de la forma de pago: "{{ $formapago->nombre }}"</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <div class="row">
                        <div class="col-sm-6 text-muted"># {{ $formapago->id }}</div>
                    </div>
                    <li class="list-group-item bg-light pb-0">
                        <strong>Nombre:</strong>
                        <p class="mb-0">{{ $formapago->nombre }}</p>
                    </li>
              
                    <li class="list-group-item pb-0">
                        <strong>Estado:</strong>
                        <p class="mb-0">
                            @if ($formapago->activo)
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
