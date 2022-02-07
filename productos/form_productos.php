<form id="form_productos" autocomplete="off" class="is-validated">
	
	<input class="hidden" type="text" id="id_productos" name="id_productos" value="<?php echo isset($_GET["id_productos"]) ? $_GET["id_productos"] : "";?>">
	<div class="row">
		
		<div class="col-sm-6">
			<div class="form-group">
				
				<label for="codigo_productos">Codigo de Barras:</label>
				<input  type="text" autofocus class="form-control" name="codigo_productos" id="codigo_productos" placeholder="Opcional">
				
			</div>
			<div class="form-group">
				<label for="">Descripción:</label>
				<input placeholder="Nombre del producto" required class="form-control" type="text" name="descripcion_productos" id="descripcion_productos" autocomplete="off">
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label required for="unidad_productos">Unidad de Compra:</label>
					<select  class="form-control" id="unidad_compra" name="unidad_compra">
						<option value="">Elije...</option>
						<option value="PZA">Pieza</option>
						<option value="CHAROLAS">CHAROLAS</option>
						<option selected value="CAJAS">CAJAS</option>
						<option value="PIEZA">PIEZA</option>
						<option  value="COSTAL">COSTAL</option>
						<option value="KG">KG</option>
					</select>
				</div>
				<div class="form-group col-sm-6">
					<label required for="unidad_productos">Unidad de Venta:</label>
					<select  class="form-control" id="unidad_productos" name="unidad_productos">
						<option value="">Elije...</option>
						<option selected value="PZA">Pieza</option>
						<option value="CAJAS">CAJAS</option>
						<option value="KG">KG</option>
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<label required for="id_departamentos">Departamento:</label>
					<?php echo generar_select($link, "departamentos", "id_departamentos", "nombre_departamentos")?>
				</div>
				<div class="form-group col-sm-6">
					<label required for="unidad_productos">Activo:</label>
					<select  class="form-control" id="activo" name="activo">
						<option value="">Elije...</option>
						<option selected value="SI">SI</option>
						<option value="NO">NO</option>
					</select>
				</div>
			</div>
			
			<div class="panel panel-primary">
				<div class="panel-heading ">Inventarios</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="existencia_productos">Existencia en Piezas:</label>
							<input  type="number"  step="any" class="form-control" id="existencia_productos" name="existencia_productos">
						</div>
						<div class="form-group col-sm-6">
							<label for="existencia_cajas">Existencia en <span id="span_unidad_compra">Cajas</span>:</label>
							<input  type="number" min="0" step="any" class="form-control" id="existencia_cajas" name="existencia_cajas">
						</div>
						
					</div>
					
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="min_productos">Minimo:</label>
							<input placeholder="" type="number" min="0" class="form-control" id="min_productos" name="min_productos">
						</div>
					</div>
				</div>
			</div>
			
			
			
		</div>
		
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="costo_mayoreo">Ultimo Costo de compra:</label>
						<input placeholder="" readonly  type="number" min="0" step=".01" class="form-control" id="ultimo_costo_mayoreo" name="ultimo_costo_mayoreo">
					</div>
					<div class="form-group ">
						
						<label for="piezas">Piezas por Paquete:</label>
						<input placeholder="" readonly  type="number"  step="any" class="form-control" id="ultimo_piezas" name="ultimo_piezas">
					</div>
					<div class="form-group ">
						
						<label for="costo_proveedor">Costo x Pieza:</label>
						<input placeholder="" readonly type="number"  step="any" class="form-control" id="ultimo_costo_proveedor" name="ultimo_costo_proveedor">
						
					</div>
					
				</div> 
				<div class="col-md-6">
					<div class="form-group">
						<label for="costo_mayoreo">Costo de compra:</label>
						<input placeholder=""  type="number" min="0" step=".01" class="form-control" id="costo_mayoreo" name="costo_mayoreo">
					</div>
					<div class="form-group ">
						
						<label for="piezas">Piezas por Paquete:</label>
						<input placeholder=""  type="number"  step="any" class="form-control" id="piezas" name="piezas">
						
					</div>
					<div class="form-group ">
						
						
						<label for="costo_proveedor">Costo x Pieza:</label>
						<input placeholder=""  type="number"  step="any" class="form-control" id="costo_proveedor" name="costo_proveedor">
						
					</div>
				</div> 
			</div>
			
			
			<div class="panel panel-primary">
				<div class="panel-heading ">Precios</div>
				<div class="panel-body">
					<?php
						foreach($cat_precios as $i => $tipo_precio){
						?>
						<div class="row form-group">
							<input class="id_precio"  type="hidden" value="<?php echo $tipo_precio["id_precio"] ?>" class="form-control "  name="id_precio[]">
							<div class="col-sm-6">
								<label for=""> % Ganancia :</label>
								<input   type="number" value="<?php echo $tipo_precio["porcentaje"] ?>" step=".01" class="form-control porc_ganancia"  name="porc_ganancia[]">
							</div>
							<div class="col-sm-6">
								<label ><?php echo $tipo_precio["nombre_precio"] ?></label>
								<input  type="number" min="0"  step=".01" class="form-control precio" name="precio[]">
							</div>
						</div>
						<?php
						}
					?>
				</div>
			</div>
			
			
			
			
			
			
			
			<button type="submit" class="btn btn-success btn-lg" id="btn_formAlta">
				<i class="fa fa-save"></i> Guardar
			</button>
			
		</div>
		
		
	</div>
</form>




















