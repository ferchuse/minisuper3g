


$(document).ready( onLoad);

function onLoad(event){
	
	
	
	$('#btn_ingreso').click(nuevoIngreso);
	$('#btn_egreso').click(nuevoEgreso);
	$('#fecha_ventas').change(cambiarFecha);
	$('#btn_cerrar_turno').click(confirmaCerrarTurno );
	$('#btn_resumen').click( imprimirCorte);
	
	$('.btn_ticketPago').click(imprimirTicket );
	$('.btn_ver').click(verTicket);
	$('.btn_cancelar').click( confirmaCancelarVenta);
	
	
}

function imprimirCorte(event){
	$("#ticket").hide();
	$("#resumen").removeClass("hidden-print");
	window.print();
}
function nuevoIngreso(){
	alertify.prompt("Nuevo Ingreso", "Cantidad" , 0, guardarIngreso, function(){});

}

function guardarIngreso(event, value){
	var fecha_ingresos = new Date().toString('yyyy-MM-dd');
	var fecha_ingresos = new Date().toString('HH:mm:ss');

	$.ajax({
		url: 'funciones/fila_insert.php',
		method: 'POST',
		dataType: 'JSON',
		data:  {
			"tabla": "ingresos",
			"valores": [
					{"name": "cantidad_ingresos", "value": value },
					{"name": "fecha_ingresos", "value":  fecha_ingresos},
					{"name": "id_turnos", "value":  $("#id_turnos").val()}
			]
		}
		}).done( function(respuesta){
		if(respuesta.estatus == 'success'){
			alertify.success('Guardado correctamente');
			location.reload();
		}
		else{
			alertify.error('Ha ocuurido un error');
			console.log(respuesta.mensaje);
		}
		}).always(function(){
		
	});
}
function nuevoEgreso(){
	$("#form_nuevo_egreso")[0].reset();
	$("#modal_nuevo_egreso").modal("show");
	
}
function cambiarFecha(){
	$("#form_resumen").submit();
	
}
function imprimirTicket(){
	$("#resumen").hide();
	$("#resumen").addClass("hidden-print");
	
	console.log("btn_ticketPago");
	var id_ventas = $(this).data("id_ventas");
	var boton = $(this).prop("disabled",true);
	var icono = boton.find(".fa");
	icono.toggleClass("fa-print fa-spinner fa-spin");
	$.ajax({
		url: "impresion/imprimir_venta.php",
		dataType: "HTML",
		data:{ id_ventas:id_ventas}
		}).done(function(respuesta){
		$('#Pago').html(respuesta);
		var total_f = $('#total_venta').val();
		console.log("imprimir pago termina");
		boton.prop("disabled",false);
		icono.toggleClass("fa-print fa-spinner fa-spin");
		$('#total_text').text(NumeroALetras(total_f));
		window.print();
	});
	// console.log("pago");
}
function confirmaCancelarVenta(event) {
	event.preventDefault();
	var boton = $(this);
	boton.prop('disabled', true);
	icono = boton.find(".fa");
	
	var id_registro = boton.data('id_ventas');
	var fila = boton.closest('tr');
	function cancelar(evet,value) {
		$.ajax({
			url: 'control/cancelar_ventas.php',
			method: 'POST',
			data:{ 
				"estatus_ventas": 'CANCELADO',
				"id_ventas": id_registro
				
			}
			}).done(function(respuesta){
			alertify.success("Se ha cancelado el pago"); 
			window.location.reload();
			icono.toggleClass("fa-times fa-spinner fa-spin");
			boton.prop('disabled', false);
		});
	}
	alertify.prompt('Confirmacion', '¿Deseas cancelarlo?','Escribe el motivo', cancelar, function () {
		
		boton.prop('disabled', false);
	});
	
}
function verTicket(){
	
	console.log("verTicket");
	var id_ventas = $(this).data("id_ventas");
	var boton = $(this).prop("disabled",true);
	var icono = boton.find(".fa");
	icono.toggleClass("fa-eye fa-spinner fa-spin");
	
	$.ajax({
		url: "forms/modal_imprimir_venta.php",
		dataType: "HTML",
		data:{ id_ventas:id_ventas}
		}).done(function(respuesta){
		$('#ver_venta').html(respuesta);
		$('#modal_ticket').modal("show");
		
		
		
		boton.prop("disabled",false);
		icono.toggleClass("fa-print fa-spinner fa-spin");
		
	});
	// console.log("pago");
}

function confirmaCerrarTurno(){
	
	
	//(Titulo, Mensaje, func_ok, Func_cancelar)
	alertify.confirm('Confirmacion', 'Esta seguro de cerrar su turno?', cerrarTurno , function(){
		
	});
	
}


function cerrarTurno(){
	
	$.ajax({
		'method': 'POST',
		'dataType': 'JSON',
		'url': 'corte/cerrar_turno.php',
		'data': {
			id_turnos:$("#id_turnos").val(),
			saldo_final:$("#saldo_final").val(),
			id_usuarios:$("#id_usuarios").val()
		}
		}).done(function(respuesta){
		if(respuesta.cierra_turno.estatus == "success"){
			
			location.href = 'login/logout.php';
		}
		else{
			
		}
		
	}).always();
	
	
}	