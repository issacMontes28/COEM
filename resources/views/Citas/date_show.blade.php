@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Citas.forms.barra')
@section('content')
  @include('alerts.errors')
  @include('alerts.request')
  <?php $message=Session::get('message')?>
  @if(Session::has('message'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
  </div>
  @endif
	<div class="container">
    <div class="panel-body">
      {!! Form::open(['route'=>'date.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('fecha_1','Buscar citas por fecha:')!!}
          {!! Form::date('fecha1',null, ['class'=>'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
  </div>
    <div class="panel-body">
      {!! Form::open(['route'=>'paciente_cita',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('nombre_1','Buscar citas por paciente:')!!}
          <select name="id_paciente" class="form-control">
            <option>Seleccione paciente</option>
          <?php
        		foreach ($pacients as $pacient) {
        	?>
        		<option value="<?php echo $pacient->id ?>"><?php echo $pacient->apaterno.' '.$pacient->amaterno.' '.$pacient->nombre ;?></option>
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
				<th>Paciente</th>
        <th>Fecha de consulta (AA-MM-DD)</th>
				<th>Hora acordada (Formato de 24 hrs)</th>
				<th>Área a la que asiste</th>
        <th>Tipo de consulta</th>
        <th>Doctor que atiende</th>
        <th colspan="3">Acciones</th>
			</thead>
			@foreach($dates as $date)
        <?php
          $mysqli = new mysqli("localhost", "root", "", "coem");
          if ($mysqli->connect_errno) {
              echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
          }
          $acentos = $mysqli->query("SET NAMES 'utf8'");
          //obtenemos el id de la cita
          $id_paciente=$date->id_paciente;
          //se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
          $query = $mysqli->query("select * from pacients where id='$id_paciente'");
          $fila = $query->fetch_assoc();
          $pac = $fila['nombre'].' '.$fila['apaterno'].' '.$fila['amaterno'];

          $id_doctor = $date->id_doctor;
        	$query2 = $mysqli->query("select * from doctors where id='$id_doctor'");
        	$fila2 = $query2->fetch_assoc();
        	$ndoc = $fila2['nombre'].' '.$fila2['apaterno'].' '.$fila2['amaterno'];

          $tipo = $date->tipo_cita;
          $query3 = $mysqli->query("select * from medicaments where id='$tipo'");
          $fila3 = $query3->fetch_assoc();
        ?>
			<tbody>
				<td><?php echo $pac; ?></td>
        <td>{{$date->fecha}}</td>
				<td>{{$date->hora}}</td>
				<td>{{$date->division}}</td>
				<td><?php echo $fila3['nombre']; ?></td>
        <td><?php echo $ndoc; ?></td>
        <td>{!!Form::model($date,['route'=>['date.destroy',$date->id],'method'=>'DELETE'])!!}
            <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro?')" class="btn btn-danger">Eliminar</button>
        <td>{!!link_to_route('date.edit', $title = 'Editar', $parameters = $date->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
          <td>{!!link_to_route('asignar_venta_cita', $title = 'Venta', $parameters = $date->id,
            $attributes = ['class'=>'btn btn-info', 'style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
    {!!$dates->render()!!}
	</div>
@stop
