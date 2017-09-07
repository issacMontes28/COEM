@extends('layouts.principal_uno')
@section('content')
  @include('alerts.success')
  @include('alerts.errors')
  @include('alerts.request')
  <?php $message=Session::get('message');  $message2=Session::get('message2');?>
    <div class="container">

    <!-- Begin Blog Grid -->
    <div class="blog-wrap">
    <!-- Begin Blog -->
    <div class="blog-grid masonry">

    <!-- Begin Image Format -->
    <div class="post format-image box masonry-brick">
      <table class="table">
        <tr>
          <td align="center">
            <div class="frame">
              <a href="{!!URL::to('/doctor')!!}">
                <img src="imagenes_menu/doctor.ico" alt="" height="150" />
              </a>
            </div>
            <h3 class="title"><a href="{!!URL::to('/doctor')!!}">Doctores</a></h3>
          </td>
          <td align="center">
            <div class="frame">
              <a href="{!!URL::to('/pacient')!!}">
                <img src="imagenes_menu/paciente.png" alt="" height="150" />
              </a>
            </div>
            <h3 class="title"><a href="{!!URL::to('/pacient')!!}">Pacientes</a></h3>
          </td>
          <td align="center">
            <div class="frame">
              <a href="{!!URL::to('/medicament')!!}">
                <img src="imagenes_menu/medicamento.png" alt="" height="150" />
              </a>
            </div>
            <h3 class="title"><a href="{!!URL::to('/medicament')!!}">Productos</a></h3>
          </td>
        </tr>
        <tr>
          <td align="center">
            <div class="frame">
              <a href="{!!URL::to('/user')!!}">
                <img src="imagenes_menu/usuario.png" alt="" height="150" />
              </a>
            </div>
            <h3 class="title"><a href="{!!URL::to('/user')!!}">Usuarios</a></h3>
          </td>
          <td align="center">
            <div class="frame">
              <a href="{!!URL::to('/date')!!}">
                <img src="imagenes_menu/citas.png" alt="" height="150" />
              </a>
            </div>
            <h3 class="title"><a href="{!!URL::to('/date')!!}">Consultas</a></h3>
          </td>
          <td align="center">
            <div class="frame">
              <a href="{!!URL::to('/sale')!!}">
                <img src="imagenes_menu/ventas.png" alt="" height="150" />
              </a>
            </div>
            <h3 class="title"><a href="{!!URL::to('/sale')!!}">Ventas</a></h3>
          </td>
        </tr>
      </table>
    </div>

    @if(Auth::user()->tipo_usuario=="administrador")
      <!-- Begin Image Format -->
      <div class="post format-image box masonry-brick">
        <table class="table">
          <tr>
            <td colspan="3">
              <di3 class="frame">
                <a href="{!!URL::to('/expense')!!}">
                  <img src="imagenes_menu/contabilidad.png" alt="" height="150" />
                </a>
              </div>
              <h3 class="title"><a href="{!!URL::to('/expense')!!}">Contabilidad y Reportes</a></h3>
            </td>
          </tr>
        </table>
      </div>
    @endif

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
    {!!Html::script('js/jquery.min.js')!!}
    <!-- Bootstrap Core JavaScript -->
    {!!Html::script('js/bootstrap.min.js')!!}

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
@stop
