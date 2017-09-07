@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('monthlyExpenses.forms.barra_alternativa')
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
				<th>Precio aproximado</th>
				<th colspan="2">Acciones</th>
			</thead>
			@foreach($expenses as $expense)
			<tbody>
        <td>{{$expense->concepto}}</td>
        <td>{{$expense->tipo_gasto}}</td>
        <td>{{$expense->cantidad}}</td>
				<td>{!!Form::model($expense,['route'=>['expense.destroy',$expense->id],'method'=>'DELETE'])!!}
           <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
				<td>{!!link_to_route('expense.edit', $title = 'Editar', $parameters = $expense->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
		    {!!$expenses->render()!!}
	</div>
@stop
