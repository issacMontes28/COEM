@extends('layouts.crud')
@include('Doctores.forms.barra')
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/doctor/create')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/doctor/create')!!}">Agregar nuevo doctor</a></h4>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/doctor/deleter')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/doctor/deleter')!!}">Eliminar doctor de los registros</a></h4>
    @stop
  @section('titulo3')
  <a href="{!!URL::to('/doctor/actualizar')!!}">
  @stop
    @section('subtitulo3')
      <h4 class="title"><a href="{!!URL::to('/doctor/actualizar')!!}">Actualizar datos de doctor</a></h4>
    @stop
  @section('titulo4')
    <a href="{!!URL::to('/doctor/show')!!}">
  @stop
    @section('subtitulo4')
      <h4 class="title"><a href="{!!URL::to('/doctor/show')!!}">Mostrar todos los registros de doctor</a></h4>
@stop
