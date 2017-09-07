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
			{!! Form::open(['route'=>'expense.show',
				'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
				<div class="form-group">
					{!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Concepto de gasto']) !!}
				</div>
				<button type="submit" class="btn btn-success">Buscar</button>
			{!! Form::close() !!}
		</div>
		<table class="table">
      <thead>
				<th>Concepto</th>
        <th>Tipo de pago</th>
				<th>Precio</th>
				<th>Acción</th>
			</thead>
			@foreach($expenses as $expense)
			<tbody>
        <td>{{$expense->concepto}}</td>
        <td>{{$expense->tipo_gasto}}</td>
        <td>{{$expense->cantidad}}</td>
        <td align="center">{!!Form::model($expense,['route'=>['expense.destroy',$expense->id],'method'=>'DELETE'])!!}
           <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
		@endforeach
		</table>
		{!!$expenses->render()!!}
	</div>
@stop
