<?php

namespace COEM\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
Use Auth;
Use Session;
Use Redirect;
use COEM\Pacient;
use COEM\Medicament;
use COEM\MailHistory;
use COEM\Measure;
use Carbon\Carbon;
use Mail;
use COEM\Http\Requests;
use COEM\Http\Requests\LoginRequest;
use COEM\Http\Controllers\Controller;

class LogController extends Controller
{

    /**
     * Funcion que valida que los datos del login sean correctos, si éstos son correctos
     * entonces se hacen las operaciones automáticas de enviar correos de felicitacion
     * y además checar el inventario.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $res = Self::loggeo($request);
        if ($res == 1) {
          //Se redirecciona a la página principal del sistema donde se mostrará el mensaje de confirmación
          return Redirect::to('index');
        }
        if ($res == 2) {
          Session::flash('message-error','Verifique sus datos');
          return Redirect::to('/');
        }
    }
    public function loggeo($request){
      //Si los datos de email y contraseña son correctos
        if (Auth::attempt(['correo' => $request['email'],'password' => $request['password']])) {
          //Si hay algún mensaje
          $cumple = Self::cumpleanios();
          $medicamentos = Self::medicamentos();
          if ($cumple!="" && $medicamentos!=""){
            $mensaje = $cumple;
            $mensaje2 = $medicamentos;
            Session::flash('message',$mensaje);
            Session::flash('message2',$mensaje2);
          }
          if ($cumple!="" && $medicamentos=="") {
            $mensaje = $cumple;
            Session::flash('message',$mensaje);
          }
          if ($cumple=="" && $medicamentos!="") {
            $mensaje2 = $medicamentos;
            Session::flash('message2',$mensaje2);
          }
          if ($cumple=="" && $medicamentos==""){
            $mensaje = "¡Bienvenido!, por el momento no hay nada nuevo";
            Session::flash('message',$mensaje);
          }
          return 1;
        }
          return 2;
    }
    public function cumpleanios(){
      //colección que guaradará  a las personas que cumplen años
      $collection = "";
      //Se  recuperan todos los pacientes para obtener su fecha de nacimiento
      $pacients = Pacient::all();
      //Se pasa la fecha de hoy a un formato en el cuál podamos extraer
      //El mes y el año de manera más fácil
      $fecha = Carbon::now();
      $fecha = $fecha->format('Y/m/d');
      //Método explode separa una variable por el caracter que querramos
      list($year, $month, $day) = explode('/', $fecha);
      //La variable mensaje almacena el texto que se le mostrará al usuario cuando inicie sesión
      //indicando que el correo ha sido enviado
      $mensaje = "";
      //La variable bandera2 indica si se le envió correo a alguien
      $bandera2 = 0;
      foreach ($pacients as $pacient) {
          //La variable bandera indica si al paciente se le ha enviado un correo
          //de felicitación ya
          $bandera = 0;
          $id_paciente = $pacient->id;
          //Se recupera la bitácora de envío de correos de felicitación
          $histories = MailHistory::all();
          //se verifica en un ciclo que no se haya enviado ya el mensaje de felicitación
          //al paciente
          foreach ($histories as $history) {
            $fecha2 = Carbon::now();
            $fecha2 = $fecha2->format('Y-m-d');
            $id = $history->id_paciente;
            $fecha_envio = $history->fecha_envio;
             //si está el envío de correo a ese paciente en el historial
             if ($id == $id_paciente) {if ($fecha_envio == $fecha2) {$bandera = 1;}}
          }
          //Si no se le ha enviado el mensaje y si es su cumpleaños
          if ($bandera == 0) {
            //Se extrae la fecha de nacimiento de cada paciente para poder hacer las comparaciones
              $aux_fecha = $pacient->fecha_nac;
              list($year_2, $month_2, $day_2) = explode('-', $aux_fecha);
              //Si el mes y día de nacimiento son los mismos que la fecha de hoy, entonces se
              //realiza el proceso de envío de correo
              if ($month == $month_2 && $day == $day_2) {
                $bandera2 = 1;
                //se puso este arreglo simplemente porque la función necesita información como parámetro
                $dates_1[] = array('nombre'=> $pacient->nombre);
                //se recupera el correo del paciente, a donde se enviará el correo
                $toEmail = $pacient->correo;
                $nombre = $pacient->nombre.' '.$pacient->apaterno.' '.$pacient->amaterno;
                $cumpleaneros_array[] = array('nombre'=> $nombre);
                $collection = Collection::make($cumpleaneros_array);

                //El método send del objeto Mail es el que envía el correo
                Mail::send('mails.felicitacion',$dates_1, function($msj) use ($toEmail){
                  $msj->subject('Felicidades!');
                  $msj->to($toEmail);
                });
                //se crea un registro en la bitácora de envío de correos
                MailHistory::create(['id_paciente' =>$id_paciente,'fecha_envio' =>$fecha]);
              }
          }
      }
      if ($bandera2 == 1) {
        $mensaje = "[Aviso] Mensaje de felicitacion enviado a :";
          //Se concatena la cadena del mensaje con los nombres de los pacientes que cumplen años
          for ($i=0; $i < count($collection) ; $i++) {
            //si hay mas de un cumpleañero y estamos iterando sobre el primero
              if ($i == 0 && count($collection)>1) {
                $mensaje = $mensaje.' '.$collection[$i]["nombre"].', ';
              }
              else {
                //si hay mas de un cumpleañero y estamos iterando sobre el que no es el primero
                if ($i >0) {
                  //si hay mas de un cumpleañero y estamos iterando sobre el último
                  if ($i == (count($collection)-1) &&  count($collection)>1) {
                    $mensaje = $mensaje.' '.$collection[$i]["nombre"].'.';
                  }
                  else {$mensaje = $mensaje.' '.$collection[$i]["nombre"].',';}
                }
                //si solamente hay un cumpleañero y estamos iterando sobre él
                if (count($collection) == 1) {
                  $mensaje = $mensaje.' '.$collection[$i]["nombre"].'.';
                }
              }
          }
      }
      return $mensaje;
    }
    public function medicamentos(){
      $medicaments = Medicament::all();
      $fecha = Carbon::now();
      $fecha = $fecha->format('Y-m-d');
      $collection_2 = "";
      //Se verifica que no se haya hecho ya registro de las existencias del almacén
      $measures = Measure::all();
      $bandera_fecha = 0;
      $cant_mesures = 0;
      foreach ($measures as $measure) {
        $fecha2 = $measure->fecha;
         //si la fecha ya está registrada
         if ($fecha == $fecha2) { $bandera_fecha = 1;}
         $cant_mesures = $cant_mesures+1;
      }
      if ($bandera_fecha ==0 || $cant_mesures==0) {
        foreach ($medicaments as $medicament) {
          if ($medicament->tipo == "Producto de almacén") {
            Measure::create([
              'fecha' => $fecha,
              'id_producto' => $medicament->id,
              'c_inicial' => $medicament->existencias,
              'c_final' => null
            ]);
          }
        }
      }
      $bandera_fecha = 0;
      //La variable mensaje almacena el texto que se le mostrará al usuario cuando inicie sesión
      //indicando que el correo ha sido enviado
      $mensaje = "";
      foreach ($medicaments as $medicament) {
        if ($medicament->existencias <= 10 && $medicament->tipo!="Servicio" && $medicament->tipo!="Consulta" && $medicament->tipo!="Fotodepilación") {
           $aux_medicament = Medicament::find($medicament->id);
           $medicamentos_array[] = array('nombre'=> $aux_medicament->nombre,
           'existencias'=> $aux_medicament->existencias);
        }
      }
      //Si hay algún  medicamento con menos de 10 unidades en el arreglo temporal
      if (isset($medicamentos_array)) {
        $collection_2 = Collection::make($medicamentos_array);
        if (count($collection_2)>0) {
            //Se concatena la cadena del mensaje con los medicamentos con menos de 10 unidades de existencia
            for ($i=0; $i < count($collection_2) ; $i++) {
              //si hay mas de un medicamento con menos de 10 unidades y estamos iterando sobre el primero
                if ($i == 0 && count($collection_2)>1) {
                  $mensaje = $mensaje.' [Advertencia] Medicamentos con 10 o menos unidades en almacen actualmente: '
                  .$collection_2[$i]["nombre"].' (existencias: '.$collection_2[$i]["existencias"].'), ';
                }
                else {
                  //si hay mas de un cumpleañero y estamos iterando sobre el que no es el primero
                  if ($i >0) {
                    //si hay mas de un medicamento con menos de 10 unidades y estamos iterando sobre el último
                    if ($i == (count($collection_2)-1) &&  count($collection_2)>1) {
                      $mensaje = $mensaje.$collection_2[$i]["nombre"].' (existencias: '
                      .$collection_2[$i]["existencias"].').';
                    }
                    else {
                      $mensaje = $mensaje.$collection_2[$i]["nombre"].' (existencias: '
                      .$collection_2[$i]["existencias"].'),';
                    }
                  }
                  //si solamente hay  un medicamento con menos de 10 unidades y estamos iterando sobre él
                  if (count($collection_2) == 1) {
                    $mensaje = $mensaje.'  [Advertencia] Medicamentos con 10 o menos unidades en almacen actualmente: '
                    .$collection_2[$i]["nombre"].' (existencias: '.$collection_2[$i]["existencias"].').';
                   }
                }
             }
          }
       }
       return $mensaje;
    }
    public function logout()
    {
        Auth::logout();
        Return Redirect::to('/');
    }

}
