@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Promotions.forms.barra_update')
@include('alerts.request')
@include('alerts.success')
@section('content')
	<div class="container">
		<div class="panel-body">
			{!! Form::open(['route'=>'promotion.show',
				'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
				<div class="form-group">
					{!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre de promoción']) !!}
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
        <td>{!!link_to_route('promotion.edit', $title = 'Editar', $parameters = $promotion->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
		{!!$promotions->render()!!}
	</div>
@stop
