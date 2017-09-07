@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('expenses.forms.barra')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($expense,['route'=>['expense.update',$expense->id],'method'=>'PUT'])!!}
      @include('expenses.forms.expense')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
