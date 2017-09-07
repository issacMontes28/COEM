@extends('layouts.principal')
@include('Usuarios.forms.barra')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($user,['route'=>['user.update',$user->id],'method'=>'PUT'])!!}
      @include('usuarios.forms.user')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
