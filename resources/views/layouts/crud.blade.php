@extends('layouts.principal')
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
        <td>
          <div class="frame">
            @yield('titulo1')
              <img src="{{ asset('imagenes_menu/agregar.png') }}" alt="" height="150" />
            </a>
              @yield('subtitulo1')
          </div>
        </td>
        <td>
          <div class="frame">
            @yield('titulo2')
              <img src="{{ asset('imagenes_menu/eliminar.png') }}" alt="" height="150" />
            </a>
          </div>
          @yield('subtitulo2')
        </td>
      </tr>
      <tr>
        <td>
          <div class="frame">
            @yield('titulo3')
              <img src="{{ asset('imagenes_menu/actualizar.png') }}" alt="" height="150" />
            </a>
          </div>
          @yield('subtitulo3')
        </td>
        <td>
          <div class="frame">
            @yield('titulo4')
              <img src="{{ asset('imagenes_menu/listar.png') }}" alt="" height="150" />
            </a>
          </div>
          @yield('subtitulo4')
        </td>
      </tr>
      <tr>
        <td>
        @yield('adicional')
        </td>
      </tr>
      <tr>
        <td>
        @yield('adicional_2')
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

  <!-- Script to Activate the Carousel -->
  <script>
  $('.carousel').carousel({
      interval: 5000 //changes the speed
  })
  </script>
@stop
