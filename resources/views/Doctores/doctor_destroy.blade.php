@extends('layouts.principal')
@include('Doctores.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($user,['route'=>['doctor.destroy',$user->id],'method'=>'DELETE'])!!}
      @include('Doctores.forms.user')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
