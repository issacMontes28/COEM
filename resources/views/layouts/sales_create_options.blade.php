@extends('layouts.principal_dos')
@section('content')
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
              <img src="{{ asset('imagenes_menu/citas.png') }}" alt="" height="150" />
            </a>
          </div>
          @yield('subtitulo1')
        </td>
        <td>
          <div class="frame">
            @yield('titulo2')
              <img src="{{ asset('imagenes_menu/paciente.png') }}" alt="" height="150" />
            </a>
          </div>
        @yield('subtitulo2')
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
