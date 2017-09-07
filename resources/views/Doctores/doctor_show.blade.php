@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Doctores.forms.barra')
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
      {!! Form::open(['route'=>'doctor.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre de doctor']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
		<table class="table">
      <thead>
				<th>Nombre</th>
				<th>Teléfonos</th>
				<th>Correo</th>
        <th colspan="2">Accciones</th>
			</thead>
			@foreach($doctors as $doctor)
			<tbody>
        <td>{{$doctor->nombre.' '.$doctor->apaterno.' '.$doctor->amaterno}}</td>
        <td>{{'Casa: '.$doctor->telefono_casa.' ,Celular: '.$doctor->telefono_celular.',Oficina: '.$doctor->telefono_oficina}}</td>
        <td>{{$doctor->correo}}</td>
        <td>{!!Form::model($doctor,['route'=>['doctor.destroy',$doctor->id],'method'=>'DELETE'])!!}
           <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
        <td>{!!link_to_route('doctor.edit', $title = 'Editar', $parameters = $doctor->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
    {!!$doctors->render()!!}
	</div>
@stop
