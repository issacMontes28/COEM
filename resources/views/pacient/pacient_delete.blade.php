@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
<?php $message=Session::get('message')?>
@include('pacient.forms.barra')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')
	<div class="container">
    <div class="panel-body">
      {!! Form::open(['route'=>'pacient.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre de paciente']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
		<table class="table">
      <thead>
				<th>Nombre</th>
        <th>Fecha de nacimiento (AA-MM-DD)</th>
				<th>Dirección</th>
				<th>Teléfonos</th>
        <th>Correo</th>
				<th>Fecha de inicio</th>
        <th>Peso</th>
        <th>Fecha tentativa de salida</th>
        <th>Acción</th>
			</thead>
			@foreach($pacients as $pacient)
			<tbody>
				<td>{{$pacient->nombre.' '.$pacient->apaterno.' '.$pacient->amaterno}}</td>
        <td>{{$pacient->fecha_nac}}</td>
				<td>{{$pacient->calle.', Numero '.$pacient->num_ext.' ,Número interior: '.$pacient->num_int.', colonia: '.$pacient->colonia.' ,código postal: '.$pacient->cp.', localidad: '.$pacient->localidad.' , municipio: '.$pacient->municipio.' , estado: '.$pacient->estado}}</td>
				<td>{{'Casa: '.$pacient->telefono_casa.' ,Celular: '.$pacient->telefono_celular.',Oficina: '.$pacient->telefono_oficina}}</td>
				<td>{{$pacient->correo}}</td>
				<td>{{$pacient->fecha_inicio}}</td>
        <td>{{$pacient->kilos}}</td>
        <td>{{$pacient->fecha_fin}}</td>
        <td>{!!Form::model($pacient,['route'=>['pacient.destroy',$pacient->id],'method'=>'DELETE'])!!}
           <button type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
		@endforeach
		</table>
    {!!$pacients->render()!!}
	</div>
@stop
