@extends('layouts.principal')
@include('pacient.forms.barra')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'pacient.store', 'method'=>'POST','files' => true])!!}
        @include('pacient.forms.pacient')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
    </div>
@stop
