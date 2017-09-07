@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('expenses.forms.barra_delete')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($expense,['route'=>['monthlyExpense.destroy',$expense->id],'method'=>'DELETE'])!!}
      @include('monthlyExpenses.forms.monthlyExpense')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
