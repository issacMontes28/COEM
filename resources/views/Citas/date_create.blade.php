@extends('layouts.principal')
@include('Citas.forms.barra')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'date.store', 'method'=>'POST','files' => true])!!}
        @include('Citas.forms.date')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
