<div class="post format-image box masonry-brick">
<!-- Begin Blog Grid -->
<div class="blog-wrap">
 <table>
	 <tr>
		 <td><strong>Detalles de cita elegida para la venta</strong></td>
	 </tr>
	 <tr>
		 <td><strong>Paciente:</strong></td>
		 <td><span data-bind="text: selectedDate() ? selectedDate().paciente : 'unknown'"></span></td>
	 </tr>
	 <tr>
		 <td><strong>Tipo de consulta:</strong></td>
		 <td><span data-bind="text: selectedDate() ? selectedDate().producto : 'unknown'"></span></td>
	 </tr>
	 <tr>
		 <td><strong>Cantidad:</strong></td>
		 <td><span data-bind="text: selectedDate() ? selectedDate().cantidad : 'unknown'"></span></td>
	 </tr>
	 <tr>
		 <td><strong>Subtotal:</strong></td>
		 <td><span data-bind="text: selectedDate() ? selectedDate().subtotal : 'unknown'"></span></td>
	 </tr>
   <tr>
		 <td><strong>Área a la que asiste:</strong></td>
		 <td><span data-bind="text: selectedDate() ? selectedDate().division : 'unknown'"></span></td>
	 </tr>
   <tr>
  <td>{!!Form::label('Tipo de consulta:')!!}</td>
   <td colspan="5"><select data-bind="options: $root.tiposCitas,
                 value: selectedTipoCita,
                 optionsCaption: 'Elija un tipo de cita adicional en caso de requerirlo...'" class="form-control"></select></td>

   </tr>
 </table>
 </div>
</div>

<div class="post format-image box masonry-brick">
<!-- Begin Blog Grid -->
<div class="blog-wrap">
<div class="form-group">
	<table>
	<tr>
	<td>{!!Form::label('Elija productos:')!!}</td>
  </tr>
	<tr>
		<td data-bind="visible: division()=='Área Bienestar'">
				<input type="radio" name="areap" value="P.Área Bienestar"
				data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
				<h8> Productos Bienestar</h8>
		</td>
		<td data-bind="visible: division()=='Área Salud'">
			<input type="radio" name="areap"  value="P.Área Salud"
				data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
				<h8> Medicamentos A. Salud</h8>
		</td>
    <td data-bind="visible: division()=='Área Bienestar'">
      <input type="radio" name="areap"  value="S.Área bienestar"
        data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
        <h8> Servicios Bienestar</h8>
    </td>
    <td data-bind="visible: division()=='Área Salud'">
      <input type="radio" name="areap"  value="S.Área Salud"
        data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
        <h8> Servicios Salud</h8>
    </td>
    <td data-bind="visible: division()=='Área Bienestar'">
      <input type="radio" name="areap"  value="Depilación"
        data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
        <h8> Depilación</h8>
    </td>
    <td data-bind="visible: division()=='Área Salud'">
      <input type="radio" name="areap"  value="Suplemento"
        data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
        <h8> Suplementos</h8>
    </td>
    <td data-bind="visible: division()=='Área Salud'">
      <input type="radio" name="areap"  value="Mesoterapia"
        data-bind="checked: areap, event: { click: $root.cargarProductosDos() }" />
        <h8>Mesoterapia</h8>
    </td>
	</tr>
	<tr><td><br></td></tr>
  <tr data-bind="visible: areap()=='Depilación'">
    <td>
      {!!Form::label('Agregar nueva depilación:')!!}
    </td>
    <td>
      <button id="btnAgregar" data-bind="click: $root.agregarDepilacion"
      class="btn btn-primary">Fotodepilación</button>
    </td>
  </tr>
  <tr data-bind="visible: areap()=='Mesoterapia'">
    <td>
      {!!Form::label('Agregar nueva Mesoterapia:')!!}
    </td>
    <td>
      <button id="btnAgregar" data-bind="click: $root.agregarMesoterapia"
      class="btn btn-primary">Mesoterapia</button>
    </td>
  </tr>
  <tr>
	<td>{!!Form::label('Producto:')!!}</td>
  <td colspan="5"><select data-bind="options: $root.auxproductos, optionsText: function(item) {
										 return item.nombre()  + ' ' +'  (Precio: ' + item.precio_venta() + ' ,Existencias: ' +item.existencias() + ')'
								 },
								 value: selectedProduct,
								 optionsCaption: 'Elija un producto...'" class="form-control"></select></td>

  </tr>
  <tr>
	<td>{!!Form::label('cantidad:')!!}</td>
  <td><input type="number" data-bind="value: cantidad" class="form-control"></input></td>
	</tr>
	<tr><td></td></tr>
	<tr>
	<td>{!!Form::label('Promoción (opcional):')!!}</td>
  <td colspan="5"><select data-bind="options: $root.promociones, optionsText: function(item) {
                     return item.nombre()},
                 value: selectedPromotion, event: { click: $root.updateProduct() }" class="form-control"></select></td>
	</tr>
	<tr>
	</tr>
  <tr>
	<td>{!!Form::label('Forma de pago:')!!}</td>
	</tr>
	<tr>
		<td>
			<div><input type="radio" name="pago" value="Efectivo" data-bind="checked: formaPago, event: { click: $root.updateProduct() }"/>
        Efectivo</div>
		</td>
		<td>
			<div><input type="radio" name="pago"  value="T.Crédito" data-bind="checked: formaPago,event: { click: $root.updateProduct() }" />
				 T.Crédito</div>
		</td>
    <td>
			<div><input type="radio" name="pago"  value="T.Débito" data-bind="checked: formaPago, event: { click: $root.updateProduct() }" />
				 T.Débito</div>
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
</div>
</div>

