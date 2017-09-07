@extends('layouts.principal')
@include('Medicamentos.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($medicament,['route'=>['medicament.destroy',$medicament->id],'method'=>'DELETE'])!!}
      @include('Medicamentos.forms.medicament')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
