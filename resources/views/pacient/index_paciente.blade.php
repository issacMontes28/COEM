@extends('layouts.crud')
@include('pacient.forms.barra')
@section('crud')
      @section('titulo1')
          <a href="{!!URL::to('/pacient/create')!!}">
      @stop
        @section('subtitulo1')
          <h4 class="title"><a href="{!!URL::to('/pacient/create')!!}">Agregar nuevo paciente</a></h4>
        @stop
      @section('titulo2')
          <a href="{!!URL::to('/pacient/deleter')!!}">
      @stop
        @section('subtitulo2')
          <h4 class="title"><a href="{!!URL::to('/pacient/deleter')!!}">Eliminar paciente de la base de datos</a></h4>
        @stop
      @section('titulo3')
          <a href="{!!URL::to('/pacient/actualizar')!!}">
      @stop
        @section('subtitulo3')
          <h4 class="title"><a href="{!!URL::to('/pacient/actualizar')!!}">Actualizar datos de paciente</a></h4>
        @stop
      @section('titulo4')
          <a href="{!!URL::to('/pacient/show')!!}">
      @stop
        @section('subtitulo4')
          <h4 class="title"><a href="{!!URL::to('/pacient/show')!!}">Mostrar todos los registros de pacientes</a></h4>
@stop
