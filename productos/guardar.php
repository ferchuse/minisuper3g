<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = Array();
	
	
	$guardarProductos = "INSERT INTO productos SET 
	id_productos = '{$_POST["id_productos"]}',
	codigo_productos = '{$_POST["codigo_productos"]}',
	descripcion_productos = '{$_POST["descripcion_productos"]}',
	costo_proveedor = '{$_POST["costo_proveedor"]}',
	costo_mayoreo = '{$_POST["costo_mayoreo"]}',
	piezas = '{$_POST["piezas"]}',
	unidad_productos = '{$_POST["unidad_productos"]}',
	unidad_compra = '{$_POST["unidad_compra"]}',
	precio_mayoreo = '{$_POST["precio_mayoreo"]}',
	precio_menudeo = '{$_POST["precio_menudeo"]}',
	activo = '{$_POST["activo"]}',
	ganancia_menudeo_porc = '{$_POST["ganancia_menudeo_porc"]}',
	min_productos = '{$_POST["min_productos"]}',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '{$_POST["existencia_productos"]}'
	
	
	ON DUPLICATE KEY UPDATE 
	
	codigo_productos = '{$_POST["codigo_productos"]}',
	descripcion_productos = '{$_POST["descripcion_productos"]}',
	costo_proveedor = '{$_POST["costo_proveedor"]}',
	costo_mayoreo = '{$_POST["costo_mayoreo"]}',
	piezas = '{$_POST["piezas"]}',
	unidad_productos = '{$_POST["unidad_productos"]}',
	unidad_compra = '{$_POST["unidad_compra"]}',
	precio_mayoreo = '{$_POST["precio_mayoreo"]}',
	precio_menudeo = '{$_POST["precio_menudeo"]}',
	activo = '{$_POST["activo"]}',
	ganancia_menudeo_porc = '{$_POST["ganancia_menudeo_porc"]}',
	min_productos = '{$_POST["min_productos"]}',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '{$_POST["existencia_productos"]}'
	;
	";
	
	$respuesta['consulta']["guardarProductos"] = $guardarProductos;
	
	
	
	if(mysqli_query($link,$guardarProductos)){
		$respuesta['estatus'] = "success";
		
		
		if($_POST["id_productos"] != ''){
			$id_productos = $_POST["id_productos"];
		}
		else{
			$id_productos = mysqli_insert_id($link);
		}
	}
	else{
		$respuesta['estatus']= "error";
		$respuesta['mensaje'] = "Error en ".$guardarProductos.mysqli_error($link);
	}
	
	
	
	
	foreach($_POST["id_precio"] as $i => $id_precio){
		$guardar_precios = "INSERT INTO precios_productos SET 
		id_precio = '{$_POST["id_precio"][$i]}',
		id_productos = '{$id_productos}',
		porc_ganancia = '{$_POST["porc_ganancia"][$i]}',
		precio = '{$_POST["precio"][$i]}'
		
		
		
		ON DUPLICATE KEY UPDATE 
		
		id_precio = '{$_POST["id_precio"][$i]}',
		id_productos = '{$_POST["id_productos"]}',
		porc_ganancia = '{$_POST["porc_ganancia"][$i]}',
		precio = '{$_POST["precio"][$i]}'
		
		;
		
		";
		
		
		$respuesta['guardar_precios']["consulta"] = $guardar_precios;
		
		if(mysqli_query($link,$guardar_precios)){
			$respuesta['guardar_precios']["estatus"] = "success";
			
		}
		else{
			$respuesta['guardar_precios']["estatus"] = "error";
			$respuesta['guardar_precios']["mensaje"] = "Error en ".$guardar_precios.mysqli_error($link);
		}
		
	}
	
	
	
	
	
	echo json_encode($respuesta);
?>