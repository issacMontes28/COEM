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
      {!! Form::open(['route'=>'date_action.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('fecha_1','Buscar consecutivos por fecha:')!!}
          {!! Form::date('fecha1',null, ['class'=>'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
    <div class="panel-body">
      {!! Form::open(['route'=>'paciente_bitacora',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('nombre_1','Buscar consecutivos por paciente:')!!}
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
				<th>Cita</th>
        <th>Fecha(AA-MM-DD)</th>
				<th>Cambios en consulta</th>
				<th>Asistecia</th>
        <th>Nota</th>
        <th>Peso actual</th>
        <th>Kilos bajados</th>
				<th>Cintura actual</th>
				<th>Cms reducidos</th>
        <th>Cadera Actual</th>
        <th>Cms reducidos</th>
			</thead>
			@foreach($dates as $date)
      <?php
          $mysqli = new mysqli("localhost", "root", "", "coem");
          if ($mysqli->connect_errno) {
              echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
          }
          $acentos = $mysqli->query("SET NAMES 'utf8'");
          //obtenemos el id de la cita
          $id_cita=$date->id_cita;
          //se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
          $query = $mysqli->query("select * from dates where id='$id_cita'");
          $fila = $query->fetch_assoc();
          $id_pac = $fila['id_paciente'];
          $fecha  = $fila['fecha'];

          //se obtienen los datos del paciente, el nombre y el doctor
          $query = $mysqli->query("select * from pacients where id='$id_pac'");
          $fila_pac = $query->fetch_assoc();
          $pac = 'Paciente: '.$fila_pac['nombre'].' '.$fila_pac['apaterno'].' '.$fila_pac['amaterno'];
          $id_doc = $date->id_doctor;

          //se obtienen los datos del doctor
          $query = $mysqli->query("select * from doctors where id='$id_doc'");
          $fila_doc = $query->fetch_assoc();

      ?>
			<tbody>
				<td><?php echo $pac; ?></td>
        <td>{{$fecha}}</td>
				<td>{{$date->modificaciones}}</td>
				<td>{{$date->asistencia}}</td>
				<td>{{$date->nota}}</td>
        <td>{{$date->peso_actual}}</td>
				<td>{{$date->peso_dif}}</td>
				<td>{{$date->cintura_actual}}</td>
        <td>{{$date->cintura_dif}}</td>
				<td>{{$date->cadera_actual}}</td>
				<td>{{$date->cadera_dif}}</td>
		@endforeach
		</table>
    <table>
      <tr><td><strong>Nota: un numero negativo en las medidas de cadera, cintura y peso indican hubo un aumento en las mismas</strong></td></tr>
    </table>
    		{!!$dates->render()!!}
	</div>
@stop
