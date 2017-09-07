@extends('layouts.crud')
@include('Usuarios.forms.barra')
@section('primerlink')
  <a href="{!!URL::to('/')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('User/')!!}">Menú Doctores</a>
@stop
@section('tercerlink')
  <a href="contact.html">Cerrar Sesión</a>
@stop
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/user/create')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/user/create')!!}">Agregar nuevo usuario</a></h4>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/user/deleter')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/user/deleter')!!}">Eliminar usuario de la base de datos</a></h4>
    @stop
  @section('titulo3')
  <a href="{!!URL::to('/user/actualizar')!!}">
  @stop
    @section('subtitulo3')
      <h4 class="title"><a href="{!!URL::to('/user/actualizar')!!}">Actualizar datos de usuario</a></h4>
    @stop
  @section('titulo4')
    <a href="{!!URL::to('/user/show')!!}">
  @stop
    @section('subtitulo4')
      <h4 class="title"><a href="{!!URL::to('/user/show')!!}">Mostrar todos los registros de usuario</a></h4>
@stop
