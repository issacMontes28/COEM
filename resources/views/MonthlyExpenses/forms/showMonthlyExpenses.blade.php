<div class="form-group">
	<div><h4><strong>Seleccione un rango de fechas para mostrar balance</strong></h4><br><br/></div>
 <table>
	<tr>
		<td>Fecha inicial</td><td><input type="date" id="uno" data-bind="value: fecha_inicial"/></td>
		<td>Total de ingresos en el rango de fechas</td><td> $<span data-bind="text: totalIngresos().toFixed(2)"></span></td>
		<td>Total ingresos Área Imagen</td><td> $<span data-bind="text: totalIngresosImagen().toFixed(2)"></span></td>
	</tr>
	<tr>
		<td>Fecha final</td><td><input type="date"  id="dos" data-bind="value: fecha_final"/></td>
		<td>Total de gastos en el rango de fechas</td><td> $<span data-bind="text: totalGastos().toFixed(2)"></span></td>
		<td>Total ingresos Área salud</td><td> $<span data-bind="text: totalIngresosSalud().toFixed(2)"></span></td>
	</tr>
	<tr>
		<td colspan="2"><button id="btnAgregar" data-bind="click: $root.obtener" class="btn btn-primary">Ver balance entre estas fechas</button></td>
		<td>Diferencia de gastos e ingresos</td><td>$<span data-bind="text: diferencia().toFixed(2)"></span></td>
	</tr>
 </table>
<div><br><br/></div>
	<div  data-bind="visible: auxiliar_ingresos().length > 0 || auxiliar_gastos().length > 0">
		<div data-bind="foreach: { data: auxiliar_ingresos2, as: 'ingreso' }">
			<table>
						<thead>
							<tr><th colspan="3" data-bind="text: ingreso.fechaLetra"></th></tr>
						</thead>
				<tbody>
					<tr>
						<td>
						 <table>
								<thead>
									<tr><th colspan="3">Ingresos área Imagen</th></tr>
									<tr><th colspan="2">Concepto</th><th>Cantidad ($)</th></tr>
								</thead>
								<tbody data-bind="foreach: { data: ventasimagen, as: 'ingreso' }">
									<tr>
											 <td colspan="2" data-bind="text: ingreso.concepto"></td>
											 <td data-bind="text: ingreso.cantidad"></td>
									</tr>
								</tbody>
								<tbody>
									<tr>
											<td colspan="2"><font face="roman" color="blue">TOTAL ÁREA IMAGEN</font></td>
											<td data-bind="text: ingreso.totalimagen"></td>
								  </tr>
								</tbody>
						 </table>
						</td>
						<td>
							<table>
								<thead>
									<tr><th colspan="3">Ingresos área Salud</th></tr>
									<tr><th colspan="2">Concepto</th><th>Cantidad ($)</th></tr>
								</thead>
								<tbody data-bind="foreach: { data: ventassalud, as: 'ingreso' }">
									<tr>
											 <td colspan="2" data-bind="text: ingreso.concepto"></td>
											 <td data-bind="text: ingreso.cantidad"></td>
									</tr>
								</tbody>
								<tbody>
									<tr>
											<td colspan="2"><font face="roman" color="blue">TOTAL ÁREA SALUD</font></td>
											<td data-bind="text: ingreso.totalsalud"></td>
								  </tr>
								</tbody>
							</table>
						</td>
						<td>
							<table>
								<thead>
									<tr><th colspan="3">Gastos</th></tr>
									<tr><th colspan="2">Concepto</th><th>Cantidad ($)</th></tr>
								</thead>
								<tbody data-bind="foreach: { data: gastos, as: 'gasto' }">
									 <tr>
											 <td colspan="2" data-bind="text: gasto.concepto"></td>
											 <td data-bind="text: gasto.cantidad"></td>
									</tr>
								</tbody>
									<tr>
											<td colspan="2"><font face="roman" color="blue">TOTAL GASTOS</font></td>
											<td data-bind="text: ingreso.totalgastos"></td>
								  </tr>
							</table>
						</td>
					</tr>
				</tbody>
			 </table>
			 <div><br></div>
		 	</div>
		 </div>
		</div>
