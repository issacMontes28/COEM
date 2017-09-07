@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Medicamentos.forms.barra')
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
      {!! Form::open(['route'=>'medicament.show',
        'method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
        <div class="form-group">
          {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Nombre de medicamento']) !!}
        </div>
        <button type="submit" class="btn btn-success">Buscar</button>
      {!! Form::close() !!}
    </div>
		<table class="table">
      <thead>
        <th>Imagen</th>
        <th>Nombre</th>
				<th>Descripcion</th>
        <th>Tipo de producto</th>
				<th>Existencias</th>
				<th>Precio compra</th>
        <th>Precio venta</th>
        <th>Precio venta t.crédito/débito</th>
        <th>Proveedor</th>
        <th>Área de venta</th>
        <th>Acción</th>
			</thead>
			@foreach($medicaments as $medicament)
        <?php
            $mysqli = new mysqli("localhost", "root", "", "coem");
            if ($mysqli->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }
            $acentos = $mysqli->query("SET NAMES 'utf8'");
            //obtenemos el id de la cita
            $id_proveedor=$medicament->id_proveedor;
            //se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
            $query = $mysqli->query("select * from providers where id='$id_proveedor'");
            $fila = $query->fetch_assoc();
            $proveedor = $fila['nombre'];

        ?>
			<tbody>
        <?php
          if ($medicament->imagen != null) {
             $imagen = $medicament->imagen;
          }
          else {
            $imagen = "pastilla.png";
          }
         ?>
        <td><img src="../medicaments_images/{{$imagen}}" width="100px" height="50px"/></td>
        <td>{{$medicament->nombre}}</td>
				<td>{{$medicament->descripcion}}</td>
        <td>{{$medicament->tipo}}</td>
				<td>{{$medicament->existencias}}</td>
				<td>{{$medicament->precio_compra}}</td>
				<td>{{$medicament->precio_venta}}</td>
        <td>{{$medicament->precio_venta_tarjeta}}</td>
        <td><?php echo $proveedor; ?></td>
        <td>{{$medicament->area}}</td>
        <td>{!!link_to_route('medicament.edit', $title = 'Editar', $parameters = $medicament->id,
          $attributes = ['class'=>'btn btn-primary','style'=>"color:#FFFFFF"])!!}</td>
		@endforeach
		</table>
    {!!$medicaments->render()!!}
	</div>
@stop
