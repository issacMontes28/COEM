  <div class="form-group">
  {!!Form::label('nombre_1','Nombre:')!!}
  {!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de nuevo doctor'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('apaterno_1','Primer apellido:')!!}
  {!!Form::text('apaterno',null,['class'=>'form-control', 'placeholder'=>'Ingrese apellido paterno de doctor'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('amaterno_1','Segundo apellido:')!!}
  {!!Form::text('amaterno',null,['class'=>'form-control', 'placeholder'=>'Ingrese apellido materno de doctor'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('telefono_casa_1','Telefono de casa (opcional):')!!}
  {!!Form::number('telefono_casa',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono de casa'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('telefono_celular_1','Telefono celular (opcional):')!!}
  {!!Form::number('telefono_celular',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono celular'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('telefono_oficina_1','Telefono de oficina (opcional):')!!}
  {!!Form::number('telefono_oficina',null,['class'=>'form-control', 'placeholder'=>'Ingrese telefono de oficina'])!!}
  </div>
  <div class="form-group">
  {!!Form::label('correo_1','Correo:')!!}
  {!!Form::email('correo',null,['class'=>'form-control', 'placeholder'=>'Ingrese correo de doctor'])!!}
  </div>
