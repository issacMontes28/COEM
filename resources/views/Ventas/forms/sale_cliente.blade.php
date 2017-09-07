<div class="post format-image box masonry-brick">
<!-- Begin Blog Grid -->
<div class="blog-wrap">
<div class="form-group">
	<table>
	<tr>
	<td>{!!Form::label('id_doctor_1','Cliente a quien se facturará: ')!!}</td>
	<td><select data-bind="options: $root.clientes, optionsText: function(item) {
                       return item.nombre()
                   },
									 value: selectedCliente,
                   optionsCaption: 'Elija un cliente...'"></select></td>
	</tr>
	<tr>
	<td>{!!Form::label('Elija productos:')!!}</td>
	</tr>
	<tr>
		<td>
				<input type="radio" name="areap" value="Área Bienestar"
				data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
				<h8>Productos del área de Bienestar</h8>
		</td>
		<td>
			<input type="radio" name="areap"  value="Área Salud"
				data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
				<h8> Productos del área de Salud</h8>
		</td>
	</tr>
	<tr><td><br></td></tr>
  <tr>
	<td>{!!Form::label('Producto:')!!}</td>
  <td><select data-bind="options: $root.auxproductos, optionsText: function(item) {
										 return item.nombre()  + '  (Precio de venta: ' + item.precio_venta() + ' ,Existencias: ' +item.existencias() + ')'
								 },
								 value: selectedProduct,
								 optionsCaption: 'Elija un producto...'"></select></td>

  <tr>
	<td>{!!Form::label('cantidad:')!!}</td>
  <td><input type="number" data-bind="value: cantidad"></input></td>
	</tr>
	<tr><td></td></tr>
	<tr>
	<td>{!!Form::label('Forma de pago:')!!}</td>
	</tr>
	<tr>
		<td>
			<div><input type="radio" name="pago" value="Efectivo" data-bind="checked: formaPago" /> Efectivo</div>
		</td>
		<td>
			<div><input type="radio" name="pago"  value="T.Crédito/Débito" data-bind="checked: formaPago" />
				 T.Crédito/Débito</div>
		</td>
	</tr>
</table>
</div>
<div class="form-group">
	<label for="btnAgregar" class="col-sm-2 control-label"></label>
	<div class="col-sm-10">
		<button id="btnAgregar" data-bind="click: $root.agregarProducto_venta"  class="btn btn-primary col-sm-8 col-md-offset-1">Agregar producto a la venta actual</button>
 	</div>
</div>
<tr><td><br><br/></td></tr>
</div>
</div>

<div class="form-group">
<br><br/><br><br/>
</div>

<div data-bind="visible: selectedCliente"> <!-- Appears when you select something -->
	<div class="post format-image box masonry-brick">
	<!-- Begin Blog Grid -->
	<div class="blog-wrap">
	 <table>
		 <tr>
			 <td><strong>Detalles de cliente elegido</strong></td>
		 </tr>
		 <tr>
			 <td><strong>Cliente:</strong></td>
			 <td><span data-bind="text: selectedCliente() ? selectedCliente().nombre: 'unknown'"></span></td>
		 </tr>
		 <tr>
			 <td><strong>Correo:</strong></td>
			 <td><span data-bind="text: selectedCliente() ? selectedCliente().correo : 'unknown'"></span></td>
		 </tr>
		 <tr>
			 <td><strong>Inició de tratamiento:</strong></td>
			 <td><span data-bind="text: selectedCliente() ? selectedCliente().fecha_inicio : 'unknown'"></span></td>
		 </tr>
		 <tr>
			 <td><strong>Peso a la fecha:</strong></td>
			 <td><span data-bind="text: selectedCliente() ? selectedCliente().peso : 'unknown'"></span></td>
		 </tr>
		 <tr>
			 <td><br><br></td>
		 </tr>
		 <tr>
			 <td><strong>Productos a facturar</strong></td>
		 </tr>
		 <tr>
			 <td colspan="2"></td>
		 </tr>
	 </table>
	 <table>
			 <thead>
					 <tr><th>Nombre del producto____|</th><th>Precio____|</th><th>Cantidad____|</th><th>Subtotal____|</th><th>Acción____|</th></tr>
			 </thead>
			 <tbody data-bind="foreach: productos_venta">
					 <tr>
							 <td data-bind="text: producto"></td>
							 <td data-bind="text: precio"></td>
							 <td data-bind="text: cantidad"></td>
							 <td data-bind="text: subtotal"></td>
							 <td><a href="#" data-bind="click: $root.removeProduct">Remover</a></td>
					 </tr>
			 </tbody>
	 </table>
	 </div>
	</div>
</div>
<h3 style="color:#FAFAFA" data-bind="visible: totalSurcharge() > 0">
    Total (incluyendo medicamentos y cita): $<span data-bind="text: totalSurcharge().toFixed(2)"></span>
</h3>
