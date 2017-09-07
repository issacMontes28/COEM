@extends('layouts.principal')
@include('Proveedores.forms.barra')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'provider.store', 'method'=>'POST','files' => true])!!}
        @include('Proveedores.forms.proveedor')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
