@extends('adminlte::page')

@section('title', 'Registrar productos en OC')

@section('content_header')
    <h1>&nbsp;<strong>Detalles de la Orden de Compra N° {{ $orden_compra->id }} para el proveedor
            {{ $orden_compra->proveedor->razon_social }}</strong></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
                <div class="col-8">
                    <button id="agregarFila" class="btn btn-primary">Agregar Producto</button>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <a href="{{ route('detalle-orden-compra.index', $orden_compra->id) }}"
                        class="btn btn-danger mr-1">Cancelar</a>
                    <button id="guardar" class="btn btn-success">Guardar</button>
                </div>
            </div>

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
                    <div class="table-responsive card-body">
                        <input type="hidden" name="orden_compra_id" id="orden_compra_id" value="{{ $orden_compra->id }}">
                        <table id="tabla-productos" class="table table-striped table-hover w-100"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-uppercase text-center">Categoria</th>
                                    <th scope="col" class="text-uppercase text-center">Producto</th>
                                    <th scope="col" class="text-uppercase text-center">Cantidad</th>
                                    <th scope="col" class="text-uppercase text-center">Acción</th>
                                </tr>
                            </thead>

                            <tbody id="tbody">
                                @if (count($detalles) > 0)
                                    @foreach ($detalles as $detalle)
                                        <tr id="{{ $detalle->id }}" producto='{{ $detalle->id_producto }}'
                                            class="productos_cargados">
                                            <td class="text-center">{{ $detalle->producto->categoria->nombre }}</td>
                                            <td class="text-center nombre">{{ $detalle->producto->nombre }}</td>
                                            <td><input type="number" class="form-control cantidad"
                                                    value="{{ $detalle->cantidad }}" min="1">
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-link btn-eliminar p-0" title="Eliminar fila"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                                        </path>
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                                        </path>
                                                    </svg></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="miModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="cuerpoModal"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                                            aria-label="Close">
                                            Aceptar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Eliminar fila -->
                        <div class="modal fade" id="ModalEliminar" tabindex="-1" role="dialog"
                            aria-labelledby="miModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="miModalLabel">Eliminar producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">¿Estas seguro de eliminar este producto?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Aceptar</button>
                                        <button type="button" class="btn btn-secondary">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            function desplegarModal(titulo, texto) {
                $('#miModalLabel').text(titulo);
                $('#cuerpoModal').html(texto);
                const miModal = new bootstrap.Modal(document.getElementById('miModal'));
                miModal.show();
                return;
            }

            // Eventos para cerrar el modal
            $('#miModal').find('.btn-primary').on('click', function() {
                $('#miModal').modal(
                    'hide'); // Cierra el modal después de la eliminación
                return;
            })


            // Función para obtener productos de una categoría específica
            function obtenerProductos(categoria) {
                let productos_cargados = [];
                $('.productos_cargados').each(function() {
                    let producto_id = $(this).attr('producto');
                    productos_cargados.push(producto_id);
                })

                $('.productos_por_agregar td .producto').each(function() {
                    let producto_id = $(this).val();
                    if (producto_id !== 'Seleccione un producto' && producto_id !==
                        'Seleccione primero una categoría')
                        productos_cargados.push(producto_id);
                })
                const data = {
                    'id': categoria,
                    'productos_ya_agregados': productos_cargados
                };

                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '{{ route('obtener-productos-por-categoria') }}',
                        type: 'GET',
                        data: data,
                        accepts: "application/json",
                        crossDomain: true,
                        success: function(result) {
                            resolve(result); // Resuelve la promesa con el resultado
                        },
                        error: function(e) {
                            console.log(e.message);
                            reject(e); // Rechaza la promesa en caso de error
                        }
                    });
                });
            }


            // Función para crear el menú desplegable de categorías
            function crearSelectCategoria() {
                const select = $('<select>').addClass('form-select form-control text-center categoria');
                select.html(
                    "<option value=''> Seleccione una categoría </option> @foreach ($categorias as $categoria) <option value = '{{ $categoria->id }}'> {{ $categoria->nombre }} </option> @endforeach"
                );
                return select;
            }

            // Función para crear el menú desplegable de productos
            function crearSelectProducto() {
                return $('<select>').addClass('form-select form-control text-center producto').prop('disabled',
                        true)
                    .append($('<option>').text('Seleccione primero una categoría'));
            }

            // Función para crear el input de cantidad
            function crearInputCantidad() {
                return $('<input>').attr({
                    type: 'number',
                    min: '1',
                    value: '1',
                    disabled: true
                }).addClass('form-control cantidad');
            }

            // Función para crear el botón de eliminar
            function crearBotonEliminar() {
                const btn = $('<button>').addClass('btn btn-link btn-eliminar p-0')
                    .html(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/></svg>'
                    )
                    .attr('title', 'Eliminar fila');

                btn.on('click', function() {
                    // Guardamos la referencia a la fila a eliminar en una variable global o en el propio modal
                    const filaAEliminar = $(this).closest('tr');

                    // Mostrar el modal de confirmación
                    $('#ModalEliminar').modal('show');

                    // Evento para confirmar eliminación cuando se presione el botón "Aceptar" del modal
                    $('#ModalEliminar').find('.btn-danger').off('click').on('click', function() {
                        filaAEliminar.remove(); // Elimina la fila
                        $('#ModalEliminar').modal(
                            'hide'); // Cierra el modal después de la eliminación
                    });
                    $('#ModalEliminar').find('.btn-secondary').off('click').on('click', function() {
                        $('#ModalEliminar').modal(
                            'hide'); // Cierra el modal después de la eliminación
                    });
                });


                return btn;
            }

            // Función para actualizar el menú de productos y el input de cantidad
            async function actualizarProductos(selectCategoria, selectProducto, inputCantidad) {
                const categoria = selectCategoria.val();
                if (categoria && categoria !== 'Seleccione una categoría') {
                    try {
                        const productos = await obtenerProductos(categoria); // Espera la respuesta

                        selectProducto.empty().prop('disabled', false)
                            .append($('<option>').text('Seleccione un producto'));

                        for (const producto of productos) {
                            selectProducto.append($('<option>')
                                .text(producto.nombre)
                                .attr('value', producto.id));
                        }
                        inputCantidad.val(1).prop('disabled', true).attr('min', '1');
                    } catch (error) {
                        console.error('Error al obtener productos:', error);
                        selectProducto.empty().prop('disabled', true)
                            .append($('<option>').text('Error al cargar productos'));
                    }
                } else {
                    selectProducto.empty().prop('disabled', true)
                        .append($('<option>').text('Seleccione primero una categoría'));
                    inputCantidad.val(0).prop('disabled', true);
                }
            }


            // Función para actualizar el input de cantidad
            function actualizarCantidad(selectProducto, inputCantidad) {
                const opcionSeleccionada = selectProducto.find(':selected');
                inputCantidad.val(1);
                inputCantidad.prop('disabled', false);
            }

            // Función para agregar una nueva fila
            function agregarFila() {
                const fila = $('<tr>');
                fila.addClass('productos_por_agregar');
                const selectCategoria = crearSelectCategoria();
                const selectProducto = crearSelectProducto();
                const inputCantidad = crearInputCantidad();
                const btnEliminar = crearBotonEliminar();

                selectCategoria.on('change', function() {
                    actualizarProductos(selectCategoria, selectProducto, inputCantidad);
                });

                selectProducto.on('change', function() {
                    actualizarCantidad(selectProducto, inputCantidad);
                });

                fila.append($('<td>').append(selectCategoria));
                fila.append($('<td>').append(selectProducto));
                fila.append($('<td>').append(inputCantidad));
                fila.append($('<td>').append(btnEliminar));

                $('#tabla-productos tbody').append(fila);
            }

            // Evento para agregar fila
            $('#agregarFila').click(agregarFila);

            // Agregar la primera fila al cargar la página
            @if ($detalles->count() == 0)
                {{ 'agregarFila();' }}
            @endif


            $('#guardar').click(function() {
                let productos_cargados = [];
                $('.productos_cargados').each(function() {
                    const id_detalle = $(this).attr('id');
                    const cantidad = $(this).find('.cantidad').val();

                    if (cantidad <= 0) {
                        desplegarModal('Atención', 'En el producto <b>' + $(this).find('.nombre')
                            .text() + "</b> la cantidad debe ser mayor a 0");
                    }
                    if (id_detalle && cantidad) {
                        productos_cargados.push({
                            'id_detalle': id_detalle,
                            'cantidad': cantidad,
                        });
                    }

                });

                let productos_por_agregar = [];

                $('.productos_por_agregar').each(function() {
                    const id_producto = $(this).find(".producto").val();
                    const cantidad = $(this).find('.cantidad').val();

                    let selector = '.producto option[value="' + id_producto + '"]';

                    if (cantidad <= 0) {
                        desplegarModal('Atención', 'En el producto <b>' + $(selector).text() +
                            "</b> la cantidad debe ser mayor a 0");
                    }

                    if (id_producto && id_producto !== 'Seleccione un producto' && id_producto !==
                        'Seleccione primero una categoría' && cantidad) {
                        productos_por_agregar.push({
                            'id_producto': id_producto,
                            'cantidad': cantidad,
                        });
                    }

                });

                if (productos_por_agregar.length == 0 && productos_cargados.length == 0) {
                    desplegarModal('Atención', 'Debe agregar al menos un producto');
                    return;
                }

                const data = {
                    'orden_compra_id': $('#orden_compra_id').val(),
                    'productos_cargados': productos_cargados,
                    'productos_por_agregar': productos_por_agregar,
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('detalle-orden-compra.guardar') }}',
                    data: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href =
                            '{{ route('detalle-orden-compra.index', $orden_compra->id) }}';
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            })
        });
    </script>
@stop
