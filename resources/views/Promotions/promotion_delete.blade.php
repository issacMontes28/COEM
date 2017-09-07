@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
<?php $message=Session::get('message')?>
@include('Promotions.forms.barra_delete')
@include('alerts.success')
@section('content')
	<div class="container">
		<div class="panel-body">
			{!! Form::open(['route'=>'promotion.show',
				'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
				<div class="form-group">
					{!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Concepto de gasto']) !!}
				</div>
				<button type="submit" class="btn btn-success">Buscar</button>
			{!! Form::close() !!}
		</div>
		<table class="table">
      <thead>
				<th>Nombre de promoción</th>
        <th>Descripción</th>
        <th>Tipo de promoción</th>
				<th>Acción</th>
			</thead>
			@foreach($promotions as $promotion)
			<tbody>
        <td>{{$promotion->nombre}}</td>
        <td>{{$promotion->descripcion}}</td>
        <td>{{$promotion->tipo}}</td>
        <td align="center">{!!Form::model($promotion,['route'=>['promotion.destroy',$promotion->id],'method'=>'DELETE'])!!}
           <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
		@endforeach
		</table>
		{!!$promotions->render()!!}
	</div>
@stop
