@extends('layouts.principal_dos')
@include('Ventas.forms.barra_alternativa')
  @section('content')
    <div class="container">
   {!!Form::open()!!}
        <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token"></input>
        @include('Ventas.forms.sale_cliente')
      	<button id="btnAgregar" data-bind="click: $root.agregarVenta_cliente"  class="btn btn-success">Registrar venta</button>
        <button class="btn btn-primary" data-bind="click: $root.recargar">Nueva venta</button>
        <div class="form-group">
        	<label for="btnAgregar" class="col-sm-2 control-label"></label>
        </div>
    {!!Form::close()!!}
  </div>
  @section('js')
    {!!Html::script('js/app.js')!!}
  @stop
@stop
