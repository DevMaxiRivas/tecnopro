<div class="modal fade" id="categoriaModal{{ $categoria->id }}" tabindex="-1" role="dialog"
    aria-labelledby="categoriaModalLabel{{ $categoria->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriaModalLabel{{ $categoria->id }}"><strong>
                    Datos de la Categoria:
                        "{{ $categoria->nombre }}"
                </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Contenido del modal --}}
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-light pb-0">
                        <strong>Nombre:</strong> <p>{{ $categoria->nombre }}</p>
                    </li>
                    <li class="list-group-item pb-0">
                        <strong>Estado:</strong>
                        <p>
                            @if ($categoria->activo)
                                {{ 'Activado' }}
                            @else
                                {{ 'Desactivado' }}
                            @endif
                        </p>
                    </li>
                    </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>