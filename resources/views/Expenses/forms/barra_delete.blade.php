@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/expense')!!}">Menú Gastos</a>
@stop
@section('tercerlink')
  <a href="{!!URL::to('/expense/delete_options')!!}">M. Eliminar gastos</a>
@stop
@section('cuartolink')
  <li>
      <a href="{!!URL::to('/')!!}">Cerrar sesión</a>
  </li>
@stop
