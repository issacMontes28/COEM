@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/medicament')!!}">Menú productos</a>
@stop
@section('tercerlink')
  <a href="{!!URL::to('/medicament/medicament_show_options')!!}">Menú proveedores</a>
@stop
@section('cuartolink')
  <li>
      <a href="{!!URL::to('/')!!}">Cerrar sesión</a>
  </li>
@stop
