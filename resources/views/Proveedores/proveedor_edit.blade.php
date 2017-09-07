@extends('layouts.principal')
@include('Proveedores.forms.barra')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($provider,['route'=>['provider.update',$provider->id],'method'=>'PUT'])!!}
      @include('Proveedores.forms.proveedor')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
