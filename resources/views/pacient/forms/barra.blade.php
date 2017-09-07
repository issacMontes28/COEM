@section('primerlink')
  <a href="{!!URL::to('index')!!}">Menú principal</a>
@stop
@section('segundolink')
  <a href="{!!URL::to('/pacient')!!}">Menú Pacientes</a>
@stop
@section('tercerlink')
  <a href="{!!URL::to('/')!!}">Cerrar sesión</a>
@stop
