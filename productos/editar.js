
var producto_elegido ;

$(document).ready( function onLoad(){
	
	$("input").focus( function selecciona_input(){
		$(this).select();
	});
	
	$('#form_agregar_producto').submit(function(event){
		event.preventDefault();
	});
	
	$(document).on('keydown', disableFunctionKeys);
	
	alertify.set('notifier','position', 'top-right');
	
	$('#buscar_codigo').keypress( buscarCodigo);
	$('#codigo_productos').keypress( buscarCodigo);
	
	if($("#id_productos").val() != ''){
		
		buscarProducto();
	}
	
	
	$("#descripcion_productos").autocomplete({
		serviceUrl: "productos_autocomplete.php",  
		noCache: true, 
		onSelect: function(eleccion){
			console.log("Elegiste: ",eleccion);
			cargarProducto(eleccion.data);
			// calculaPrecioVenta();
		},
		autoSelectFirst	:false , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
	
	
	
	
	$('#piezas').keyup(calculaExistencia );
	$('#piezas').keyup(modificarPrecio );
	$('#costo_mayoreo').keyup(modificarPrecio );
	$('.porc_ganancia').change(calculaPrecioVenta ).keyup(calculaPrecioVenta );
	$('.precio').change(calcularGanancia ).keyup(calcularGanancia);
	
	
	$('#precio_menudeo').keyup(calculaGanancia );
	
	$('#form_productos').submit( guardarProducto);
	
	$('#existencia_cajas').keyup(calculaExistencia );
	$('#existencia_productos').keyup(calculaExistencia );
	
	
	
}); 

function calculaExistencia(event) {
	console.log("calculaExistencia()")
	// console.log(event.target.id)
	
	
	var existencia_cajas = Number($("#existencia_cajas").val());
	var existencia_piezas = Number($("#existencia_productos").val());
	var piezas = Number($('#piezas').val());
	
	console.log(existencia_cajas)
	console.log(existencia_piezas)
	console.log(piezas)
	if(piezas > 0){
		if(event){
			if(event.target.id == "existencia_cajas"){
				existencia_piezas = existencia_cajas * piezas;
				$("#existencia_productos").val(existencia_piezas)
			}
			else{
				existencia_cajas = existencia_piezas / piezas
				$("#existencia_cajas").val(existencia_cajas.toFixed(1))
				
			}
		}
		else{
			existencia_cajas = existencia_piezas / piezas
			$("#existencia_cajas").val(existencia_cajas.toFixed(1))
			
		}
	}
	
}

function calculaPrecioVenta() {
	console.log("calculaPrecioVenta");
	
	$(".porc_ganancia").each(function(i, item){
		var costo = Number($("#costo_proveedor").val());
		
		//si es mayor a 0
		
		var porc_ganancia= Number($(this).val());
		// var costo_unitario = Number($('#costo_unitario').val());
		var costo = Number($('#costo_proveedor').val());
		
		
		
		// if (costo != '') {
		if (costo > 0) {
			var ganancia = (costo * porc_ganancia  ) / 100;
			// $('#ganancia_menudeo_pesos').val(ganancia.toFixed(2));
			var precio = costo + ganancia;
			$(this).closest(".row").find(".precio").val(precio.toFixed(2));
		}
		
		console.log("costo:", costo);
		console.log("ganancia:", ganancia);
		console.log("precio:", precio);
		
	})
}

function calcularGanancia() {
	console.log("calculaPrecioVenta");
	
	$(".precio").each(function(i, item){
		var costo = Number($("#costo_proveedor").val());
		
		
		var precio= Number($(this).val());
		
		var costo = Number($('#costo_proveedor').val());
		
		
		
		// if (costo != '') {
		if (costo > 0) {
			
			var ganancia = ((precio / costo)    - 1) * 100 ;
			
			$(this).closest(".row").find(".porc_ganancia").val(ganancia.toFixed(2));
		}
		
		console.log("costo:", costo);
		console.log("ganancia:", ganancia);
		console.log("precio:", precio);
		
	})
}

function buscarProducto(){
	
	console.log("buscarProducto()");
	var input = $("#codigo_productos");
	
	input.prop('disabled',true);
	input.toggleClass('ui-autocomplete-loading');
	
	$.ajax({
		url: "get_product_by_id.php",
		dataType: "JSON",
		method: 'GET',
		data: {
			"id_productos": $("#id_productos").val()
		}
		}).done(function (respuesta){
		cargarProducto(respuesta.data);
		
		
		}).always(function(){
		
		input.toggleClass('ui-autocomplete-loading');
		input.prop('disabled',false);
		input.focus();
	});
}

function buscarCodigo(event){
	if(event.which == 13){
		console.log("buscarCodigo()");
		var input = $(this);
		var codigo_productos = $(this).val();
		
		input.prop('disabled',true);
		// input.toggleClass('ui-autocomplete-loading');
		$.ajax({
			url: "get_product_by_code.php",
			dataType: "JSON",
			data: { codigo_productos: codigo_productos}
			}).done(function (respuesta){
			
			if(respuesta.data ){
				console.log("Producto Encontrado");
				cargarProducto(respuesta.data);
				
						
			}
			else{
				alertify.error('Código no Encontrado');
			}
			
			
			}).always(function(){
			
			// input.toggleClass('ui-autocomplete-loading');
			input.prop('disabled',false);
			input.focus();
		});
		return false;
	}
}

function cargarProducto(producto) {
	console.log("cargarProducto()")
	$("#form_productos")[0].reset();
	console.log("form_reset")
	
	$.each(producto, function(name, value){
		$("#" + name).val(value);
		if(name =="precios"){
			$.each(value , function(index, item){
				
				$(".id_precio").eq(index).val(item.id_precio);
				$(".porc_ganancia").eq(index).val(item.porc_ganancia);
				$(".precio").eq(index).val(item.precio);
				
			});
			
		}
		
		$("#form_productos").find("#ultimo_" + name).val(value);
	});
	
	calculaExistencia();
	$("#form").removeClass("hidden");
}

function modificarPrecio() {
	console.log("modificarPrecio()");
	var costo_mayoreo = Number($("#costo_mayoreo").val());
	var piezas = Number($('#piezas').val());
	
	
	if (piezas != '') {
		var costo_pz = costo_mayoreo / piezas;
		console.log("Costo Pieza: " , costo_pz);
		
		$('#costo_proveedor').val(costo_pz.toFixed(2));
		
		if (costo_pz != '') {
			
			//ganancia menudeo
			var ganancia_menudeo_porc = Number($('#ganancia_menudeo_porc').val());
			var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_pz) / 100;
			$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
			
			//precio mayoreo
			var precio_menudeo = costo_pz + ganancia_menudeo_pesos;
			$('#precio_menudeo').val(precio_menudeo.toFixed(2));
			
		}
	}
}
function calculaGanancia() {
	console.log("calculaGanancia()")
	var precio_menudeo = Number($(this).val());
	var costo_unitario = Number($('#costo_proveedor').val());
	
	if (costo_unitario != '') {
		var ganancia_menudeo_porc = ((precio_menudeo * 100) / costo_unitario) - 100;
		$('#ganancia_menudeo_porc').val(ganancia_menudeo_porc.toFixed(2));
		var ganancia_menudeo_pesos = precio_menudeo - costo_unitario;
		$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
		
	}
}

function guardarProducto(event) {
	event.preventDefault();
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	boton.prop('disabled', true);
	icono.toggleClass('fa-save fa-spinner fa-spin');
	
	var formulario = $(this).serializeArray();
	console.log("formulario: ", formulario)
	$.ajax({
		url: 'guardar.php',
		dataType: 'JSON',
		method: 'POST',
		data: formulario
		}).done(function (respuesta) {
		console.log(respuesta);
		if (respuesta.estatus == "success") {
			alertify.success('Se ha guardado correctamente');
			
			if($("#accion").val() == "editar"){
				// $("#form").addClass("hidden");
				$("#buscar_producto").focus();
			}
			else{
				$("#codigo_productos").focus();
			}
			$('#form_productos')[0].reset();
			$('#id_productos').val("");
			
		} 
		else {
			alertify.error('Error al guardar');
			
		}
		}).always(function () {
		boton.prop('disabled', false);
		icono.toggleClass('fa-save fa-spinner fa-spin');
	});
	
}




function disableFunctionKeys(e) {
	var functionKeys = new Array(112, 113, 114, 115, 117, 118, 119, 120, 121, 122);
	if (functionKeys.indexOf(e.keyCode) > -1 || functionKeys.indexOf(e.which) > -1) {
		e.preventDefault();
		
		console.log("key", e.which)
		
	}
	
	// if(e.key == 'F12'){
	
	// console.log("F12");
	
	// $("#cerrar_venta").click()
	// }
	
	if(e.key == 'F10'){
		console.log("F10");
		$("#buscar_producto").focus()
	}
	
	if(e.key == 'F11'){
		console.log("F11");
		aplicarMayoreo();
	}
	
	if(e.key == 'Escape'){
		
		console.log("ESC");
		
		$("#buscar_codigo").focus()
	}
	
};

function buscarRepetido() {
	$codigo = $("#codigo_productos").val();
	
	$.ajax({
		url:"..buscar_normal.php",
		data:"..buscar_normal.php",
		
		
	}).done();
}



