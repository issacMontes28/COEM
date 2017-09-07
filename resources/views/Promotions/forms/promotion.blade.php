<div class="form-group">
{!!Form::label('nombre_1','Nombre:')!!}
{!!Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese nombre de promoción'])!!}
</div>
<div class="form-group">
{!!Form::label('descripcion_1','Descripción de promoción:')!!}
{!!Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Ingrese descripción de promoción'])!!}
</div>
<div class="form-group">
{!!Form::label('tipo_1','Tipo de promoción:')!!}
{!!Form::select('tipo',[
'Paquete'=>'Paquete','Precios especiales'=>'Precios especiales'],['class'=>'form-control'])!!}
</div>
