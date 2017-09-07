@extends('layouts.principal')
@section('content')
@include('Promotions.forms.barra')
<div class="container">
<!-- Begin Blog Grid -->
<div class="blog-wrap">
<!-- Begin Blog -->
<div class="blog-grid masonry">
  <div class="post format-image box masonry-brick">
    <table class="table">
      <tr>
        <td>
          <div class="frame">
            <a href="{!!URL::to('/promotion/create')!!}">
              <img src="{{ asset('imagenes_menu/ofertas_concepto_agregar.png') }}" alt="" height="150" />
            </a>
          </div>
        <h4 class="title"><a href="{!!URL::to('/promotion/create')!!}">Agregar promociones</a></h4>
        </td>
        <td>
          <div class="frame">
            <a href="{!!URL::to('/promotionProduct/create')!!}">
              <img src="{{ asset('imagenes_menu/ofertas_productos_agregar.png') }}" alt="" height="150" />
            </a>
          </div>
          <h4 class="title"><a href="{!!URL::to('/promotionProduct/create')!!}">Asignar productos a una promoción</a></h4>
        </td>
      </tr>
    </table>
  </div>
  </div>
  </div>
  </div>
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
