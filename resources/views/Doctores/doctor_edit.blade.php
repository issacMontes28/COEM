@extends('layouts.principal')
@include('Doctores.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($doctor,['route'=>['doctor.update',$doctor->id],'method'=>'PUT'])!!}
      @include('Doctores.forms.doctor')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
