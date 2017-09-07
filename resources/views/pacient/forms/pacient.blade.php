<div class="form-group">
{!!Form::label('apaterno_1','Primer apellido:')!!}
{!!Form::text('apaterno',null,['class'=>'form-control', 'placeholder'=>'Ingrese apellido paterno de paciente'])!!}
</div>
<div class="form-group">
{!!Form::label('amaterno_1','Segundo apellido:')!!}
{!!Form::text('amaterno',null,['class'=>'form-control', 'placeholder'=>'Ingrese apellido materno de paciente'])!!}
</div>
<div class="form-group">
{!!Form::label('nombre_1','Nombre:')!!}
{!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de nuevo paciente'])!!}
</div>
<div class="form-group">
{!!Form::label('fecha_nac_1','Fecha de nacimiento:')!!}
{!!Form::date('fecha_nac',null,['class'=>'form-control', 'placeholder'=>'Ingrese fecha de nacimiento de paciente'])!!}
</div>
<div class="form-group">
{!!Form::label('calle_1','Calle:')!!}
{!!Form::text('calle',null,['class'=>'form-control', 'placeholder'=>'Ingrese la calle del domicilio del paciente'])!!}
</div>
<div class="form-group">
{!!Form::label('num_ext_1','Número exterior:')!!}
{!!Form::number('num_ext',null,['class'=>'form-control', 'placeholder'=>'Número exterior'])!!}
</div>
<div class="form-group">
{!!Form::label('num_int_1','Número interior (opcional):')!!}
{!!Form::number('num_int',null,['class'=>'form-control', 'placeholder'=>'Número interior'])!!}
</div>
<div class="form-group">
{!!Form::label('cp_1','Código postal (opcional):')!!}
{!!Form::text('cp',null,['class'=>'form-control', 'placeholder'=>'Ingrese código postal'])!!}
</div>
<div class="form-group">
{!!Form::label('colonia_1','Colonia:')!!}
{!!Form::text('colonia',null,['class'=>'form-control', 'placeholder'=>'Ingrese colonia'])!!}
</div>
<div class="form-group">
{!!Form::label('localidad_1','localidad (opcional):')!!}
{!!Form::text('localidad',null,['class'=>'form-control', 'placeholder'=>'Ingrese localidad'])!!}
</div>
<div class="form-group">
{!!Form::label('municipio_1','Municipio:')!!}
{!!Form::text('municipio',null,['class'=>'form-control', 'placeholder'=>'Ingrese municipio'])!!}
</div>
<div class="form-group">
{!!Form::label('estado_1','Estado:')!!}
{!!Form::select('estado',[
'Morelos'=>'Morelos','Aguascalientes'=>'Aguascalientes','Baja California'=>'Baja California',
'Baja California Sur'=>'Baja California Sur','Campeche'=>'Campeche','Chiapas'=>'Chiapas',
'Chihuahua'=>'Chihuahua','Coahuila'=>'Coahuila','Colima'=>'Colima','Distrito Federal'=>'Distrito Federal',
'Durango'=>'Durango','Estado de México'=>'Estado de México','Guanajuato'=>'Guanajuato','Guerrero'=>'Guerrero',
'Hidalgo'=>'Hidalgo','Jalisco'=>'Jalisco','Michoacán'=>'Michoacán','Nayarit'=>'Nayarit','Nuevo León'=>'Nuevo León',
'Oaxaca'=>'Oaxaca','Puebla'=>'Puebla','Querétaro'=>'Querétaro','Quintana Roo'=>'Quintana Roo',
'San Luis Potosí'=>'San Luis Potosí','Sinaloa'=>'Sinaloa','Sonora'=>'Sonora','Tabasco'=>'Tabasco',
'Tamaulipas'=>'Tamaulipas','Tlaxcala'=>'Tlaxcala','Veracruz'=>'Veracruz','Yucatán'=>'Yucatán',
'Zacatecas'=>'Zacatecas'],['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!!Form::label('telefono_casa_1','Telefono de casa (opcional):')!!}
{!!Form::number('telefono_casa',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono de casa'])!!}
</div>
<div class="form-group">
{!!Form::label('telefono_celular_1','Telefono celular (opcional):')!!}
{!!Form::number('telefono_celular',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono celular'])!!}
</div>
<div class="form-group">
{!!Form::label('telefono_oficina_1','Telefono de oficina (opcional):')!!}
{!!Form::number('telefono_oficina',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono de oficina'])!!}
</div>
<div class="form-group">
{!!Form::label('correo_1','Correo (opcional):')!!}
{!!Form::email('correo',null,['class'=>'form-control', 'placeholder'=>'Ingrese correo del paciente'])!!}
</div>
<div class="form-group">
{!!Form::label('fecha_inicio_1','Fecha de primera cita:')!!}
{!!Form::date('fecha_inicio',null,['class'=>'form-control', 'placeholder'=>'Ingrese fecha primera cita'])!!}
</div>
<div class="form-group">
{!!Form::label('kilos_1','Peso:')!!}
{!!Form::text('kilos',null,['class'=>'form-control', 'placeholder'=>'Ingrese peso inicial de paciente en kilos ej. "64.5" '])!!}
</div>
<div class="form-group">
{!!Form::label('cintura_1','Cintura (opcional):')!!}
{!!Form::text('cintura',null,['class'=>'form-control', 'placeholder'=>'Ingrese medida de cintura de paciente en centimetros ej. "74.5" '])!!}
</div>
<div class="form-group">
{!!Form::label('cadera_1','Cadera (opcional):')!!}
{!!Form::text('cadera',null,['class'=>'form-control', 'placeholder'=>'Ingrese medida de cadera de paciente en centimetros ej. "77.3" '])!!}
</div>
<div class="form-group">
{!!Form::label('fecha_fin_1','Fecha tentativa de término (opcional):')!!}
{!!Form::date('fecha_fin',null,['class'=>'form-control', 'placeholder'=>'Ingrese fecha tentativa de termino de tratamiento'])!!}
</div>
<div class="form-group">
	<table>
		<tr><td colspan="3">{!!Form::label('referido_por_1','Referido por:')!!}</td></tr>
		<tr>
			<td>{!!Form::checkbox('referidos[]', 'paciente', false)!!}</td>
			<td>{!!Form::label('referido_por_1','Paciente')!!}</td>
			<td>
				<select name="paciente">
					<option>Especifique quien</option>
					<?php
						foreach ($pacients as $pacient) {
					?>
						<option><?php echo $pacient->nombre.' '.$pacient->apaterno.' '.$pacient->amaterno ;?></option>
					<?php
						}
					 ?>
				 </select>
	   </td>
		</tr>
		<tr>
			<td>{!!Form::checkbox('referidos[]', 'flyer', false)!!}</td>
			<td>{!!Form::label('flyer_1','Flyer')!!}</td>
		</tr>
		<tr>
			<td>{!!Form::checkbox('referidos[]', 'manta', false)!!}</td>
			<td colspan="2">{!!Form::label('manta_1','Manta')!!}</td>
		</tr>
		<tr>
			<td>{!!Form::checkbox('referidos[]', 'facebook o twitter', false)!!}</td>
			<td colspan="2">{!!Form::label('facebook_twitter','Facebook o Twitter')!!}</td>
		</tr>
		<tr>
			<td>{!!Form::checkbox('referidos[]','página web' , false)!!}</td>
			<td colspan="2">{!!Form::label('pagina_web','Página web')!!}</td>
		</tr>
		<tr>
			<td>{!!Form::checkbox('referidos[]','otro' , false)!!}</td>
			<td>{!!Form::label('pagina_web','Otro')!!}</td>
			<td>{!!Form::text('otro_1',null,['class'=>'form-control', 'placeholder'=>'(especifíque)'])!!}</td></tr>
	</table>
</div>
