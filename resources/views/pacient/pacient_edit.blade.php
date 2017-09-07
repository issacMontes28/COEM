@extends('layouts.principal')
@include('pacient.forms.barra')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($pacient,['route'=>['pacient.update',$pacient->id],'method'=>'PUT'])!!}
      @include('pacient.forms.pacient')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
