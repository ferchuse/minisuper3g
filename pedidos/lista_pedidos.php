<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
	
	$lista_movimientos = [];
	$entradas = [];
	$salidas = [];
	$departamento = [];
	
	
	$consulta_movimientos = "SELECT * 
	FROM pedidos
	WHERE
	DATE(fecha) BETWEEN '{$_GET['fecha_inicio']}'
	AND '{$_GET['fecha_fin']}'
	
	";
	
	if($_GET['estatus'] != ''){
		$consulta_movimientos .= "
		AND
		estatus = '{$_GET['estatus']}'";
	}
	if($_GET['id_productos'] != ''){
		$consulta_movimientos .= "
		AND
		id_productos ='{$_GET['id_productos']}'";
	}
	
	$consulta_movimientos .= " ORDER BY
	{$_GET['sort']} DESC";
	
	
	$result_movimientos = mysqli_query($link,$consulta_movimientos) or die ("<pre>Error en $consulta_movimientos". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result_movimientos)){
		
		$lista_movimientos[] = $fila;
		
	}
	
	
?>

<pre class="hidden">
	<?php echo $consulta_movimientos;?>
</pre>
<?php 
	if(mysqli_num_rows($result_movimientos) < 1){
	?>
	<br>
	
	<div class="alert alert-warning text-center">
		<strong>No hay registros</strong> 
	</div>
	<?php		
	}
	else{
	?>
	<hr>
	
	<div class="col-4">
		<div class="card ">
			<div class="card-header bg-info text-white">
				
			</div>
			<div class="card-body" >
				<div class="table-responsive">
					
					<table class="table table-hover">
						<tr>
							<th class="text-center">
								<a href="#" class="sort" data-campo="descripcion_productos">Folio</a>
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="nombre">Cliente</a>
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="telefono">Telefono</a>
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="direccion">Direccion</a>
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="estatus">Estatus</a>
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="total">Total</a>
							</th>	
							<th class="text-center">
								<a href="#" class="sort" data-campo="total">Detalle</a>
							</th>							
						</tr>
						<?php 
							
							foreach($lista_movimientos AS $i => $pedido){
							?>
							<tr class="text-center">
								
								<td><?php echo $pedido["id_pedidos"];?></td>
								<td><?php echo $pedido["nombre"];?></td>
								<td><?php echo $pedido["telefono"];?></td>
								<td><?php echo $pedido["direccion"];?></td>
								<td>
									<?php echo $pedido["estatus"];?>
									
								</td>
								<td><?php echo $pedido["total"];?></td>
								<td>
									<button type="button" title="Ver Ventas" class="btn btn-success btn_detalle" data-id_pedidos="<?php echo $pedido["id_pedidos"]; ?>">
										<i class="fas fa-eye"></i>
									</button>
								</td>
								
							</tr>
							<?php
								
							}
							
						?>
						
						
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="col-4 hidden">
		<div class="card ">
			<div class="card-header bg-success text-white">
				<h4 class="text-center">
					Entradas
				</h4>
			</div>
			<div class="card-body" >
				<div class="table-responsive">
					
					<table class="table table-hover">
						<tr>
							<th class="text-center">Fecha</th>
							<th class="text-center">Folio</th>
							<th class="text-center">Código</th>
							<th class="text-center">Cantidad</th>                                                         
						</tr>
						<?php 
							$total = 0;
							foreach($entradas AS $i => $fila_entradas){
								$total+=$fila_entradas["cantidad"];
							?>
							<tr class="text-center">
								<td><?php echo date("d/m/Y", strtotime($fila_entradas["fecha_movimiento"]));?></td>
								<td><?php echo $fila_entradas["folio"];?></td>
								<td><?php echo $fila_entradas["codigo_productos"];?></td>
								<td><?php echo $fila_entradas["cantidad"];?></td>
								
							</tr>
							<?php
								
							}
							
						?>
						<tfoot> 
							<tr class="text-center h3">
								<td colspan="2"><b>TOTAL</b></td>
								<td><b><?php echo $total;?></b></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="col-sm-4 hidden">
		<div class="card ">
			<div class="card-header bg-danger text-white">
				<h4 class="text-center">
					Salidas
				</h4>
			</div>
			<div class="card-body" >
				<div class="table-responsive">
					<table class="table table-hover">
						<tr>
							<th class="text-center">Fecha</th>
							<th class="text-center">Código</th>
							<th class="text-center">Cantidad</th>                                                         
						</tr>
						<?php 
							$total = 0;
							foreach($salidas AS $i => $fila_salidas){
								$total+=$fila_salidas["cantidad"];
							?>
							<tr class="text-center">
								<td><?php echo date("d/m/Y", strtotime($fila_salidas["fecha_movimiento"]));?></td>
								<td><?php echo $fila_salidas["codigo_productos"];?></td>
								<td><?php echo $fila_salidas["cantidad"];?></td>
							</tr>
							<?php
								
							}
							
						?>
						<tfoot> 
							<tr class="text-center h3">
								<td colspan="2"><b>TOTAL</b></td>
								<td><b><?php echo $total;?></b></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
}
?>


