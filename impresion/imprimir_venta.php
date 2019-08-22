<?php

include('../conexi.php');
include('../funciones/numero_a_letras.php');
$nombre_empresa = "MINISUPER 3G";

$link = Conectarse();
$consulta = "SELECT * FROM ventas
	LEFT JOIN ventas_detalle USING (id_ventas)
	LEFT JOIN usuarios USING (id_usuarios)
	WHERE id_ventas={$_GET["id_ventas"]}";

$result = mysqli_query($link, $consulta);

while ($fila = mysqli_fetch_assoc($result)) {
	$fila_venta[] = $fila;
}

?>
<!-- <link rel="stylesheet" href="css/imprimir_venta.css"> -->
<!-- Ticket -->
<section class="ticket container">

	<!-- Encabezado Ticket-->
	<section class="encabezado">

		<!-- Nombre: "Empresa" -->
		<div class="empresa row">
			<p class="nombre col-xs-12 text-center"><strong><?php echo $nombre_empresa; ?></strong></p>
		</div>

		<!-- Datos: "Venta" -->
		<div class="venta row">
			<!-- "Datos" -->
			<div class="datos col-xs-12">
				<div class="row margin-none">
					<span class="col-xs-5"><strong>Folio:</strong></span>
					<div class="col-xs-6" class=""><?php echo $fila_venta[0]["id_ventas"] ?></div>
				</div>
				<div class="row margin-none">
					<span class="col-xs-5"><strong>Fecha:</strong></span>
					<div class="col-xs-7" class="" id="fecha" name="fecha">
						<?php echo date("d/m/Y", strtotime($fila_venta[0]["fecha_ventas"])); ?>
					</div>
				</div>
				<div class="row margin-none">
					<span class=" col-xs-5"><strong>Hora:</strong></span>
					<div class="col-xs-7" id="hora" name="hora">
						<?php echo date("H:i", strtotime($fila_venta[0]["hora_ventas"])); ?>
					</div>
				</div>
				<div class="row margin-none">
					<span class="col-xs-5"><strong>Usuario:</strong></span>
					<div class="col-xs-7" id="usuario" name="usuario">
						<?php echo $fila_venta[0]["nombre_usuarios"]; ?>
					</div>
				</div>
				<div hidden class="row margin-none">
					<span class=" col-xs-5">Cliente:</span>
					<div class="col-xs-7" class="">
						<?php echo $fila_venta[0]["nombre_cliente"] ?>
					</div>
				</div>
			</div>
		</div>

	</section>

	<!-- Cuerpo Ticket -->
	<table class="cuerpo table">

		<!-- Encabezados -->
		<thead class="encabezados">
			<tr class="fila border-none">
				<td class="text-center border-none"></td>
				<td style="margin: 0px; padding:0px;" class="descripcion text-left border-none" colspan="3">DESCRIPCIÓN DEL PRODUCTO</td>
			</tr>
			<tr class="fila font-13">
				<td class="cantidad border-none text-center c-wid-50"><strong>Cant.</strong></td>
				<td class="border-none text-center c-wid-5"></td>
				<td class="unitario border-none text-left"><strong>Precio Unitario</strong></td>
				<td class="importe border-none text-right"><strong>Importe</strong></td>
			</tr>
		</thead>

		<!-- Productos -->
		<tbody class="productos" style="border:none; line-height: 12px; padding:0px">
			<?php foreach ($fila_venta as $i => $producto) { ?>

			<tr style="margin: 0px; padding:0px;" class="">
				<td style="border:none; line-height: 12px; margin: 0px; padding:0px;" class="text-center"><?php echo $producto["cantidad"]; ?></td>
				<td style="border:none; line-height: 12px; margin: 0px; padding:0px;" class="" colspan="2"><?php echo $producto["descripcion"]; ?></td>
				<td style="border:none; line-height: 12px;"></td>
				<td style="border:none; line-height: 12px;"></td>
			</tr>
			<tr style="margin: 0px; padding:0px;" class="">
				<td style="border:none; line-height: 12px;"></td>
				<td style="border:none; line-height: 12px;"></td>
				<td style="border:none; line-height: 12px;"><?php echo "$" . $producto["precio"]; ?></td>
				<td style="border:none; line-height: 12px;" class="text-right"><?php echo "$" . $producto["importe"]; ?></td>
			</tr>

			<?php } ?>
		</tbody>

		<!-- Total -->
		<tfoot class="total font-13" style="margin-bottom: 3px;">
			<tr>
				<td class=" text-right" colspan="3"><strong>TOTAL:</strong></td>
				<td class=" text-right"><?php echo "$" . $producto["total_ventas"] ?></td>
			</tr>
		</tfoot>

	</table>

	<!-- Pie Ticket -->
	<section class="pie" style="margin-top: 3px;">
		<p class="font-12-5 text-center">
			<?php echo NumeroALetras::convertir($producto["total_ventas"], "pesos", "centavos") ?>
		</p>
		<p class="font-14 text-center"><strong>GRACIAS POR SU COMPRA</strong></p>
	</section>

</section>