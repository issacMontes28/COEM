@extends('layouts.crud_ventas')
@include('Ventas.forms.barra')
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/sale/create_options')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/sale/create_options')!!}">Agregar venta</a></h4>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/sale/deleter')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/sale/deleter')!!}">Eliminar ventas</a></h4>
    @stop
  @section('titulo4')
  <a href="{!!URL::to('/sale/show')!!}">
  @stop
    @section('subtitulo4')
      <h4 class="title"><a href="{!!URL::to('/sale/show')!!}">Mostrar ventas</a></h4>
  @stop
  @section('titulo5')
  <a href="{!!URL::to('/promotion')!!}">
  @stop
    @section('subtitulo5')
      <h4 class="title"><a href="{!!URL::to('/promotion')!!}">Promociones</a></h4>
  @stop
@stop
