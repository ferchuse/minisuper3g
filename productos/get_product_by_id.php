<?php
	
	include ("../conexi.php");
	header("Content-Type: application/json");
	
	$link=Conectarse();
	
	$respuesta  =array() ;
	
	$consulta = "SELECT * FROM productos WHERE id_productos = '{$_GET["id_productos"]}' ";
	$result= mysqli_query($link,$consulta);
	if($result){
		while($fila=mysqli_fetch_assoc($result)){
			
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
	echo json_encode($respuesta );
	
	
	
?>	