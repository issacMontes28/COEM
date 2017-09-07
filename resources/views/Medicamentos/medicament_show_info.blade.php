@extends('layouts.principal')
@include('Citas.forms.barra_alternativa')
  @section('content')
    <div class="container">
   {!!Form::open()!!}
        <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token"></input>
        <div>
        <table>
            <tr>
              <td>
                <label>Elija paciente</label>
              </td>
              <td>
                <select data-bind="options: $root.productos, optionsText: function(item) {
                                 return item.nombre()
                             },
                             value: chosenProduct,
                             optionsCaption: 'Elija un producto...'">
                </select>
              </td>
            </tr>
            <tr>
              <td><input type="radio" name="flavorGroup" value="cherry" data-bind="checked: spamFlavor" />Productos agregados entre las fechas</td>
              <td><input type="radio" name="flavorGroup" value="almond" data-bind="checked: spamFlavor" />Productos con menos de n existencias</td>
            </tr>
           <tr>
             <td colspan="2"  align="center">
             <button id="btnAgregar" data-bind="click: $root.conpaciente"  class="btn btn-success">Encontrar en la bitácora</button>
           </td>
           </tr>
            </table>
          </div>
          <div><br><br/></div>
        </div>
    {!!Form::close()!!}
  </div>
  @section('js')
    {!!Html::script('js/medicamentos_info.js')!!}
  @stop
@stop
