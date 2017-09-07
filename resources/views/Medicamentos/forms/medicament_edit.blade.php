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
	<select name="tipo">
		<option><?php echo $medicament->tipo; ?></option>
		<option>Producto de almacén</option>
		<option>Servicio</option>
		<option value="Fotodepilación">Fotodepilación (Área bienestar)</option>
		<option>Suplemento</option>
		<option>Mesoterapia</option>
		<option>Consulta</option>
 </select>
</div>
@if(Auth::user()->tipo_usuario=="administrador")
<div class="form-group">
{!!Form::label('existencias','Existencias:')!!}
<input type="number" name="existencias" value="<?php echo $medicament->existencias ?>" disabled/>
</div>
@endif
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
			$mysqli = new mysqli("localhost", "root", "", "coem");
			if ($mysqli->connect_errno) {
					echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			$acentos = $mysqli->query("SET NAMES 'utf8'");
			$id_proveedor = $medicament->id_proveedor;
			$query = $mysqli->query("select * from providers where id='$id_proveedor'");
			$fila = $query->fetch_assoc();
			$nombre = $fila['nombre'];
	 ?>
	<option value="<?php echo $medicament->id_proveedor?>"><?php echo $nombre;?></option>
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
		<option value="<?php echo $medicament->area ?>"><?php echo $medicament->area ?></option>
		<option value="Área Bienestar">Área Bienestar</option>
		<option value="Área Salud">Área Salud</option>
 </select>
</div>
<div class="form-group">
{!!Form::label('imagen','Imagen del medicamento (opcional):')!!}
{!!Form::file('imagen')!!}
</div>
