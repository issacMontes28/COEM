<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clínica de Obesidad y Enfermedades Metabólicas Oficial</title>

    <!-- Bootstrap Core CSS -->
    {!!Html::style('css/business-casual.css')!!}
    {!!Html::style('css/tcal.css')!!}
    @yield('tabla')

    <!-- Custom CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::script('js/jquery-1.9.0.min.js')!!}
    {!!Html::script('js/bootstrap-tooltip.js')!!}
    {!!Html::script('js/bootstrap-popover.js')!!}
    {!!Html::script('js/bootstrap-confirmation.js')!!}
    {!!Html::script('js/tcal.js')!!}
    {!!Html::script('js/jquery.masonry.min.js')!!}

    <!-- Fonts -->
    {!!Html::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800')!!}
    {!!Html::style('http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic')!!}

</head>

<body>
  <div class="brand">Clínica COEM</div>
  <div class="address-bar">Teopanzolco 408-102B | Col. Reforma | 62260 Cuernavaca</div>
  <!-- Navigation -->
  <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <ul class="nav navbar-top-links navbar-right">
           <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  {!!Auth::user()->nombre!!}<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                  <li><a href="{!!URL::to('/logout')!!}"><i class="fa fa-sign-out fa-fw"></i>Cerrar sesión</a>
                  </li>
              </ul>
          </li>
        </ul>
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
              <a class="navbar-brand" href="index.html">Clínica COEM</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li>
                      @yield('primerlink')
                  </li>
                  <li>
                      @yield('segundolink')
                  </li>
                  <li>
                      @yield('tercerlink')
                  </li>
                    @yield('cuartolink')
                    @yield('quintolink')
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>
  @yield('content')
</body>
{!!Html::script('js/jquery-1.9.0.min.js')!!}
{!!Html::script('js/knockout-3.4.0.js')!!}
@yield('js')
</html>
