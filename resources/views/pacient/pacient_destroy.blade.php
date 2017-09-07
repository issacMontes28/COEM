@extends('layouts.principal')
@include('pacient.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($pacient,['route'=>['pacient.destroy',$pacient->id],'method'=>'DELETE'])!!}
      @include('pacient.forms.user')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
