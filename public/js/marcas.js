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
		"sInfo": "Marcas de la _START_ a la _END_ de un total de _TOTAL_",
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
			targets: 2, // en la columna 8 
			sortable: false
		}
	]
}

$(function() {
    table= $('#tabla-marcas').DataTable(configurationDataTable);
});


$(document).ready(function() {
    $('#filtroSelect').on('change', function() {
        var filtro = $(this).val();

        table.column(1).search(filtro).draw();
    });
});

