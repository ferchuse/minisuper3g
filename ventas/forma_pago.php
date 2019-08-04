
<form id="form_pago">
	<div id="modal_pago" class="modal " role="dialog">
		<div class="modal-dialog modal-sm">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Datos de Pago</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-sm-6">
							<label>Efectivo: </label>
						</div>
						<div class="col-sm-6">
							<input  id="efectivo"  step=".5" type="number" class="form-control" name="efectivo" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Tarjeta de Débito: </label>
						</div>
						<div class="col-sm-6">
							<input id="debito" value="0" type="number" class="form-control" name="debito" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Tarjeta de Crédito: </label>
						</div>
						<div class="col-sm-6">
							<input id="credito" value="0" type="number" class="form-control" name="credito" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Comisión: </label>
						</div>
						<div class="col-sm-6">
							<input id="comision" value="0" type="number" class="form-control" name="comision" >
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							<label>Total: </label>
						</div>
						<div class="col-sm-6">
							<input id="total_pago" value="0" type="number" class="form-control" name="total_pago" >
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cancelar
					</button>
					<button type="submit" class="btn btn-success">
						<i class="fa fa-check"></i> Aceptar
						
					</button>
				</div>
			</div>
			
		</div>
	</div>
</div>
</form>



