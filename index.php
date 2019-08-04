<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "principal";
	error_reporting(0);
	
	$consulta = "SELECT * FROM productos";
	$result = mysqli_query($link,$consulta);
	$num_rows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style>
			<style>
				.tabla_totales .row{
		  	margin-bottom: 10px;
				}
				
				.tab-pane .productos{
				display: block;
				overflow: auto;
				overflow-x: hidden;
				height: 310px;
				width: 100%;
				padding: 10px;				
				}			
				
				.sticky-footer{
				position: fixed;
				right: 0;
				bottom: 0;
				}
			</style>  
		</style>
		
    <title>Nueva Venta</title>
    <?php include("styles.php");?>
	</head>
  <body>
		
		<?php include("menu.php");?>
		
		<div class="container-fluid hidden-print">
			<form id="form_agregar_producto" class="form-inline" autocomplete="off">
				<div class="row">
					<div class="col-md-4">
						<label for="">Código del Producto:</label>
						<input id="codigo_producto" autofocus  type="text" class="form-control" placeholder="ESC" size="50">
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="">Producto:</label>
							<input id="buscar_producto" placeholder="F10"  type="text" class="form-control" size="50">
						</div>
					</div>
				</div>
			</form>
			<hr>
			<ul class="nav nav-tabs" style="margin: 10px 0 10px 0; font-color: black !important">
				<li class="active">
					<a data-toggle="tab" href="#tab1">
						<input class="cliente" value="Mostrador" >
					
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab2">
						<input class="cliente" value="Cliente 2">
					</a>
				</li>
				
			</ul>
			
			<div class="tab-content">
				<div id="tab1" class="tab-pane fade in active">
					<div class="productos">
						<table id="tabla_venta" class="tabla_venta table table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">Existencia</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody >
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 lead">
								<label>Articulos	</label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							<div class="col-sm-8 text-right">
							</div>
							<div class="col-sm-1 h2">
								<strong>TOTAL:</strong>
							</div>
							<div class="col-sm-2 h1">
								<input readonly type="text" class="form-control input-lg text-right total" value="0" name="total">
							</div>
						</div>
					</section>
				</div>
				<div id="tab2" class="tab-pane fade">
					<div class="productos">
						<table  class="tabla_venta table table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">Existencia</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody >
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 lead">
								<label>Articulos	</label>
								<input class="form-control articulos" type="number"  autocomplete="off" readonly>
							</div>
							<div class="col-sm-8 text-right">
								
							</div>
							<div class="col-sm-1 h2">
								<strong>TOTAL:</strong>
							</div>
							<div class="col-sm-2 h1">
								<input readonly  type="text" class="total form-control input-lg text-right " value="0" name="total">
							</div>
						</div>
					</section>
				</div>
			</div>
			<div class="sticky-footer">
				<button class="btn btn-info btn-lg"  id="nueva_venta" onclick="window.location.reload(true);">
					Nueva Venta
				</button>
				<button class="btn btn-success btn-lg" FORM="" id="cerrar_venta">
					F12 - Cobrar
				</button>
			</div>
		</div>
		
		<div id="ticket" class="visible-print">
			
		</div>
		
		
		<?php include('ventas/forma_pago.php'); ?>
		<?php include('forms/modal_granel.php'); ?>
		
		<?php  include('scripts.php'); ?>
		
		<script src="ventas/ventas.js"></script>
		
	</body>
</html>				