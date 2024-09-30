function cargarTabla() {
	return new Promise((resolve, reject) => {

		fetch(base_url)
			.then(response => response.json())
			.then(data => {
				// Llenar la tabla DataTable con los datos
				$('#tabla_carrito').DataTable({
					data: data,
					columns: [
						{
							data: 'productos.url_imagen',
							render: function (data, type, row) {
								var imagen = data.split('|');
								return `<div class="container bg-white rounded-4 d-flex justify-content-center align-items-center" style="width: auto; height: 100px;">
											<img src="${imagen[0]}" class="image" height=70px>
										</div>`
							}
						},
						{
							data: 'productos.nombre',
							render: function(data, type, row){
								return `<div class="container d-flex align-items-center justify-content-start" style="height: 100px; width: 33rem; overflow: hidden;">
											<p class="text-truncate d-inline-block" style="max-width: 98%;" title="${data}">${data}</p>
										</div>`
							}
						},
						{
							data: 'subtotal',
							render: function(data, type, row){
								return `<div class="container border-start border-end border-2 d-flex align-items-center" style="width: 100px; height: 100px;">
											<p class="p-small"  style="white-space: nowrap;">$ ${data}</p>
										</div>`
							}
						},
						{
							data: 'cant_producto', // No necesitas datos para esta columna, ya que se calculará usando render
							render: function (data, type, row) {
								// Calcula la multiplicación de subtotal y cant_producto para cada fila
								return `<div class="columnaCantidad container d-flex align-items-center" style="width: auto; height: 100px;">
											<button class="btn btn-sm btn-disminuir text-center border border-2 disminuir-cantidad btn-disminuir" id="disminuir-cantidad"><i class='bx bx-minus'></i></button>
											<span id='cantidad' class='cantidades'>${data}</span>
											<button class="btn btn-sm btn-aumentar text-center border border-2 aumentar-cantidad btn-aumentar" id="aumentar-cantidad"><i class='bx bx-plus'></i></button>
										<div>`;
							}
						},
						{
							data: null, // No necesitas datos para esta columna, ya que se calculará usando render
							render: function (data, type, row) {
								// Calcula la multiplicación de subtotal y cant_producto para cada fila
								return `<div class="container border-start border-end border-2 d-flex align-items-center" style="width: 100px; height: 100px;">
											<p class="p-small" id='totales' style="white-space: nowrap;">$ ${row.subtotal * row.cant_producto}</p>
										</div>`;
							}
						},
						{
							data: null,
							render: function (data, type, row) {
								return `<div class="container d-flex align-items-center" style="width: auto; height: 100px;">
											<button class="btn btn-danger eliminar-btn"><i class='bx bxs-x-circle'></i></button>
										</div>`;
							}
						},
						// Agrega más columnas según sea necesario
					],
					rowId: 'id',
					responsive: true, // Para hacer la tabla sensible (responsive)
					lengthChange: false, // Deshabilita el control para cambiar la cantidad de resultados mostrados por página
					searching: false, // Habilita la barra de búsqueda
					ordering: false, // Habilita la ordenación por columna
					paging: false, // Habilita la paginación
					info: false, // Muestra la información del estado de la tabla (por ejemplo, "Mostrando 1 a 10 de 20 entradas")
					language: {
						"sProcessing": "Procesando...",
						"sLengthMenu": "Mostrar _MENU_ registros",
						"sZeroRecords": "No se encontraron resultados",
						"sEmptyTable": "Ningún producto en el carrito",
					},
					initComplete: function () {
						// Resolve la promesa con los datos de la tabla
						resolve(data);
					}

				});

			})
			.catch(error => reject('Error:', error));
	});
}

var valorTotal = document.getElementById("valorTotal");
function sumarTotales(data) {
	var totalSuma = data.reduce((total, item) => total + item.subtotal * item.cant_producto, 0);
	console.log('Total de los totales:', totalSuma);
	valorTotal.textContent = totalSuma;

	const btnCheckout = document.getElementById('btn-checkout');
	if (totalSuma == 0) {
		btnCheckout.classList.add("disabled");
	} else {
		btnCheckout.classList.remove("disabled");
	}
}

async function mostrarTabla() {
	try {
		const data = await cargarTabla();
		sumarTotales(data);
	} catch (error) {
		console.error(error); // Se ejecutará si la promesa es rechazada
	}
}

//Muestro y cargo la tabla
mostrarTabla();

//EliminarItems del carrito

