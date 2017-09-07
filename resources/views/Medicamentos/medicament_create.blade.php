@extends('layouts.principal')
@include('Medicamentos.forms.barra')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'medicament.store', 'method'=>'POST','files' => true])!!}
        @include('Medicamentos.forms.medicament')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
