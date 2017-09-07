<div>
<h4 align="center">Datos de la consulta</h4>
</div>
<div class="form-group">
	{!!Form::label('id_doctor_1','Paciente al que se le asignó la consulta:')!!}
	<?php

	$mysqli = new mysqli("localhost", "root", "", "coem");
	if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$acentos = $mysqli->query("SET NAMES 'utf8'");
	//se obtienen los datos de esa cita, interesa el nombre del paciente
	$id_date = $date->id;
	$query = $mysqli->query("select * from dates where id='$id_date'");
	$fila = $query->fetch_assoc();
	$pac = $fila['id_paciente'];
	$fecha = $fila['fecha'];
	$hora = $fila['hora'];
	$division = $fila['division'];
	$tipo_cita = $fila['tipo_cita'];

	$query3 = $mysqli->query("select * from medicaments where id='$tipo_cita'");
	$fila3 = $query3->fetch_assoc();

	$query = $mysqli->query("select * from pacients where id='$pac'");
	$fila = $query->fetch_assoc();
	$peso = $fila['kilos'];

	$id_doctor = $date->id_doctor;
	$query2 = $mysqli->query("select * from doctors where id='$id_doctor'");
	$fila2 = $query2->fetch_assoc();
	$ndoc = $fila2['nombre'].' '.$fila2['apaterno'].' '.$fila2['amaterno'];

	if ($fila['cintura']==null) {$cintura = 0;}
	else {$cintura = $fila['cintura'];}

	if ($fila['cadera']==null) {$cadera = 0;}
	else {$cadera = $fila['cadera'];}

	$paciente = $fila['nombre'].' '. $fila['apaterno'].' '. $fila['amaterno'];
	?>
	<select name="id_paciente">
		<option value="<?php echo $pac ?>"><?php echo $paciente ;?></option>
	<?php
		foreach ($pacients as $pacient) {
	?>
		<option value="<?php echo $pacient->id ?>"><?php echo $pacient->nombre.' '.$pacient->apaterno.' '.$pacient->amaterno ;?></option>
	<?php
		}
	 ?>
 </select>
 </div>
<div class="form-group">
{!!Form::label('fecha_1','Fecha de la consulta (DD-MM-AA):')!!}
{!!Form::date('fecha',null,['placeholder'=>'Ingrese fecha de la consulta'])!!}
</div>
<div class="form-group">
{!!Form::label('hora_1','Hora de la cita:')!!}
{!!Form::time('hora',null,['placeholder'=>'Ingrese hora de la consulta'])!!}
</div>
<div class="form-group">
	{!!Form::label('division_1','Área de COEM a la que el paciente asiste:')!!}
	<select name="division">
		<option><?php echo $division ;?></option>
		<option>Área Bienestar</option>
		<option>Área Salud</option>
	</select>
 </div>
<div class="form-group">
	{!!Form::label('tipo_cita_1','Tipo de consulta a la que el paciente asiste:')!!}
	<select name="tipo_cita">
	<option value="<?php echo $fila3['id'] ?>"><?php echo $fila3['nombre'];?></option>
	<?php
		foreach ($medicaments as $medicament) {
			if ($medicament->tipo=='Servicio') {
	?>
				<option value="<?php echo $medicament->id ?>"><?php echo $medicament->nombre;?></option>
	<?php
			}
		}
	 ?>
	</select>
</div>
<div class="form-group">
	{!!Form::label('id_doctor_1','Doctor que atiende al paciente:')!!}
	<select name="id_doctor">
	<option value="<?php echo $date->id_doctor ?>"><?php echo $ndoc;?></option>
	<?php
		foreach ($doctors as $doctor) {
	?>
		<option value="<?php echo $doctor->id ?>"><?php echo $doctor->nombre.' '.$doctor->apaterno.' '.$doctor->amaterno ;?></option>
	<?php
		}
	 ?>
	</select>
</div>
<div>
<h4 align="center">Datos del paciente al asistir a la consulta</h4>
</div>
<div class="form-group">
{!!Form::label('kilos_1','Peso actual del paciente:')!!}
<input name="kilos" placeholder="(Solo números)"><?php echo " Último peso registrado: ".$peso." kg"; ?></input>
</div>
<div class="form-group">
{!!Form::label('cintura_1','Cintura:')!!}
<input name="cintura" placeholder="(Solo números)"><?php echo " Última medida de cintura registrada: ".$cintura." cm"; ?></input>
</div>
<div class="form-group">
{!!Form::label('cadera_1','Cadera:')!!}
<input name="cadera" placeholder="(Solo números)"><?php echo " Última medida de cadera registrada: ".$cadera." cm"; ?></input>
</div>
