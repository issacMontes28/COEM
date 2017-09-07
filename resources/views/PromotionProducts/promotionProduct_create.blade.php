@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('PromotionProducts.forms.barra_create')
@section('content')
    <div class="container">
   {!!Form::open()!!}
        <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token"></input>
          @include('PromotionProducts.forms.PromotionProduct')
    {!!Form::close()!!}
  </div>
  @section('js')
    {!!Html::script('js/promociones.js')!!}
  @stop
@stop
