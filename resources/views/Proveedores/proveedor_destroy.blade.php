@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Proveedores.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($provider,['route'=>['provider.destroy',$provider->id],'method'=>'DELETE'])!!}
      @include('Proveedores.forms.user')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
