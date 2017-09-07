@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Promotions.forms.barra_create')
@include('alerts.request')
  @section('content')
    <div class="container">
   {!!Form::open(['route'=>'promotion.store', 'method'=>'POST','files' => true])!!}
        @include('promotions.forms.promotion')
      {!!Form::submit('Registrar',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
@stop
