@extends('layouts.principal')
@section('content')
@include('Medicamentos.forms.barra_alternativa')
<div class="container">
<!-- Begin Blog Grid -->
<div class="blog-wrap">
<!-- Begin Blog -->
<div class="blog-grid masonry">
  <div class="post format-image box masonry-brick">
    <div class="frame">
      <a href="{!!URL::to('/medicament/medicament_show_info')!!}">
        <img src="{{ asset('imagenes_menu/mes.png') }}" alt="" height="200" />
      </a>
    </div>
  <h4 class="title"><a href="{!!URL::to('/medicament/medicament_show_info')!!}">Mostrar información de existencias y registro de productos entre fechas dadas</a></h2>
  </div>

  <div class="post format-image box masonry-brick">
    <div class="frame">
      <a href="{!!URL::to('/medicament/show')!!}">
        <img src="{{ asset('imagenes_menu/listar.png') }}" alt="" height="200" />
      </a>
    </div>
  <h4 class="title"><a href="{!!URL::to('/medicament/show')!!}">Mostrar todos los registros de productos</a></h2>
  </div>

  </div>
  </div>
  </div>
  <!-- /.container -->

  <footer>
      <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
                <p>COEM Cuernavaca &copy; 2016</p>
            </div>
          </div>
      </div>
  </footer>

  <!-- jQuery -->
  {!!Html::script('js/jquery.js')!!}
  <!-- Bootstrap Core JavaScript -->
  {!!Html::script('js/bootstrap.min.js')!!}
@stop
