@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/sale')!!}">Menú ventas</a>
@stop
@section('tercerlink')
  <a href="{!!URL::to('/sale/create_options')!!}">Menú crear venta</a>
@stop
@section('cuartolink')
  <li>
      <a href="{!!URL::to('/')!!}">Cerrar sesión</a>
  </li>
@stop
