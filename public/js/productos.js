let configurationDataTable = {
    responsive: true,
	autoWidth: false,
	paging: true,
	destroy: true,
	deferRender: false,
	bLengthChange: true,
	select: false,
    searching: true,
	pageLength: 10,
	lengthMenu: [[5,10,20,-1],[5,10,20,'Todos']], 
	order: [[0, 'desc']],
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
			targets: 8, // en la columna 8 
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
				columns: [0, 1, 2, 3, 4, 5] // Índices de las columnas que quieres exportar (0-indexed)
			}
		},
		{
			extend:    'print',
			text:      'Imprimir <i class="fa fa-print"></i> ',
			titleAttr: 'Imprimir',
			className: 'btn btn-info',
			exportOptions: {
				columns: [0, 1, 2, 3, 4, 5] // Índices de las columnas que quieres exportar (0-indexed)
			}
		},
	],
}

$(function() {
    table = $('#tabla-productos').DataTable(configurationDataTable);
});



$(document).ready(function() {
    $('#filtroSelect').on('change', function() {
        var filtro = $(this).val();

        table.column(7).search(filtro).draw();
    });
});

