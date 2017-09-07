@extends('layouts.crud')
@include('expenses.forms.barra')
@section('crud')
      @section('titulo1')
          <a href="{!!URL::to('/expense/create_options')!!}">
      @stop
        @section('subtitulo1')
          <h4 class="title"><a href="{!!URL::to('/expense/create_options')!!}">Agregar nuevo gasto</a></h4>
        @stop
      @section('titulo2')
          <a href="{!!URL::to('/expense/delete_options')!!}">
      @stop
        @section('subtitulo2')
          <h4 class="title"><a href="{!!URL::to('/expense/delete_options')!!}">Eliminar gasto de la base de datos</a></h4>
        @stop
      @section('titulo3')
          <a href="{!!URL::to('/expense/actualizar_options')!!}">
      @stop
        @section('subtitulo3')
          <h4 class="title"><a href="{!!URL::to('/expense/actualizar_options')!!}">Actualizar datos de gasto</a></h4>
        @stop
      @section('titulo4')
          <a href="{!!URL::to('/expense/show_options')!!}">
      @stop
        @section('subtitulo4')
          <h4 class="title"><a href="{!!URL::to('/expense/show_options')!!}">Mostrar aspectos contables y generar reportes</a></h4>
@stop
