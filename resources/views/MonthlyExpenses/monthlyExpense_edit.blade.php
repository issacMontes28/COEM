@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('expenses.forms.barra_update')
@include('alerts.request')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($monthlyExpense,['route'=>['monthlyExpense.update',$monthlyExpense->id],'method'=>'PUT'])!!}
   @include('MonthlyExpenses.forms.monthlyExpense2')
      <button  type="submit" onclick="return confirm('¿Guardar cambios en el registro?')"
      class="btn btn-primary">Modificar</button>
    {!!Form::close()!!}
  </div>
@stop
