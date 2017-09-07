<div class="form-group">
  {!!Form::label('motivo_1','Asistencia del paciente:')!!}
  {!!Form::select('asistencia',[
  'El paciente asistió'=>'El paciente asistió',
  'El paciente no asistió por motivo laboral'=>'El paciente no asistió por motivo laboral',
  'El paciente no asistió por motivo personal'=>'El paciente no asistió por motivo personal',
  'El paciente no asistió por motivo de salud'=>'El paciente no asistió por motivo de salud',
  'Otro'=>'Otro (especifíque en "Nota")'
  ],['class'=>'form-control'])!!}
</div>
<div class="form-group">
  {!!Form::label('nota_1','Agregue una nota (opcional):')!!}
  {!!Form::text('nota',null,['class'=>'form-control', 'placeholder'=>'Ingrese una nota'])!!}
</div>
