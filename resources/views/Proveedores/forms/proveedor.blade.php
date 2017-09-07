  <div class="form-group">
  {!!Form::label('nombre_1','Nombre de proveedor:')!!}
  {!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de nuevo proveedor'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('nombre_encargado_1','Nombre de encargado:')!!}
  {!!Form::text('nombre_encargado',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de encargado de proveedor'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('apaterno_1','Apellidos de encargado:')!!}
  {!!Form::text('apellidos',null,['class'=>'form-control', 'placeholder'=>'Ingrese apellidos de encargado'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('telefono_celular_1','Telefono celular:')!!}
  {!!Form::number('telefono_celular',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono celular'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('telefono_oficina_1','Telefono de oficina (opcional):')!!}
  {!!Form::number('telefono_oficina',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono de oficina'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('correo_1','Correo:')!!}
  {!!Form::email('correo',null,['class'=>'form-control', 'placeholder'=>'Ingrese correo de encargado'])!!}
  </div>
