<div class="modal fade" id="productoModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel{{ $producto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productoModalLabel{{ $producto->id }}"> Detalles de Producto </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Contenido del modal --}}
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-muted">Código {{ $producto->codigo_producto }}</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="col-sm-12"><strong>Nombre Producto</strong></div>
                            <div class="col-sm-12"> {{ $producto->nombre }}</div>
                        </li>
                        <li class="list-group-item">
                            @foreach ($imagenes as $imagen)
                            <img src="{{ $imagen }}" alt="{{ $producto->nombre }}" id="image_preview" class="img-fluid" style="object-fit: contain; object-position: center; height: 130px; width: 130px;">    
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <div class="row row-cols-2">
                                <div class="col-sm-6"><strong>Proveedor</strong></div>
                                <div class="col-sm-6"><strong>Categoría</strong></div>
                                <div class="col-sm-6"> {{ $producto->proveedor->descripcion }}</div>
                                <div class="col-sm-6"> {{ $producto->categoria->descripcion }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-sm-12"><strong>Precio</strong></div>
                            <div class="col-sm-12"> $ {{ $producto->precio }}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-sm-12"><strong>Descripción del Producto</strong></div>
                            <div class="col-sm-12"> {{ $producto->descripcion }}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="row row-cols-3 bg-light text-center">
                                <div class="col-sm-4"><strong>Stock Deseado</strong></div>
                                <div class="col-sm-4"><strong>Stock Disponible</strong></div>
                                <div class="col-sm-4"><strong>Stock Mínimo</strong></div>
                                <div class="col-sm-4"> {{ $producto->stock_deseado }}</div>
                                <div class="col-sm-4"> {{ $producto->stock_disponible }}</div>
                                <div class="col-sm-4"> {{ $producto->stock_minimo }}</div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
