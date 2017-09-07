@extends('layouts.principal')
@include('Doctores.forms.barra')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'doctor.store', 'method'=>'POST','files' => true])!!}
        @include('Doctores.forms.doctor')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
