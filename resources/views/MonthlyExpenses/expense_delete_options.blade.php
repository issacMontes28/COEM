@extends('layouts.principal')
@section('content')
@include('Expenses.forms.barra')
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
            <a href="{!!URL::to('/expense/deleter')!!}">
              <img src="{{ asset('imagenes_menu/gasto_eliminar.png') }}" alt="" height="150" />
            </a>
          </div>
        <h4 class="title"><a href="{!!URL::to('/expense/deleter')!!}">Eliminar gasto fijo o variable</a></h4>
        </td>
        <td>
          <div class="frame">
            <a href="{!!URL::to('/monthlyExpense/deleter')!!}">
              <img src="{{ asset('imagenes_menu/mes_eliminar.png') }}" alt="" height="150" />
            </a>
          </div>
          <h4 class="title"><a href="{!!URL::to('/monthlyExpense/deleter')!!}">Eliminar gastos hechos</a></h4>
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
