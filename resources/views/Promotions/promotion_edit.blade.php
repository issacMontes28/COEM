@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Promotions.forms.barra')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($promotion,['route'=>['promotion.update',$promotion->id],'method'=>'PUT'])!!}
      @include('promotions.forms.promotion')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
