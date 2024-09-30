//Esto manda datos del boton al modal
$('#showDetallePedidoModal').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var numPedido = button.data('num-pedido');
	var email = button.data('email');
	var dni = button.data('dni');
	var telefono = button.data('telefono');
	var nombre = button.data('nombre');
	var apellido = button.data('apellido');
	var direccion = button.data('direccion');
	var codigopostal = button.data('codigopostal');
	var total = button.data('total');
	var cancelado = button.data('cancelado');
	var pagado = button.data('pagado');
	var enviado = button.data('enviado');
	var enpreparacion = button.data('enpreparacion');
	var urlfactura = button.data('urlfactura');

	$('#modal-nombre').text(nombre);
	$('#modal-apellido').text(apellido);
	$('#modal-num-pedido').text(numPedido);
	$('#modal-email').text(email);
	$('#modal-dni').text(dni);
	$('#modal-telefono').text(telefono);
	$('#modal-direccion').text(direccion);
	$('#modal-codigopostal').text(codigopostal);
	$('#modal-total').text(total);
	$('#modal-urlfactura').attr('href', urlfactura);

	var idPedido = button.data('idpedido');
	$('#modal-idPedido').text(idPedido);
	
	//Desactiva el boton de la factura, si no hay factura
	if (!urlfactura) {
		$('#modal-urlfactura').addClass('disabled');
	} else {
		$('#modal-urlfactura').removeClass('disabled');
	}

	//Muestra el estado del pedido en el modal
	var estado;
	if (cancelado) {
		estado = '<span class="badge badge-danger">Cancelado</span>';
	} else {
		if (pagado) {
			estado = '<span class="badge badge-success">Pagado</span>';
			
			if (enpreparacion) {
				estado = '<span class="badge badge-info">En preparacion</span>';
				if (enviado) {
					estado = '<span class="badge badge-primary">Enviado</span>';
				}
			}
		} else {
			estado = '<span class="badge badge-warning text-white">Esperando Pago</span>'
		}
	}

	$('#estadoPedido').html(estado);

});

//Esto trae los items del pedido desde la base de datos
$(document).on('click', '.cargarItems', function () {
	var pedidoId = $(this).data('idpedido');
	let urlDeConsulta = rutaParaConsulta + "/" + pedidoId;
	console.log(urlDeConsulta);
	console.log(pedidoId);
	fetch(urlDeConsulta, {
		method: 'GET',
		headers: {
			'X-CSRF-TOKEN': token
		},
		// Puedes agregar más opciones según tus necesidades
	})
		.then(response => {
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			return response.json();
		})
		.then(data => {
			console.log('Respuesta exitosa:');
			console.log(data);

			let tbody = document.getElementById('cart_item_list');

			// Vacía el tbody antes de agregar nuevos elementos
			tbody.innerHTML = '';
			data.forEach(item => {
				
				imagenes = item.productos.url_imagen.split('|');

				/* console.log(imagenes); */

				// Accede a las propiedades de cada objeto
				console.log('Imagen:', imagenes[0]);
				console.log('Producto:', item.productos.nombre);
				console.log('Precio:', item.productos.precio);
				console.log('Cantidad:', item.cant_producto);
				console.log('Total:', item.subtotal * item.cant_producto);
				// ... y así sucesivamente para otras propiedades

				let row = document.createElement('tr');

				// Crea las celdas y asigna los valores de las propiedades
				let imagenCell = document.createElement('td');
				let imagen = document.createElement('img');
				imagen.src = imagenes[0];
				imagen.width = '120';
				imagenCell.appendChild(imagen);
				row.appendChild(imagenCell); // Agrega la celda a la fila

				let productoCell = document.createElement('td');
				productoCell.textContent = item.productos.nombre; // Asigna el valor de la propiedad del producto
				row.appendChild(productoCell); // Agrega la celda a la fila

				let precioCell = document.createElement('td');
				precioCell.textContent = item.productos.precio; // Asigna el valor de la propiedad del precio
				row.appendChild(precioCell); // Agrega la celda a la fila

				let cantidadCell = document.createElement('td');
				cantidadCell.textContent = item.cant_producto; // Asigna el valor de la propiedad de la cantidad
				row.appendChild(cantidadCell); // Agrega la celda a la fila

				let totalCell = document.createElement('td');
				totalCell.textContent = item.subtotal * item.cant_producto; // Calcula el total y asigna el valor
				row.appendChild(totalCell); // Agrega la celda a la fila

				// Agrega la fila al tbody
				tbody.appendChild(row);
			});

		})
		.catch(error => {
			console.error('Error:', error);
		});
});
