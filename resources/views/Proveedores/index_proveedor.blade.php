@extends('layouts.crud')
@include('Proveedores.forms.barra')
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/provider/create')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/provider/create')!!}">Agregar nuevo proveedor</a></h4>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/provider/deleter')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/provider/deleter')!!}">Eliminar proveedor de los registros</a></h4>
    @stop
  @section('titulo3')
  <a href="{!!URL::to('/provider/actualizar')!!}">
  @stop
    @section('subtitulo3')
      <h4 class="title"><a href="{!!URL::to('/provider/actualizar')!!}">Actualizar datos de proveedor</a></h4>
    @stop
  @section('titulo4')
    <a href="{!!URL::to('/provider/show')!!}">
  @stop
    @section('subtitulo4')
      <h4 class="title"><a href="{!!URL::to('/provider/show')!!}">Mostrar todos los registros de proveedor</a></h4>
@stop
