@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Usuarios.forms.barra')
@include('alerts.request')
<?php $message=Session::get('message')?>

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')
	<div class="container">
    <div class="panel-body">
      {!! Form::open(['route'=>'user.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre de usuario']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
		<table class="table">
			<thead>
        <thead>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Contraseña</th>
          <th>Acción</th>
			</thead>
			@foreach($users as $user)
			<tbody>
        <td>{{$user->nombre}}</td>
        <td>{{$user->apellidos}}</td>
        <td>{{$user->telefono}}</td>
        <td>{{$user->correo}}</td>
        <td>{{$user->password}}</td>
        <td>{!!link_to_route('user.edit', $title = 'Editar', $parameters = $user->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
    {{$users->render()}}
	</div>
@stop
