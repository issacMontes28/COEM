<div class="form-group">
	{!!Form::label('id_doctor_1','Paciente al que se le asignará la consulta:')!!}
	<select name="id_paciente">
	<?php  if(isset($paciente)){ ?>
			<option value="<?php echo $paciente->id ?>"><?php echo $paciente->apaterno.' '.$paciente->amaterno.' '.$paciente->nombre ;?></option>
	<?php }
		foreach ($pacients as $pacient) {
	?>
		<option value="<?php echo $pacient->id ?>"><?php echo $pacient->apaterno.' '.$pacient->amaterno.' '.$pacient->nombre ;?></option>
	<?php
		}
	 ?>
	</select>
</div>
<div class="form-group">
{!!Form::label('fecha_1','Fecha de la consulta (DD-MM-AA):')!!}
{!!Form::date('fecha',null,['class'=>'form-control', 'placeholder'=>'Ingrese fecha de la consulta'])!!}
</div>
<div class="form-group">
{!!Form::label('hora_1','Hora de la consulta (opcional):')!!}
{!!Form::time('hora',null,['class'=>'form-control', 'placeholder'=>'Ingrese hora de la consulta'])!!}
</div>
<div class="form-group">
	{!!Form::label('division_1','Área de COEM a la que el paciente asiste:')!!}
	{!!Form::select('division',[
	'Área Bienestar'=>'Área Bienestar',
	'Área Salud'=>'Área Salud'],['class'=>'form-control'])!!}
</div>
<div class="form-group">
	{!!Form::label('tipo_cita_1','Tipo de consulta a la que el paciente asiste:')!!}
	<select name="tipo_cita">
	<?php
		foreach ($medicaments as $medicament) {
			if ($medicament->tipo == "Consulta") {
	?>
		<option value="<?php echo $medicament->id ?>"><?php echo $medicament->nombre ;?></option>
	<?php
			}
		}
	 ?>
	</select>
</div>
<div class="form-group">
	{!!Form::label('id_doctor_1','Doctor asignado a la consulta:')!!}
	<select name="id_doctor">
	<?php
		foreach ($doctors as $doctor) {
	?>
		<option value="<?php echo $doctor->id ?>"><?php echo $doctor->apaterno.' '.$doctor->amaterno.' '.$doctor->nombre ;?></option>
	<?php
		}
	 ?>
	</select>
</div>
<div>
<h4 align="center">Datos del paciente al asistir a la consulta (Solo si no es cita de primera vez)</h4>
</div>
<div class="form-group">
{!!Form::label('kilos_1','Peso actual del paciente:')!!}
<input name="kilos" placeholder="(Solo números)"></input>
</div>
<div class="form-group">
{!!Form::label('cintura_1','Cintura:')!!}
<input name="cintura" placeholder="(Solo números)"></input>
</div>
<div class="form-group">
{!!Form::label('cadera_1','Cadera:')!!}
<input name="cadera" placeholder="(Solo números)"></input>
</div>
<div class="form-group">
  {!!Form::label('motivo_1','Asistencia del paciente:')!!}
  {!!Form::select('asistencia',[
  'El paciente asistió'=>'El paciente asistió',
  'El paciente no asistió por motivo laboral'=>'El paciente no asistió por motivo laboral',
  'El paciente no asistió por motivo personal'=>'El paciente no asistió por motivo personal',
  'El paciente no asistió por motivo de salud'=>'El paciente no asistió por motivo de salud',
  'Otro'=>'Otro (especifíque en "Nota")'
  ],['class'=>'form-control'])!!}
</div>
<div class="form-group">
  {!!Form::label('nota_1','Agregue una nota (opcional):')!!}
  {!!Form::text('nota',null,['class'=>'form-control', 'placeholder'=>'Ingrese una nota'])!!}
</div>
