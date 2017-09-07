@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('expenses.forms.barra_create')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'expense.store', 'method'=>'POST','files' => true])!!}
        @include('expenses.forms.expense')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
