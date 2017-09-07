@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@section('content')
@include('Proveedores.forms.barra')
@include('alerts.success')
<?php $message=Session::get('message');?>
	<div class="container">
		<div class="panel-body">
			{!! Form::open(['route'=>'provider.show',
				'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
				<div class="form-group">
					{!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre de proveedor']) !!}
				</div>
				<button type="submit" class="btn btn-success">Buscar</button>
			{!! Form::close() !!}
		</div>
    <table class="table">
			<thead>
				<th>Nombre de proveedor</th>
        <th>Nombre de encargado</th>
				<th>Apellidos</th>
				<th>Teléfonos</th>
				<th>Correo</th>
				<th colspan="2">Acciones</th>
			</thead>
			@foreach($providers as $provider)
			<tbody>
        <td>{{$provider->nombre}}</td>
        <td>{{$provider->nombre_encargado}}</td>
        <td>{{$provider->apellidos}}</td>
        <td>{{'Celular: '.$provider->telefono_celular.',Oficina: '.$provider->telefono_oficina}}</td>
        <td>{{$provider->correo}}</td>
				<td>{!!Form::model($provider,['route'=>['provider.destroy',$provider->id],'method'=>'DELETE'])!!}
						<button  type="submit" onclick="return confirm('¿Realmente desea eliminar registro?')" class="btn btn-danger">Eliminar</button>
				 {!!Form::close()!!}</td>
				<td>{!!link_to_route('provider.edit', $title = 'Editar', $parameters = $provider->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
    {!! $providers->render() !!}
	</div>
@stop
