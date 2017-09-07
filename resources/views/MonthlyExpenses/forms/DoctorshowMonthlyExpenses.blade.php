<div class="form-group">
	<div><h4><strong>Seleccione un rango de fechas para mostrar citas</strong></h4><br><br/></div>
 <table>
	<tr>
		<td>Fecha inicial</td><td><input type="date" id="uno" data-bind="value: fecha_inicial"/></td>
	</tr>
	<tr>
		<td>Fecha final</td><td><input type="date"  id="dos" data-bind="value: fecha_final"/></td>
	</tr>
	<tr>
		<td colspan="2"><button id="btnAgregar" data-bind="click: $root.obtener" class="
			btn btn-primary">
			Ver citas entre estas fechas</button></td>
	</tr>
 </table>
<div><br><br/></div>
	<div  data-bind="visible: auxiliar_citas().length > 0">
		<div>
			<table>
						<thead>
							<tr><th>TOTAL DE GANANCIAS POR CITAS EN EL RANGO DE FECHAS ($)</th><th data-bind="text: totalGlobal"></th></tr>
						</thead>
			 </table>
			 <div><br></div>
			</div>
		<div>
			<table>
						<thead>
							<tr><th colspan="2">CITAS HECHAS POR CADA DOCTOR EN EL RANGO DE FECHAS</th></tr>
							<tr><th>DOCTOR</th><th>NÚMERO DE CITAS HECHAS</th></tr>
						</thead>
				<tbody data-bind="foreach: { data: aux_arreglo_doctores_citas, as: 'aux' }">
					<tr>
						<td data-bind="text: aux.doctor"></td>
						<td data-bind="text: aux.totalcitas"></td>
					</tr>
				</tbody>
			 </table>
			 <div><br></div>
			</div>
		<div data-bind="foreach: { data: auxiliar_citas2, as: 'cita' }">
			<table>
						<thead>
							<tr><th colspan="3" data-bind="text: cita.fechaLetra"></th></tr>
						</thead>
				<tbody>
					<tr>
						<td>
							<table>
								<thead>
									<tr><th colspan="6">Ingresos por citas</th></tr>
									<tr><th>Paciente</th><th>Hora</th><th>Doctor</th>
									<th>Tipo cita</th><th>Área</th><th>Precio cita ($)</th></tr>
								</thead>
								<tbody data-bind="foreach: { data: citas, as: 'ingreso' }">
									<tr>
											 <td data-bind="text: ingreso.paciente"></td>
											 <td data-bind="text: ingreso.hora"></td>
											 <td data-bind="text: ingreso.doctor"></td>
											 <td data-bind="text: ingreso.tipo_cita"></td>
											 <td data-bind="text: ingreso.division"></td>
											 <td data-bind="text: ingreso.cantidad"></td>
									</tr>
								</tbody>
								<tbody>
									<tr>
											 <td colspan="5">TOTAL DE GANANCIAS POR LAS CITAS EN ESTA FECHA ($)</td>
											 <td data-bind="text: cita.totalcitas"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			 </table>
			 <div><br></div>
		 	</div>
		 </div>
		</div>
