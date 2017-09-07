<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;

use COEM\Http\Requests;
use COEM\Http\Controllers\Controller;
use COEM\Pacient;
use COEM\Date;
use COEM\Doctor;
use COEM\Medicament;
use COEM\Date_action;
use Carbon\Carbon;
use Session;
use Redirect;
use DB;

class Date_actionController extends Controller
{
    /**
     * Muestra todos los registros de la bitácora de citas
     */
     public function show(Request $request)
     {
       $dates = Date_action::fecha($request->get('fecha1'))->orderBy('fecha','ASC')->paginate(5);
       $pacients = DB::table('pacients')
                   ->orderBy('apaterno', 'asc')
                   ->get();
       return view('Citas/date_actions_show',compact('dates','pacients'));
     }
    public function bitacora_paciente(Request $request){
      $dates = Date_action::name($request->get('id_paciente'))->orderBy('fecha','ASC')->paginate(5);
      $pacients = DB::table('pacients')
                  ->orderBy('apaterno', 'asc')
                  ->get();
      return view('Citas/date_actions_show',compact('dates','pacients'));
    }

}
