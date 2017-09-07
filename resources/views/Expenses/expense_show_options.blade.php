@extends('layouts.principal')
@section('content')
@include('Expenses.forms.barra')
<div class="container">
<!-- Begin Blog Grid -->
<div class="blog-wrap">
<!-- Begin Blog -->
<div class="blog-grid masonry">
  <div class="post format-image box masonry-brick">
    <table>
      <tr>
        <td>
          <div class="frame">
            <a href="{!!URL::to('/expense/show_dos')!!}">
              <img src="{{ asset('imagenes_menu/dinero.png') }}" alt="" height="150" />
            </a>
          </div>
        <h4 class="title"><a href="{!!URL::to('/expense/show_dos')!!}">Mostrar gastos hechos y conceptos</a></h2>
        </td>
        <td>
          <div class="frame">
            <a href="{!!URL::to('/monthlyExpense/balance')!!}">
              <img src="{{ asset('imagenes_menu/balanza.png') }}" alt="" height="150" />
            </a>
          </div>
        <h4 class="title"><a href="{!!URL::to('/monthlyExpense/balance')!!}">Ver balance de gastos e ingresos</a></h2>
        </td>
        <td>
          <div class="frame">
            <a href="{!!URL::to('/monthlyExpense/doctors_dates_info')!!}">
              <img src="{{ asset('imagenes_menu/persona.png') }}" alt="" height="150" />
            </a>
          </div>
        <h4 class="title"><a href="{!!URL::to('/monthlyExpense/doctors_dates_info')!!}">Ver información de doctores y citas</a></h2>
        </td>
      </tr>
    </table>
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
