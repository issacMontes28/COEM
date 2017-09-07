@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
<?php $message=Session::get('message')?>
@include('Expenses.forms.barra_delete')
@include('alerts.success')
@section('content')
	<div class="container">
		<div class="panel-body">
			{!! Form::open(['route'=>'monthlyExpense.show',
				'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
				<div class="form-group">
					{!!Form::label('fecha_1','Buscar gastos por fecha de pago:')!!}
					{!! Form::date('fecha1',null, ['class'=>'form-control']) !!}
				</div>
				<button type="submit" class="btn btn-success">Buscar</button>
			{!! Form::close() !!}
		</div>
    <div class="panel-body">
      {!! Form::open(['route'=>'concepto',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('nombre_1','Buscar gastos por concepto:')!!}
          <select name="id_gasto" class="form-control">
            <option>Seleccione concepto de gasto</option>
          <?php
            foreach ($gastos as $gasto) {
          ?>
            <option value="<?php echo $gasto->id ?>"><?php echo $gasto->concepto;?></option>
          <?php
            }
           ?>
          </select>
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
		<table class="table">
      <thead>
				<th>Concepto</th>
        <th>Gasto hecho ($)</th>
				<th>Fecha de pago (AA-MM-DD)</th>
				<th>Acción</th>
			</thead>
			@foreach($expenses as $expense)
				<?php
						$mysqli = new mysqli("localhost", "root", "", "coem");
						if ($mysqli->connect_errno) {
								echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
						}
						$acentos = $mysqli->query("SET NAMES 'utf8'");
						//obtenemos el id de la cita
						$id_gasto=$expense->id_gasto;
						//se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
						$query = $mysqli->query("select * from expenses where id='$id_gasto'");
						$fila = $query->fetch_assoc();
						$gasto = $fila['concepto'];

				?>
			<tbody>
        <td><?php echo $gasto; ?></td>
        <td>{{$expense->gasto_mensual}}</td>
        <td>{{$expense->fecha_pago}}</td>
        <td>{!!Form::model($expense,['route'=>['monthlyExpense.destroy',$expense->id],'method'=>'DELETE'])!!}
           <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
		@endforeach
		</table>
		{!!$expenses->render()!!}
	</div>
@stop