<div> <!-- Appears when you select something -->
	<div class="post format-image box masonry-brick">
	<!-- Begin Blog Grid -->
	<div class="blog-wrap">
	 <table>
			 <thead data-bind="visible: productos_venta().length > 0 || nueva_depilacion().length > 0 || nueva_mesoterapia().length > 0">
					 <tr><th colspan="2">Nombre del producto</th><th>Precio unitario</th><th>Cantidad</th><th>Subtotal($)</th>
             <th>Forma de pago</th><th>Promoción</th><th>Acción</th></tr>
			 </thead>
			 <tbody data-bind="visible: productos_venta().length > 0, foreach: productos_venta">
					 <tr>
               <td><input type="checkbox" checked="checked" disabled></input></td>
							 <td><input data-bind="value: producto" disabled></input></td>
							 <td><input data-bind="value: precio" disabled></input></td>
							 <td><input data-bind="value: cantidad" disabled/></td>
							 <td><input data-bind="value: subtotal" disabled/></td>
               <td><input data-bind="value: forma_pago" disabled/></td>
               <td><input data-bind="value: promocion" disabled/></td>
							 <td><button data-bind="click: $root.removeProduct" class="btn btn-danger">Quitar</button></td>
					 </tr>
			 </tbody>
       <tbody data-bind="visible: nueva_depilacion().length > 0, foreach: nueva_depilacion">
        <tr>
            <td><input type="checkbox" checked="checked" disabled></input></td>
            <td><input data-bind="value: producto"></input></td>
            <td><input data-bind="value: precio"></input></td>
            <td><input data-bind="value: cantidad"/></td>
            <td><input data-bind="value: subtotal"/></td>
            <td><input data-bind="value: forma_pago" disabled/></td>
            <td><input data-bind="value: promocion" disabled/></td>
            <td><button data-bind="click: $root.removeNewDepilacion"  class="btn btn-danger">Quitar</button></td>
        </tr>
      </tbody>
      <tbody data-bind="visible: nueva_mesoterapia().length > 0, foreach: nueva_mesoterapia">
       <tr>
           <td><input type="checkbox" checked="checked" disabled></input></td>
           <td><input data-bind="value: producto"></input></td>
           <td><input data-bind="value: precio"></input></td>
           <td><input data-bind="value: cantidad"/></td>
           <td><input data-bind="value: subtotal"/></td>
           <td><input data-bind="value: forma_pago" disabled/></td>
           <td><input data-bind="value: promocion" disabled/></td>
           <td><button data-bind="click: $root.removeNewDepilacion"  class="btn btn-danger">Quitar</button></td>
       </tr>
     </tbody>
	 </table>
	 </div>
	</div>
</div>
<h3 style="color:#FAFAFA" data-bind="visible: totalSurcharge() > 0">
    Total (incluyendo productos y cita): $<span data-bind="text: totalSurcharge().toFixed(2)"></span>
</h3>
