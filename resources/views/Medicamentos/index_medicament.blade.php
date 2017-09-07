@extends('layouts.crud')
@include('Medicamentos.forms.barra')
@section('crud')
  @section('titulo1')
  <a href="{!!URL::to('/medicament/create')!!}">
  @stop
    @section('subtitulo1')
      <h4 class="title"><a href="{!!URL::to('/medicament/create')!!}">Agregar nuevo medicamento,producto o servicio</a></h4>
    @stop
  @section('titulo2')
  <a href="{!!URL::to('/medicament/deleter')!!}">
  @stop
    @section('subtitulo2')
      <h4 class="title"><a href="{!!URL::to('/medicament/deleter')!!}">Eliminar producto de la base de datos</a></h4>
    @stop
  @section('titulo3')
  <a href="{!!URL::to('/medicament/actualizar')!!}">
  @stop
    @section('subtitulo3')
      <h4 class="title"><a href="{!!URL::to('/medicament/actualizar')!!}">Actualizar datos de producto</a></h4>
    @stop
  @section('titulo4')
  <a href="{!!URL::to('/medicament/show')!!}">
  @stop
    @section('subtitulo4')
      <h4 class="title"><a href="{!!URL::to('/medicament/show')!!}">Mostrar registros de productos</a></h4>
    @stop
    @section('adicional')
        <div class="frame">
          <a href="{!!URL::to('/provider')!!}">
            <img src="imagenes_menu/proveedor.png" alt="" height="150" />
          </a>
        </div>
        <h4 class="title"><a href="{!!URL::to('/provider')!!}">Proveedores</a></h4>
  @stop
