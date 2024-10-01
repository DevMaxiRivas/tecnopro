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
	lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
	language: {
		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ usuarios",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Usuarios _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "No se encontraron coincidencias",
		"sInfoFiltered": "", //(filtrado de un total de _MAX_ registros)
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
			targets: 5, // en la columna 5 
			sortable: false
		}
	],
}


$(function () {
	table = $('#tabla-usuarios').DataTable(configurationDataTable);
});