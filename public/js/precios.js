let configurationDataTable = {
    responsive: true,
	autoWidth: false,
	paging: true,
	destroy: true,
	deferRender: false,
	bLengthChange: true,
	select: false,
    searching: true,
	pageLength: 5,
	lengthMenu: [[5,10,20,-1],[5,10,20,'Todos']], 
	language: {
		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Productos del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "No se encontraron coincidencias",
		"sInfoFiltered": "",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"search": "_INPUT_",
		"searchPlaceholder": "Buscar...",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	},

  columnDefs: [
		{
			orderable: false,
			className: '', //Agregar clase
			targets: 7, // en la columna 8 
			sortable: false
		}
	],

	dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"B><"col-md-6"p>i>', 
	buttons:[ 
		{
			extend:    'excelHtml5',
			text:      'Excel <i class="fas fa-file-excel"></i> ',
			titleAttr: 'Exportar a Excel',
			className: 'btn btn-success',
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 6] // Índices de las columnas que quieres exportar (0-indexed)
			}
		},
		{
			extend:    'print',
			text:      'Imprimir <i class="fa fa-print"></i> ',
			titleAttr: 'Imprimir',
			className: 'btn btn-info',
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 6] // Índices de las columnas que quieres exportar (0-indexed)
			}
		},
	],
}

$(function() {
    table = $('#tabla-productos').DataTable(configurationDataTable);
/* 	table = $('#tabla-marcas').DataTable(configurationDataTable);
	table = $('#tabla-categorias').DataTable(configurationDataTable);
	table = $('#tabla-proveedores').DataTable(configurationDataTable); */
});



$(document).ready(function() {
    $('#filtroSelect').on('change', function() {
        var filtro = $(this).val();

        table.column(7).search(filtro).draw();
    });
});




/* Alert */
swalWithBootstrapButtons.fire({
    title: '¿Cambiar Estado?',
    /* text: "¿Seguro? ¡Esta accion no se puede revertir!", */
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Cambiar estado!',
    cancelButtonText: 'Cerrar',
    reverseButtons: false
  }).then((result) => {
    if (result.value) {

      $.ajax({
        url: cambiarEstadoUrl,
        type: 'POST',
        data: {
          _token: token,
          _id: changeId
        },
        success: function (response) {
          // Maneja la respuesta exitosa, actualiza la interfaz de usuario, si es necesario.
          // Alternar el estado del checkbox
          switchClickeado.prop('checked', !switchClickeado.prop('checked'));
          console.log(response.message);
        },
        error: function (xhr) {
          // Maneja errores, si es necesario.
          var errors = xhr.responseJSON;
          console.log(errors.error);
        }
      })

         /* .then(response => {
          swalWithBootstrapButtons.fire(
            'Actualizado',
            'El estado fue cambiado con exito! ',
            'success'
          )
          
        })  */


    } else (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    )

  });

