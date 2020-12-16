$(document).ready(function(){
	$('#form_reportes').submit(listarRegistros );
	
	$('#contenedor_tabla').on("click", ".btn_detalle", verPedido);

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



function listarRegistros(event){
	event.preventDefault();
	$('#contenedor_tabla').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	var formulario = $(this).serialize();
	$.ajax({
		url: 'lista_pedidos.php',
		method: 'GET',
		dataType: 'HTML',
		data: formulario
		}).done(function(respuesta){
		$('#contenedor_tabla').html(respuesta);
		
		$(".sort").click(ordenar)
	});
}




function verPedido(){
	
	console.log("verTicket");
	var id_pedidos = $(this).data("id_pedidos");
	// var boton = $(this).prop("disabled",true);
	// var icono = boton.find(".fa");
	// icono.toggleClass("fa-eye fa-spinner fa-spin");
	
	$.ajax({
		url: "./modal_detalle_pedido.php",
		dataType: "HTML",
		data:{ "id_pedidos":id_pedidos}
		}).done(function(respuesta){
		$('#ver_venta').html(respuesta);
		$('#modal_ticket').modal("show");
		
		
		
		// boton.prop("disabled",false);
		// icono.toggleClass("fa-print fa-spinner fa-spin");
		
	});
	// console.log("pago");
}

function ordenar(){
	$("#sort").val($(this).data("campo"));
	
	$('#form_reportes').submit();
	
}