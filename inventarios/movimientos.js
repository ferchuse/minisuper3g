$(document).ready(function(){
	$('#form_reportes').submit(listarRegistros );
	
	$('#contenedor_tabla').on("click", ".salidas", detalleSalidas);
	
	
	$("#descripcion_productos").autocomplete({
		serviceUrl: "../control/productos_autocomplete.php",   
		onSelect: function(eleccion){
			$("#id_productos").val(eleccion.data.id_productos);
			
		},
		autoSelectFirst	:true , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
});


function detalleSalidas(event){
	console.log("detalleSalidas()");
	
	event.preventDefault();
	
	var id_productos = $(this).data('id_productos');
	
	$.ajax({
		url: 'detalle_salidas.php',
		method: 'GET',
		data: {
			"fecha_inicio": $("#fecha_inicio").val(),
			"fecha_fin": $("#fecha_fin").val(),
			"id_productos": id_productos
		}
		}).done(function(respuesta){
		$('#modal_salidas .modal-body').html(respuesta);
		$('#modal_salidas').modal("show");
		
	});
}


function listarRegistros(event){
	event.preventDefault();
	$('#contenedor_tabla').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	var formulario = $(this).serialize();
	$.ajax({
		url: 'tabla_movimientos.php',
		method: 'POST',
		dataType: 'HTML',
		data: formulario
		}).done(function(respuesta){
		$('#contenedor_tabla').html(respuesta);
		
		$(".sort").click(ordenar)
	});
}

function ordenar(){
	$("#sort").val($(this).data("campo"));
	
	$('#form_reportes').submit();
	
}