@extends('layouts.crud')
@include('Citas.forms.barra')
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/date/create')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/date/create')!!}">Agregar nueva consulta</a></h4>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/date/deleter')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/date/deleter')!!}">Eliminar consulta de la base de datos</a></h4>
    @stop
  @section('titulo3')
  <a href="{!!URL::to('/date/actualizar')!!}">
  @stop
    @section('subtitulo3')
      <h4 class="title"><a href="{!!URL::to('/date/actualizar')!!}">Actualizar datos de consulta</a></h4>
    @stop
  @section('titulo4')
  <a href="{!!URL::to('/date/show')!!}">
  @stop
    @section('subtitulo4')
      <h4 class="title"><a href="{!!URL::to('/date/show')!!}">Consultas diarias</a></h4>
  @stop
  @section('adicional')
    @include('Citas.forms.bitacora')
  @stop
@stop
