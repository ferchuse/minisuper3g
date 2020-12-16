<form id="form_pago" class="was-validated">
	<div id="modal_pago" class="modal hidden-print " role="dialog" >
		
		<div class="modal-dialog modal-sm">
			<!-- Modal content -->
			<div class="modal-content">
				<!-- "Modal Header" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Datos del Cliente</h4>
				</div>
				
				<!-- "Modal Body" -->
				<div class="modal-body">
					
					<div class="form-group">
						
						<label > Nombre:</label>
						
						<input required id="nombre" name="nombre" class="form-control lead " >
						
					</div>
					<div class="form-group">
						
						<label > Teléfono:</label>
						
						<input required type="tel" id="telefono" name="telefono" class="form-control lead " >
						
					</div>
					<div class="form-group">
						
						<label > Direccion:</label>
						
						<textarea required id="direccion" name="direccion" class="form-control lead " ></textarea>
						
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="lead"> Total a Pagar:</label>
							</div>
							<div class="col-sm-6">
								<input readonly id="subtotal" value="0" type="number" class="form-control lead text-right " name="subtotal">
								
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- "Modal Footer" -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cancelar
					</button>
					<button type="submit" id="cobrar" class="btn btn-success">
						<i class="fa fa-check"></i> Aceptar
					</button>
				</div>
			</div>
		</div>
		
		</div>
</div>
</form>						