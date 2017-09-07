<div class="form-group">
{!!Form::label('concepto_1','concepto:')!!}
{!!Form::text('concepto',null,['class'=>'form-control', 'placeholder'=>'Ingrese concepto de gasto'])!!}
</div>
<div class="form-group">
{!!Form::label('estado_1','Tipo de gasto:')!!}
{!!Form::select('tipo_gasto',[
'Fijo'=>'Fijo','Variable'=>'Variable'],['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!!Form::label('cantidad_1','Cantidad (opcional):')!!}
{!!Form::text('cantidad',null,['class'=>'form-control', 'placeholder'=>'Ingrese cantidad (monetaria)'])!!}
</div>
