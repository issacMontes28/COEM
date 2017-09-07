@extends('layouts.principal')
@include('Medicamentos.forms.barra')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($medicament,['route'=>['medicament.update',$medicament->id],'method'=>'PUT','files' => true])!!}
      @include('Medicamentos.forms.medicament_edit')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
