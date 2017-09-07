@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/promotion')!!}">Menú promociones</a>
@stop
@section('tercerlink')
  <a href="{!!URL::to('/promotion/delete_options')!!}">M. Eliminar promociones</a>
@stop
@section('cuartolink')
  <li>
      <a href="{!!URL::to('/')!!}">Cerrar sesión</a>
  </li>
@stop
