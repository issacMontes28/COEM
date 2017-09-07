<div class="form-group">
	<div><h3><strong>Gastos fijos</strong></h3><br><br/></div>
	<table>
		<thead>
	        <tr><th colspan="2">Concepto</th><th>Tipo de gasto</th><th>Precio a pagar</th><th>Fecha de pago</th></tr>
	  </thead>
		<tbody data-bind="foreach: gastos_fijos">
		 <tr>
			   <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenExpense"></input></td>
				 <td data-bind="text: concepto"></td>
				 <td data-bind="text: tipo_gasto"></td>
				 <td>$<input data-bind="value: cantidad"/></td>
				 <td><input type="date" data-bind="value: fecha_pago"/></td>
		 </tr>
 		</tbody>
	</table>
	<div><br><br/></div>
	<div><h3><strong>Gastos variables</strong></h3><br><br/></div>
	<table>
		<thead>
	        <tr><th colspan="2">Concepto</th><th>Tipo de gasto</th><th>Precio a pagar</th><th>Fecha de pago</th></tr>
	  </thead>
		<tbody data-bind="foreach: gastos_variables">
		 <tr>
			   <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenExpense"></input></td>
				 <td data-bind="text: concepto"></td>
				 <td data-bind="text: tipo_gasto"></td>
				 <td>$<input data-bind="value: cantidad"/></td>
				 <td><input type="date" data-bind="value: fecha_pago"/></td>
		 </tr>
 		</tbody>
	</table>
	<div></div>
	<div><h3 data-bind="visible: nuevos_gastos_variables().length > 0"><strong>Nuevos gastos variables</strong></h3><br><br/></div>
	<table data-bind="visible: nuevos_gastos_variables().length > 0">
		<thead>
	        <tr><th colspan="2">Concepto</th><th>Tipo de gasto</th><th>Precio a pagar</th><th>Fecha de pago</th><th>Acción</th></tr>
	  </thead>
		<tbody data-bind="foreach: nuevos_gastos_variables">
		 <tr>
			   <td><input type="checkbox" checked="checked"></input></td>
				 <td><input data-bind="value: concepto"></input></td>
				 <td><input data-bind="value: tipo_gasto"></input></td>
				 <td>$<input data-bind="value: cantidad"/></td>
				 <td><input type="date" data-bind="value: fecha_pago"/></td>
				 <td><button id="btnAgregar" data-bind="click: $root.removeNewVariable"  class="btn btn-danger">Quitar</button></td>
		 </tr>
 		</tbody>
	</table>
	<div></div>
	<div><button id="btnAgregar" data-bind="click: $root.agregarGastoVariable"  class="btn btn-primary">Agregar un nuevo gasto variable</button></div>
</div>