$('#tabla_carrito').on('click', '.eliminar-btn', function () {
	var table = $('#tabla_carrito').DataTable();
	var fila = table.row($(this).parents('tr')); // Obtener la fila
	var datosFila = fila.data(); // Obtener los datos de la fila
	var rowId = fila.id(); // Obtener el ID de la fila

	/* console.log("ID de la fila:", rowId);
	console.log("Datos de la fila:", datosFila); */

	//Recalcular el total del carrito
	var totalMenos = datosFila.subtotal * datosFila.cant_producto;
	valorTotal.textContent -= totalMenos;
	console.log('Total de los totales nuevo:', valorTotal.textContent);
	const btnCheckout = document.getElementById('btn-checkout');
	if (valorTotal.textContent == 0) {
		btnCheckout.classList.add("disabled");
	} else {
		btnCheckout.classList.remove("disabled");
	}
	table.row($(this).parents('tr')).remove().draw(); // Eliminar la fila



	// Solicitud AJAX para eliminar el producto del carrito en el backend:
	$.ajax({
		url: rutaParaEliminar,
		type: 'POST',
		data: {
			_token: token,
			_id: rowId
		},
		success: function (response) {
			// Maneja la respuesta exitosa, actualiza la interfaz de usuario, si es necesario.
			fetch(rutaContarItemsCarrito)
				.then(response => {
					// Verificar si la solicitud fue exitosa (código de respuesta 200)
					if (!response.ok) {
						throw new Error('Error al obtener los datos de la API');
					}
					// Parsear la respuesta JSON
					return response.json();
				})
				.then(data => {
					// Hacer algo con los datos obtenidos
					let cant_carrito = document.querySelector("#cant_carrito");
					cant_carrito.innerHTML = data;
					console.log('Items en carrito:', data);
				})
				.catch(error => {
					// Capturar errores durante el proceso
					console.error('Error:', error);
				});
				toastr.options = {
					"closeButton": true,
					"debug": true,
					"newestOnTop": false,
					"progressBar": true,
					"positionClass": "toast-bottom-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "2500",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				  }
		  
				  toastr["error"](response.message)
			console.log(response.message);

		},
		error: function (xhr) {
			// Maneja errores, si es necesario.
			var errors = xhr.responseJSON;
			console.log(errors.error);
		}

	});
});


// Maneja la disminución de cantidad
$('#tabla_carrito').on('click', '.disminuir-cantidad', function () {
	var row = $(this).closest('tr');
	var rowData = $('#tabla_carrito').DataTable().row(row).data();

	if (rowData.cant_producto > 1) {
		rowData.cant_producto--;
		/* console.log(rowData.productos) */
		// Actualiza la interfaz
		row.find('td:eq(4)').text(rowData.subtotal * rowData.cant_producto);
		row.find('.cantidades').text(rowData.cant_producto);

		// Crea un contenedor div
        var containerDiv = $('<div>', {
            class: 'container border-end border-2 d-flex align-items-center',
            style: 'width: 100px; height: 100px; white-space: nowrap;'
        });

        // Crea un párrafo p con el formato especificado
        var subtotalCell = $('<p>', {
            class: 'p-small',
            id: 'totales',
            text: '$ ' + (rowData.subtotal * rowData.cant_producto)
        });

		// Agrega el párrafo al contenedor
        containerDiv.append(subtotalCell);

		// Reemplaza el contenido de la celda por el nuevo contenedor
        row.find('td:eq(4)').html(containerDiv);
        row.find('.cantidades').text(rowData.cant_producto);

		// Actualiza el total
		var totalMenos = rowData.subtotal;
		valorTotal.textContent = parseFloat(valorTotal.textContent) - totalMenos;

		//Actualiza el valor en el header
		let cant_carrito = document.querySelector("#cant_carrito");
		cant_carrito.innerHTML--;
		console.log('Items en carrito:', cant_carrito.innerHTML);

		// Envía la actualización al servidor
		actualizarCantidadEnBackend(rowData.id, rowData.cant_producto);
	}


});

// Maneja el aumento de cantidad
$('#tabla_carrito').on('click', '.aumentar-cantidad', function () {
    var row = $(this).closest('tr');
    var rowData = $('#tabla_carrito').DataTable().row(row).data();

    if (rowData.cant_producto < rowData.productos.stock_disponible) {

        rowData.cant_producto++;
        /* console.log(rowData.productos) */
        // Actualiza la interfaz

        // Crea un contenedor div
        var containerDiv = $('<div>', {
            class: 'container border-end border-2 d-flex align-items-center',
            style: 'width: 100px; height: 100px; white-space: nowrap;'
        });

        // Crea un párrafo p con el formato especificado
        var subtotalCell = $('<p>', {
            class: 'p-small',
            id: 'totales',
            text: '$ ' + (rowData.subtotal * rowData.cant_producto)
        });

        // Agrega el párrafo al contenedor
        containerDiv.append(subtotalCell);

        // Reemplaza el contenido de la celda por el nuevo contenedor
        row.find('td:eq(4)').html(containerDiv);
        row.find('.cantidades').text(rowData.cant_producto);

		// Actualiza el total
		var totalMas = rowData.subtotal;
		valorTotal.textContent = parseFloat(valorTotal.textContent) + totalMas;

		//Actualiza el valor en el header
		let cant_carrito = document.querySelector("#cant_carrito");
		cant_carrito.innerHTML++;
		console.log('Items en carrito:', cant_carrito.innerHTML);

        // Envía la actualización al servidor
        actualizarCantidadEnBackend(rowData.id, rowData.cant_producto);
    }
});



function actualizarCantidadEnBackend(id, nuevaCantidad) {
	// Enviar la solicitud AJAX para actualizar la cantidad en el backend
	$.ajax({
		url: rutaParaActualizarCantidad,
		type: 'POST',
		data: {
			_token: token,
			_id: id,
			cantidad: nuevaCantidad
		},
		success: function (response) {
			// Maneja la respuesta exitosa, si es necesario.
			console.log(response.message);
		},
		error: function (xhr) {
			// Maneja errores, si es necesario.
			var errors = xhr.responseJSON;
			console.log(errors.error);
		}
	});
}


(function () {

})();