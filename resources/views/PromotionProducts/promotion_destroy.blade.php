@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Promotions.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($promotion,['route'=>['promotion.destroy',$promotion->id],'method'=>'DELETE'])!!}
      @include('promotions.forms.promotion')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
