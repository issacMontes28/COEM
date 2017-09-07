@extends('layouts.sales_create_options')
@include('Ventas.forms.barra')
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/sale/create')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/sale/create')!!}">Agregar nueva venta facturando cita y productos</a></h2>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/sale/create_venta_cliente')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/sale/create_venta_cliente')!!}">Agregar nueva venta facturando unicamente productos</a></h2>
    @stop
@stop
