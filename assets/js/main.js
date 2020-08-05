$(document).ready(function () {
	$("#tabla").DataTable({
		//para cambiar el lenguaje a español
		language: {
			lengthMenu: "Mostrar _MENU_ registros",
			zeroRecords: "No se encontraron resultados",
			info:
				"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
			infoFiltered: "(filtrado de un total de _MAX_ registros)",
			sSearch: "Buscar:",
			oPaginate: {
				sFirst: "Primero",
				sLast: "Último",
				sNext: "Siguiente",
				sPrevious: "Anterior",
			},
			sProcessing: "Procesando...",
		},
		lengthMenu: [10, 20, 50, 100],
		scrollY: 400,
		scroller: true,
		dom: "<'row' <'col-sm-12 col-md-4'l> <'col-sm-12 col-md-4 excel'B> <'col-sm-12 col-md-4'f> >" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
			{
				extend: 'excelHtml5',
				text: '<i class="fas fa-file-excel"></i>',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
		]
	});
});



