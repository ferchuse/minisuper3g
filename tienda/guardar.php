<?php 
	include("../conexi.php");
	$link = Conectarse();
	
	$id_usuarios = $_POST['id_usuarios'];
	$id_turnos = $_COOKIE['id_turnos'];
	$listaProductos = $_POST['productos'];
	$articulos_ventas = $_POST['articulos_ventas'];
	$ganancia_venta = 0;
	
	$insertarVentas = "INSERT INTO pedidos SET
	

	
	fecha = NOW(),
	
	nombre = '{$_POST["nombre"]}',
	telefono = '{$_POST["telefono"]}',
	direccion = '{$_POST["direccion"]}',
	total = '{$_POST["total_ventas"]}',
	articulos = '{$_POST["articulos"]}',
	estatus = 'PENDIENTE'
	
	
	";
	
	$respuesta["insertarVentas"] = $insertarVentas;
	$exec_query = mysqli_query($link,$insertarVentas);
	
	if($exec_query){
		$respuesta["estatus_venta"] = "success";
		$respuesta["mensaje_venta"] = "Venta Guardada";
		$respuesta["folio_venta"] = mysqli_insert_id($link);
		
		$id_pedidos = mysqli_insert_id($link);
		$respuesta["id_ventas"] = $id_pedidos;
	}
	else{
		$respuesta["estatus_venta"] = "error";
		$respuesta["mensaje_venta"] = "Error en Insertar: $insertarVentas  ".mysqli_error($link);	
		$respuesta["insertarVentas"] = $insertarVentas;
	}
	
	
	
	$exec_query = mysqli_query($link,$borra_productos);
	
	
	
	foreach($listaProductos as $indice => $producto){
		
		$ganancia_pesos = ($producto["precio"] - $producto["costo_proveedor"]) *  $producto["cantidad"];
		$ganancia_venta+= $ganancia_pesos;
		$respuesta["ganancia"][] = $ganancia_pesos;
		
		$insertarVentasDetalle = "INSERT INTO pedidos_detalle SET
		id_pedidos = '$id_pedidos',
		id_productos = '$producto[id_productos]',
		unidad_productos = '$producto[unidad_productos]',
		cantidad = '$producto[cantidad]',
		precio = '$producto[precio]',
		importe = '$producto[importe]',
		descripcion = '$producto[descripcion]',
		ganancia = '$ganancia_pesos'
		
		";
		
		$exec_query = mysqli_query($link, $insertarVentasDetalle);
		
		if($exec_query){
			$respuesta['estatus_detalle'] = 'success';
			$respuesta['mensaje_detalle'] = 'Ventas Detalles guardado';
			$id_ventasDetalle = mysqli_insert_id($link);
			}else{
			$respuesta['estatus_detalle'] = 'error';
			$respuesta['mensaje_detalle'] = "Error al guardar Ventas Detalle $insertarVentasDetalle ".mysqli_error($link);
		}
		
		
	}
	
	echo json_encode($respuesta);
?>	