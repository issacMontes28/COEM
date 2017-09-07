<div class="form-group">
{!!Form::label('nombre_1','Nombre:')!!}
{!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de nuevo medicamento'])!!}
</div>
<div class="form-group">
{!!Form::label('descripcion','Descripcion:')!!}
{!!Form::text('descripcion',null,['class'=>'form-control', 'placeholder'=>'Ingrese descripcion de medicamento'])!!}
</div>
<div class="form-group">
{!!Form::label('tipo_1','Tipo de producto:')!!}
{!!Form::select('tipo',['Producto de almacén'=>'Producto de almacén','Servicio'=>'Servicio',
	'Fotodepilación'=>'Fotodepilación (Área Bienestar)','Sumplemento'=>'Suplemento','Mesoterapia'=>'Mesoterapia',
	'Consulta'=>'Consulta'])!!}
</div>
<div class="form-group">
{!!Form::label('existencias','Existencias:')!!}
{!!Form::number('existencias',null,['class'=>'form-control', 'placeholder'=>'Ingrese existencias del medicamento'])!!}
</div>
<div class="form-group">
{!!Form::label('precio_compra','Precio de compra:')!!}
{!!Form::text('precio_compra',null,['class'=>'form-control', 'placeholder'=>'Ingrese precio de compra'])!!}
</div>
<div class="form-group">
{!!Form::label('precio_venta','Precio de venta:')!!}
{!!Form::text('precio_venta',null,['class'=>'form-control', 'placeholder'=>'Ingrese precio de venta'])!!}
</div>
<div class="form-group">
{!!Form::label('precio_venta_tarjeta_1','Precio de venta con tarjeta de crédito o débito:')!!}
{!!Form::text('precio_venta_tarjeta',null,['class'=>'form-control', 'placeholder'=>'Ingrese precio de venta con tarjeta'])!!}
</div>
<div class="form-group">
	{!!Form::label('id_proveedor_1','Proveedor del producto (no aplica en servicios):')!!}
	<select name="id_proveedor">
	<?php
		foreach ($providers as $provider) {
	?>
		<option value="<?php echo $provider->id ?>"><?php echo $provider->nombre;?></option>
	<?php
		}
	 ?>
 </select>
</div>
<div class="form-group">
	{!!Form::label('area_1','Éste medicamento se usa en área:')!!}
	<select name="area">
		<option value="Área Bienestar">Área Bienestar</option>
		<option value="Área Salud">Área Salud</option>
 </select>
</div>
<div class="form-group">
{!!Form::label('imagen','Imagen del medicamento (opcional):')!!}
{!!Form::file('imagen')!!}
</div>
