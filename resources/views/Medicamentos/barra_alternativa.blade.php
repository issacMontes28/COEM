@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/date')!!}">Menú Citas</a>
@stop
@section('tercerlink')
  <a href="{!!URL::to('/date/bitacora_options')!!}">Menú mostrar bitácora</a>
@stop
@section('cuartolink')
  <li>
      <a href="{!!URL::to('/')!!}">Cerrar cesión</a>
  </li>
@stop
