@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('expenses.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($expense,['route'=>['expense.destroy',$expense->id],'method'=>'DELETE'])!!}
      @include('expenses.forms.expense')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
