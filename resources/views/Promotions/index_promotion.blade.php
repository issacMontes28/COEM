@extends('layouts.crud')
@include('Promotions.forms.barra')
@section('crud')
      @section('titulo1')
          <a href="{!!URL::to('/promotion/create')!!}">
      @stop
        @section('subtitulo1')
          <h4 class="title"><a href="{!!URL::to('/promotion/create')!!}">Agregar nueva promoción</a></h4>
        @stop
      @section('titulo2')
          <a href="{!!URL::to('/promotion/delete_options')!!}">
      @stop
        @section('subtitulo2')
          <h4 class="title"><a href="{!!URL::to('/promotion/delete_options')!!}">Eliminar promoción de la base de datos</a></h4>
        @stop
      @section('titulo3')
          <a href="{!!URL::to('/promotion/actualizar_options')!!}">
      @stop
        @section('subtitulo3')
          <h4 class="title"><a href="{!!URL::to('/promotion/actualizar_options')!!}">Actualizar datos de promoción</a></h4>
        @stop
      @section('titulo4')
          <a href="{!!URL::to('/promotion/show_options')!!}">
      @stop
        @section('subtitulo4')
          <h4 class="title"><a href="{!!URL::to('/promotion/show_options')!!}">Mostrar promociones</a></h4>
@stop
