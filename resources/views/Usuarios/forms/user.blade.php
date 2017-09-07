  <div class="form-group">
  {!!Form::label('nombre_1','Nombre:')!!}
  {!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de nuevo usuario'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('apellidos_1','Apellidos:')!!}
  {!!Form::text('apellidos',null,['class'=>'form-control', 'placeholder'=>'Ingrese apellidos paterno de usuario'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('telefono_1','Telefono:')!!}
  {!!Form::text('telefono',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono de usuario'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('correo_1','Correo:')!!}
  {!!Form::text('correo',null,['class'=>'form-control', 'placeholder'=>'Ingrese correo del usuario'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('usuario_1','Tipo de usuario:')!!}
  <select name="tipo_usuario">
    @if(Auth::user()->tipo_usuario=="administrador")
      <option value="administrador">Administrador</option>
    @endif
  <option value="usuario">Usuario</option>
  </select>
  <div class="form-group">
  {!!Form::label('password_1','Password:')!!}
  {!!Form::password('password',null,['class'=>'form-control', 'placeholder'=>'Ingrese password'])!!}
  </div>
