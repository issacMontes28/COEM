@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Ventas.forms.barra')
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
      {!! Form::open(['route'=>'sale.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('fecha_1','Buscar ventas por fecha:')!!}
          {!! Form::date('fecha1',null, ['class'=>'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
    <div class="panel-body">
      {!! Form::open(['route'=>'ventas_paciente',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!!Form::label('nombre_1','Buscar ventas por paciente:')!!}
          <select name="cliente1" class="form-control">
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
				<th>Cliente</th>
        <th>Producto</th>
				<th>Cantidad</th>
				<th>Fecha</th>
        <th>Número de factura</th>
        <th>Forma de pago</th>
        <th>Acción</th>
			</thead>
			@foreach($sales as $sale)
      <?php
          $mysqli = new mysqli("localhost", "root", "", "coem");
          if ($mysqli->connect_errno) {
              echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
          }
          $acentos = $mysqli->query("SET NAMES 'utf8'");
          //obtenemos el id de la cita
          $id_cliente=$sale->id_cliente;
          //se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
          $query = $mysqli->query("select * from pacients where id='$id_cliente'");
          $fila_pac = $query->fetch_assoc();
          $pac = $fila_pac['nombre'].' '.$fila_pac['apaterno'].' '.$fila_pac['amaterno'];

          $id_producto = $sale->id_producto;
          $query = $mysqli->query("select * from medicaments where id='$id_producto'");
          $fila_producto = $query->fetch_assoc();

      ?>
			<tbody>
				<td><?php echo $pac; ?></td>
        <td><?php echo $fila_producto['nombre']; ?></td>
				<td>{{$sale->cantidad}}</td>
				<td>{{$sale->fecha}}</td>
				<td>{{$sale->nfactura}}</td>
        <td>{{$sale->forma_pago}}</td>
        <td>{!!Form::model($sale,['route'=>['sale.destroy',$sale->id],'method'=>'DELETE'])!!}
           <button  type="submit" onclick="return confirm('¿Realmente desea eliminar el registro de venta?')" class="btn btn-danger">Eliminar</button>
         {!!Form::close()!!}</td>
		@endforeach
		</table>
    		{!!$sales->render()!!}
	</div>
@stop
