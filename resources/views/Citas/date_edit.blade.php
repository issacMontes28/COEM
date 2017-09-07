@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Citas.forms.barra')
@section('content')
@include('alerts.request')
    <div class="container">
   {!!Form::model($date,['route'=>['date.update',$date->id],'method'=>'PUT'])!!}
      @include('Citas.forms.date_edit')
      @include('Citas.forms.eliminar')
       <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
       class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
