<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicio = $_GET['fecha_inicio'];
	$fecha_fin = $_GET['fecha_fin'];
	
	$consultaVentas = "SELECT
	fecha_ventas, COALESCE ( SUM( total_ventas ), 0 ) AS ventas_dia
	FROM
	ventas 
	WHERE
	estatus_ventas <> 'CANCELADO' 
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}' 
	AND '{$_GET["fecha_fin"]}'
	GROUP BY
	fecha_ventas";
	
	$consultaVentas = "SELECT
	fecha_ventas,
	ganancia_dia,
	COALESCE(SUM(total_ventas), 0) AS ventas_dia
	FROM
	ventas
	right JOIN (
	SELECT
	fecha_ventas,
	SUM(ganancia) AS ganancia_dia
	FROM
	ventas_detalle
	RIGHT JOIN ventas USING (id_ventas)
	WHERE estatus_ventas <> 'CANCELADO'
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}' AND '{$_GET["fecha_fin"]}'
	GROUP BY
	fecha_ventas
	) AS t_ganancia USING (fecha_ventas)
	
	WHERE estatus_ventas <> 'CANCELADO'
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}' AND '{$_GET["fecha_fin"]}'
	GROUP BY
	fecha_ventas
	";
	
	//Ingresos
	$resultadoVentas = mysqli_query($link,$consultaVentas);
	$row_count = mysqli_num_rows($resultadoVentas);
	
	// Consulta Egresos
	$consultar = "SELECT * FROM egresos 
	
	WHERE fecha_egresos BETWEEN '$fecha_inicio' AND '$fecha_fin' 
	
	GROUP BY descripcion_egresos";
	$resultados = mysqli_query($link, $consultar);
	$totales = array();
	
?>
<pre hidden>
	<?php echo $consultaVentas?>
</pre>

<?php 
	if($row_count < 1){
	?>
	<br>
	<br>
	<div class="alert alert-warning text-center">
	  <strong>No hay pagos en estas fechas</strong> 
	</div>
	<?php		
		}else{
	?>
	
	<div class="col-sm-6">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center"> 
					Ingresos
				</h4>
			</div>
			<div class="panel-body" id="panel_ingresos">
				<div class="table-responsive">
					<h4>
						<table class="table table-hover">
							<tr>
								<th class="text-center"> Fecha</th>
								<th class="text-right"> Ingresos</th>
								<th class="text-right"></th>
								<th class="text-right"> Ganancia</th>
								<th class="text-center hidden"> Acciones</th>
							</tr>
							<?php
								while($row_ventas = mysqli_fetch_assoc($resultadoVentas)){
									extract($row_ventas);
									$total_ventas+= $ventas_dia;
									$total_ganancia+= $ganancia_dia;
								?>
								<tr>
									<td class="text-center">
										<a href="../resumen.php?fecha_ventas=<?php echo $fecha_ventas?>">
											<?php echo date("d/m/Y", strtotime($fecha_ventas));?>
										</a>
									</td>
									<td class="text-right">
										<?php echo "$".number_format($ventas_dia,2);?>
									</td>
									<td class="text-right"></td>
									<td  class="text-right">
										<?php echo "$".number_format($ganancia_dia, 2);?>
									</td>
								</tr>
								
								<?php
								}
							?>
							
							<tr class="bg-info">
								<td colspan="1" class="text-right text-danger">
									<big><b>TOTAL:</b></big>
								</td>
								<td class="text-right">
									<?php 
										echo "$". number_format($total_ventas,2);
									?>
								</td>
								<td class="text-right"></td>
								<td  class="text-right">
									<?php 
										echo "$". number_format($total_ganancia,2);
									?>
								</td>
							</tr>
						</table> 
					</h4>
				</div>
			</div>
		</div>
	</div>
	
	<!-- "Egresos" -->
	<div class="col-sm-6 hidden">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center">
					Egresos
				</h4>
			</div>
			<div class="panel-body" id="panel_egresos">
				<div class="table-responsive">
					<h4>
						<table class="table table-hover" id="egresos">
							<thead>
								<tr>
									<th  onclick="sortTable(0)" class="text-center">Descripción</th>
									<th onclick="sortTable(1)"  class="text-right">Cantidad</th>
									
								</tr>
							</thead>
							<tbody>
								<?php 
									while($row = mysqli_fetch_assoc($resultados)){
										extract($row);
										
									?>
									
									<tr class="text-center">
										
										<td class=""><?php echo ($descripcion_egresos);?></td>
										<td class=""><?php echo number_format($cantidad_egresos, 2);?></td>
										
									</tr>
									
									<?php
										
									}
								?>
							</tbody>
							<tfoot>
								<tr class="<?php echo $color;?>">
									<td colspan="1" class="text-right text-danger">
										<big><b>TOTAL:</b></big>
									</td>
									<td class="text-right">
										<?php 
											$forma2 = array_sum($totales);
											echo "$". number_format(array_sum($totales),2);
										?>
									</td>
									<td class="text-right"></td>
								</tr>
								
								<?php 
								}
							?>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>							