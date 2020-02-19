$(".comision").change(calculaComision);

function calculaComision(event){
	
	let porc_comision = $(".comision:checked").val();
	let subtotal = Number($("#subtotal").val());
	console.log("porc_comision",porc_comision)
	
	let comision = subtotal * porc_comision;
	
	let tarjeta = subtotal + comision;
	
	$("#comision").val(Math.round(comision * 100) / 100);
	$("#tarjeta").val(Math.round(tarjeta * 100) / 100);
	// $("#comision").val(comision.toFixed(2));
	// $("#tarjeta").val(tarjeta.toFixed(2));
	// $("#tarjeta").val(tarjeta.toFixed(2));
}

$('.nav-tabs a[href=#ventana_efectivo]').on('shown.bs.tab', function(){
	console.log("pago en efectivo");
	$("#forma_pago").val("efectivo")
	$("#efectivo").val($(".total:visible").val());
	$("#subtotal").val(0);
	$("#pago").val($("#efectivo").val());
});

$('.nav-tabs a[href=#ventana_tarjeta]').on('shown.bs.tab', function(){
	console.log("pago con tarjeta");
	$("#efectivo").val(0);
	$("#subtotal").val($(".total:visible").val());
	$("#forma_pago").val("tarjeta");
	calculaComision();
});