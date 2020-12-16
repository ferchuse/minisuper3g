<?php

include('../conexi.php');
include('../funciones/numero_a_letras.php');

$link = Conectarse();
$consulta = "SELECT * FROM pedidos
	LEFT JOIN pedidos_detalle USING (id_pedidos)
	
	WHERE id_pedidos={$_GET["id_pedidos"]}";

$result = mysqli_query($link, $consulta);

while ($fila = mysqli_fetch_assoc($result)) {
    $fila_venta[] = $fila;
}

?>

<!-- Modal -->
<div class="modal fade" id="modal_ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle de Pedido</h4>
      </div>
	  
      <div class="modal-body">
	  
			<!-- Ticket -->
			<section style="width: auto; font-family:calibri, sans-serif, arial;" class="h4">

						<!-- Encabezado Ticket-->
						<section class="h4">

							<?php if (($fila_venta[0]["estatus"]) == "CANCELADO") { ?>
							
								<div class="row justify-content-start">
									<p class="col-xs-12 text-center alert alert-danger"><strong>CANCELADO</strong></p>
								</div>
								<div class="row">
									<div class="pad-10 mar-0 col-xs-12">
										<div style="margin: 0px;" class="mar-0 row">
											<div class="col-xs-12">
												<label class=""><strong>Datos de Cancelación:</strong></label>
												<p class=""><?php echo $fila_venta[0]["datos_cancelacion"]?></p>
											</div>
										</div>
									</div>
								</div>
								
							<?php } ?>
							
							<!-- Datos Venta -->
							<div class=" row justify-content-start">
								<div class="pad-10 mar-0 col-xs-12">
									<div style="margin: 0px;" class="mar-0 row ">
										<span class=" col-xs-3"><strong>Nota de Venta:</strong></span>
										<div class="col-xs-7 text-left"><?php echo $fila_venta[0]["id_pedidos"] ?></div>
									</div>
									<div style="margin: 0px;" class="mar-0 row ">
										<span class=" col-xs-3"><strong>Fecha:</strong></span>
										<div class="col-xs-7 text-left" id="fecha" name="fecha">
											<?php echo date("d/m/Y", strtotime($fila_venta[0]["fecha"])); ?>
										</div>
									</div>
									<div style="margin: 0px;" class="mar-0 row ">
										<span class=" col-xs-3"><strong>Hora:</strong></span>
										<div class="col-xs-7 text-left" id="hora" name="hora">
											<?php echo date("H:i", strtotime($fila_venta[0]["fecha"])); ?>
										</div>
									</div>
									
									<div  style="margin: 0px;" class="mar-0 row ">
										<span class=" col-xs-3"><strong>Cliente:</strong></span>
										<div class="col-xs-7 text-left" class="">
											<?php echo $fila_venta[0]["nombre"] ?>
										</div>
									</div>
									<div style="margin: 0px;" class="mar-0 row ">
										<span class=" col-xs-3"><strong>Teléfono:</strong></span>
										<div class="col-xs-7 text-left" class="">
											<?php echo $fila_venta[0]["telefono"] ?>
										</div>
									</div>
									<div style="margin: 0px;" class="mar-0 row ">
										<span class=" col-xs-3"><strong>Dirección:</strong></span>
										<div class="col-xs-7 text-left" class="">
											<?php echo $fila_venta[0]["direccion"] ?>
										</div>
									</div>
								</div>
							</div>

						</section>


						<!-- Cuerpo Ticket -->
						<!-- Descripción Venta -->
						<table style="border:none;" class="table">

							<thead style="margin-top: 0px; padding:0px;">
								<tr style="margin: 0px; padding:0px;" class="">
									<td style="border:none;" class="text-left"><strong>Cant.</strong></td>
									<td style="border:none;" class="text-left"><strong>Descripción Producto</strong></td>
									<td style="border:none;" class="text-left "><strong>Precio Unitario</strong></td>
									<td style="border:none;" class="text-right "><strong>Importe</strong></td>
								</tr>
							</thead>

							<tbody style="border:none; padding:0px" class=" ">
								<?php foreach ($fila_venta as $i => $producto) { ?>

									<tr style="margin:0px; padding:0px;" class="">
										<td style="border:none;" class="text-left"><?php echo $producto["cantidad"]; ?></td>
										<td style="border:none;" class="text-left"><?php echo $producto["descripcion"]; ?></td>
										<td style="border:none;"><?php echo "$" . $producto["precio"]; ?></td>
										<td style="border:none;" class="text-right"><?php echo "$" . $producto["importe"]; ?></td>
									</tr>

								<?php } ?>
							</tbody>

							<!-- Total -->
							<tfoot>
							
								<tr>
									<td class=" text-right" colspan="3"><strong>TOTAL:</strong></td>
									<td class=" text-right"><?php echo "$" . $producto["total"] ?></td>
								</tr>
								
								
								
							</tfoot>

						</table>
	
			</section>	
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
		
    </div>
  </div>
</div>
