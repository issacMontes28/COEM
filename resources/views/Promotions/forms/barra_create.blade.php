@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/promotion')!!}">Menú Promociones</a>
@stop
@section('cuartolink')
  <li>
      <a href="{!!URL::to('/')!!}">Cerrar sesión</a>
  </li>
@stop
