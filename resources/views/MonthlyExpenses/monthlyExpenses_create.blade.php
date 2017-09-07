@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Expenses.forms.barra_create')
@section('content')
    <div class="container">
   {!!Form::open()!!}
        <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token"></input>
          @include('MonthlyExpenses.forms.MonthlyExpense')
      	<button id="btnAgregar" data-bind="click: $root.agregarGastoMensual"  class="btn btn-success">Registrar gastos</button>
    {!!Form::close()!!}
  </div>
  @section('js')
    {!!Html::script('js/gastos.js')!!}
  @stop
@stop
