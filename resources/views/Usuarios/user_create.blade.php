@extends('layouts.principal')
@include('Usuarios.forms.barra')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'user.store', 'method'=>'POST','files' => true])!!}
        @include('usuarios.forms.user')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
