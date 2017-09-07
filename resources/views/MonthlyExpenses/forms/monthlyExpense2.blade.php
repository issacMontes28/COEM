<div class="form-group">
	{!!Form::label('id_gasto_1','Gasto efectuado:')!!}
	<select name="id_gasto">
		<option value="<?php echo $monthlyExpense->id_gasto ?>"><?php echo $expense_gasto->concepto ;?></option>
	<?php
		foreach ($expenses as $expense) {
	?>
		<option value="<?php echo $expense->id ?>"><?php echo $expense->concepto ;?></option>
	<?php
		}
	 ?>
	</select>
</div>
<div class="form-group">
{!!Form::label('gasto','Gasto hecho ($):')!!}
{!!Form::number('gasto_mensual',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!!Form::label('fecha_1','Fecha de pago (DD-MM-AA):')!!}
{!!Form::date('fecha_pago',null,['class'=>'form-control'])!!}
</div>
