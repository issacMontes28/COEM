@extends('layouts.principal')
@include('Usuarios.forms.barra')
@section('content')
  @section('content')
    <div class="container">
   {!!Form::model($user,['route'=>['user.destroy',$user->id_usuario],'method'=>'DELETE'])!!}
      @include('usuarios.forms.user')
      {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    {!!Form::close()!!}
  </div>
@stop
