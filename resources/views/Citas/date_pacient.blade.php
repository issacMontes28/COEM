@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('Citas.forms.barra_alternativa_dos')
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
                <select data-bind="options: $root.pacientes, optionsText: function(item) {
                                 return item.nombre()
                             },
                             value: chosenPacient,
                             optionsCaption: 'Elija un paciente...'">
                </select>
              </td>
            </tr>
           <tr>
             <td colspan="2"  align="center">
             <button id="btnAgregar" data-bind="click: $root.conpaciente"  class="btn btn-success">Encontrar citas</button>
           </td>
           </tr>
            </table>
          </div>
          <div><br><br/></div>
          <div data-bind="visible: consec_pacientes().length > 0">
              <table>
        			 <thead>
                 <th>Paciente</th>
								 <th>Fecha de consulta (AA-MM-DD)</th>
								 <th>Hora</th>
								 <th>División a la que asiste</th>
								 <th>Tipo de consulta</th>
                 <th>Doctor asignado</th>
        			 </thead>
        			 <tbody data-bind="foreach: consec_pacientes">
        					 <tr>
										   <td data-bind="text: nombre"></td>
											 <td data-bind="text: fecha"></td>
        							 <td data-bind="text: hora"></td>
											 <td data-bind="text: division"></td>
        							 <td data-bind="text: tipo_cita"></td>
        							 <td data-bind="text: doctor"></td>
        					 </tr>
        			 </tbody>
             </table>
          </div>
        </div>
    {!!Form::close()!!}
  </div>
  @section('js')
    {!!Html::script('js/citas_paciente.js')!!}
  @stop
@stop
