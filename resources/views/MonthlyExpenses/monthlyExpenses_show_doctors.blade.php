@extends('layouts.principal')
@section('tabla')
  {!!Html::style('css/tabla.css')!!}
@endsection
@include('MonthlyExpenses.forms.barra_alternativa')
@section('content')
    <div class="container">
			<form action="{{ url('monthlyExpense/monthlyExpenses/AddReportDates') }}" method="POST">
					 <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token"></input>
          @include('MonthlyExpenses.forms.DoctorshowMonthlyExpenses')
					<div><br></div>
					<div class="form-group">
					<table>
					 	<tr>
					 		<td>Fecha inicial</td><td><input type="date" name="fecha_inicial"/></td>
					 	<tr>
					 		<td>Fecha final</td><td><input type="date" name="fecha_final"/></td>
					 	</tr>
					 	<tr>
					 			<td colspan="2"><input type="submit" class="btn btn-success" value="Generar reporte de citas entre estas fechas"></input></td>
					 	</tr>
				  </table>
				</div>
		  </form>
  	</div>
  @section('js')
    {!!Html::script('js/dates.js')!!}
  @stop
@stop
