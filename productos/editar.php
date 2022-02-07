<?php
	include("../login/login_success.php");
	include("../conexi.php");
	include("../funciones/generar_select.php");
	$link = Conectarse();
	$menu_activo = "productos";
	
	$consulta_cat_precios = "SELECT *  FROM cat_precios";
		
	$result_cat_precios = mysqli_query($link,$consulta_cat_precios) or  die("Error en $consulta_cat_precios" . mysqli_error($link));
	
	
	while($row = mysqli_fetch_assoc($result_cat_precios)){
		$cat_precios[] = $row;        
		
	}
	
	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			#respuesta_rep{
			color: red;
			}
		</style>
		<title>Productos</title>
		
		<?php include("../styles_carpetas.php");?>
		
	</head>
	<body>
		
		<?php include("../menu_carpetas.php");?>
		
		
		<div class="container-fluid">
		
			
			<div id="form" class="<?php echo $form;?>">
				<?php include('form_productos.php'); ?>
			</div>
			
			
		</div>
		
		
		<?php  include('../scripts_carpetas.php'); ?>
		<script src="editar.js?v=<?= date("d-m-Y-s")?>"></script>
		
	</body>
</html>