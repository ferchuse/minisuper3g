<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicial = $_GET['fecha_inicial'];
	$fecha_final = $_GET['fecha_final'];
	
	
	
	//Ingresos
	$resultadoVentas = mysqli_query($link,$consultaVentas);
	$row_count = mysqli_num_rows($resultadoVentas);
	
	// Consulta Egresos
	$consultar = "SELECT * FROM egresos 
	GROUP BY 
	
	WHERE fecha_egresos BETWEEN '$fecha_inicial' AND '$fecha_final' 
	
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
	  <strong>No hay egresos en estas fechas</strong> 
	</div>
	<?php		
		}
	else{
	?>
	
	<!-- "Egresos" -->
	<div class="col-sm-6">
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