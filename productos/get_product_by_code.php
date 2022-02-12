<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Content-Type: application/json");
	
	
	include ("../conexi.php");
	
	$link=Conectarse();
	
	$respuesta  =array() ;
	
	$consulta = "SELECT * FROM productos WHERE codigo_productos = '{$_GET["codigo_productos"]}' ";
	$result= mysqli_query($link,$consulta);
	if($result){
		while($fila=mysqli_fetch_assoc($result)){
			
			$precios = [];
			$consulta_precios  = "SELECT * FROM cat_precios LEFT JOIN precios_productos  USING(id_precio ) WHERE id_productos = {$fila[id_productos]} "; 
			
			$result_precios = mysqli_query($link,$consulta_precios);
			
			while($fila_precios =mysqli_fetch_assoc($result_precios)){
				$precios[] = $fila_precios;
				
				$fila["precios"] = $precios;
			}
			
			$respuesta ["data"]  = $fila ;
		}
	}
	else $respuesta["result"] = "Error". mysqli_error($link);
	
	$respuesta["consulta"] = $consulta;
	$respuesta["consulta_precios"] = $consulta_precios;
	echo json_encode($respuesta );
	
	
	
?>	