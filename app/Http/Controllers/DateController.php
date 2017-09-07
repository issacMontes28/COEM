<?php
namespace COEM\Http\Controllers;
use Illuminate\Support\Collection;
use COEM\Http\Requests\DateCreateRequest;
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

class DateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		  return view('Citas/index_date');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$pacients = DB::table('pacients')
                ->orderBy('apaterno', 'asc')
                ->get();
		$doctors = DB::table('doctors')
                ->orderBy('apaterno', 'asc')
                ->get();;
		$medicaments = Medicament::all();
		return view('Citas/date_create',compact('pacients','doctors','medicaments'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DateCreateRequest $request)
	{
		//el método create() crea un nuevo registro, se deben asociar los datos del request
		//con las columnas de la tabla
		Date::create([
			'id_paciente' => $request['id_paciente'],
			'fecha' => $request['fecha'],
			'hora' => $request['hora'],
			'division' => $request['division'],
			'tipo_cita' => $request['tipo_cita'],
			'id_doctor' => $request['id_doctor']
		]);
		$paciente = Pacient::find($request['id_paciente']);
		if ($request['kilos'] != null && $request['kilos'] != 0 && $request['kilos'] != "") {
			$kilos = $request['kilos'];
			$dif_peso = 0;
			if ($paciente->kilos == 0) {
				$paciente->fill([
					'kilos' => $kilos
				]);
			}
			else {
				$dif_peso = $paciente->kilos - $kilos;
				$paciente->fill([
					'kilos' => $kilos
				]);
			}
		}
		else {$dif_peso = 0;}

		if ($request['cintura'] != null && $request['cintura'] != 0 && $request['cintura'] != "") {
			$cintura = $request['cintura'];
			$dif_cintura = 0;
			if ($paciente->cintura == 0) {
				$paciente->fill([
					'cintura' => $cintura
				]);
			}
			else {
				$dif_cintura = $paciente->cintura - $cintura;
				$paciente->fill([
					'cintura' => $cintura
				]);
			}
		}
		else {$dif_cintura = 0;}

		if ($request['cadera'] != null && $request['cintura'] != 0 && $request['cintura'] != "") {
			$cadera = $request['cadera'];
			$dif_cadera = 0;
			if ($paciente->cadera == 0) {
				$paciente->fill([
					'cadera' => $cadera
				]);
			}
			else {
				$dif_cadera = $paciente->cadera - $cadera;
				$paciente->fill([
					'cadera' => $request['cadera']
				]);
			}
		}
		else {$dif_cadera = 0;}

		//Se guardan los cambios hechos
		$paciente->save();
		$citas = Date::all();
		$ucita = $citas->last();
		$iducita = $ucita->id;
		$modificado = "Ninguna modificación";

		//se extrae la fecha de hoy
		$fecha = Carbon::now();
		//se crea un registro en la bitácora de citas
		Date_action::create(['id_cita' =>$iducita,'fecha' =>$fecha,
		'modificaciones' =>$modificado,'asistencia' =>$request['asistencia'],
		'nota' =>$request['nota'],'peso_actual' =>$paciente->kilos,
		'peso_dif' =>$dif_peso,'cintura_actual' =>$paciente->cintura,
		'cintura_dif' =>$dif_cintura,'cadera_actual' =>$paciente->cadera,
		'cadera_dif' =>$dif_cadera]);

		return redirect('/date/show')->with('message','Se ha agregado una nueva cita');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function show(Request $request)
	 	{
	 		$dates = Date::fecha($request->get('fecha1'))->orderBy('id','DESC')->paginate(6);
			/*$pacients = Pacient::where('nombre',1)
							 ->orderBy('apaterno', 'ASC')->paginate(5);*/
			$pacients = DB::table('pacients')
				 					->orderBy('apaterno', 'asc')
				 					->get();
	 		//se returna la vista con todos los registros
	 		return view('Citas/date_show',compact('dates','pacients'));
	 	}
		public function show_date_pacient(Request $request)
 	 	{
 	 		$dates = Date::name($request->get('id_paciente'))->orderBy('id','DESC')->paginate(6);
			$pacients = DB::table('pacients')
									->orderBy('apaterno', 'asc')
									->get();
 	 		return view('Citas/date_show',compact('dates','pacients'));
 	 	}
	 	/**
	 	 * Show the form for editing the specified resource.
	 	 *
	 	 * @param  int  $id_usuario
	 	 * @return Response
	 	 */
	 	 //muestra a todos los pacientes para elegir uno y actualizarlo
	 	 public function actualizar()
	  	{
	 			$dates = Date::paginate(7);
				$pacients = Pacient::all();
				$medicaments = Medicament::all();
	  		return view('Citas.date_update',compact('dates','medicaments','pacients'));
	  	}
	 	//ya que se ha eligido uno, se aparta para editarlo
   	public function edit($id)
	 	{
	 		//se encuentra el registro con el id que se busca, y se almacena en una variable
	 		$pacients = Pacient::all();
	 		$date = Date::find($id);
			$doctors = Doctor::all();
			$medicaments = Medicament::all();
	 		//se returna la vista del formulario que contendrá los datos del elemento
	 		//a editar
	 		return view('Citas.date_edit',['date'=>$date,'pacients'=>$pacients,
			'doctors'=>$doctors,'medicaments'=>$medicaments]);
	 	}
	 	/**
	 	 * Actualiza el registro en la base de datos
	 	 * Recibe como parámetro un Request, que es el formulario que contiene
	 	 * los datos que se van a actualizar y el id del registro a modificar
	 	 * @param  int  $id
	 	 * @return Response
	 	 */
	 	public function update(DateCreateRequest $request,$id)
	 	{
	 		//se encuentra el registro con el id que se busca, y se almacena en una variable
	 		$date = Date::find($id);
			//se hacen verificaciones acerca de qué se modificó

			$bandera = "no";
			$modificado = "";
			if ($date->id_paciente != $request['id_paciente']) {
				//se buscan los nombres de los pacientes en caso de que se hayan modificado
				$paciente = Pacient::find($date->id_paciente);
				$nombre_paciente = $paciente->nombre.' '.$paciente->apaterno.' '.$paciente->amaterno;

				$paciente_2 = Pacient::find($request['id_paciente']);
				$nombre_paciente_2 = $paciente_2->nombre.' '.$paciente_2->apaterno.' '.$paciente_2->amaterno;

				$modificado.='Paciente, antes: '.$nombre_paciente.' , ahora: '.$nombre_paciente_2.'.';
				$bandera = "si";
			}
			if ($date->fecha != $request['fecha']) {
				$modificado.=' Fecha, antes: '.$date->fecha.' , ahora: '.$request['fecha'].'.';
				$bandera = "si";
			}
			if ($date->hora != $request['hora']) {
				$modificado.=' Hora, antes: '.$date->hora.' , ahora: '.$request['hora'].'.';
				$bandera = "si";
			}
			if ($date->division != $request['division']) {
				$modificado.=' Área de asistencia, antes: '.$date->division.' , ahora: '.$request['division'].'.';
				$bandera = "si";
			}
			if ($date->tipo_cita != $request['tipo_cita']) {
				echo "entra5<br>";
				$modificado.=' Tipo de cita, antes: '.$date->tipo_cita.' , ahora: '.$request['tipo_cita'].'.';
				$bandera = "si";
			}
			if ($bandera == "no") {
				$modificado = "No se modificaron datos de la cita";
			}
	 		//se llama a la función que llena el registro con los datos almacenados en
	 		//el request
	 		$date->fill([
				'id_paciente' => $request['id_paciente'],
				'fecha' => $request['fecha'],
				'hora' => $request['hora'],
				'division' => $request['division'],
				'tipo_cita' => $request['tipo_cita'],
				'id_doctor' => $request['id_doctor']
			]);
	 		//Se guardan los cambios hechos
	 		$date->save();
			$paciente = Pacient::find($request['id_paciente']);
			//si el campo que se envía está vacío
			if ($request['kilos'] != null && $request['kilos'] != 0 && $request['kilos'] != "") {
				$kilos = $request['kilos'];
				$dif_peso = 0;
				if ($paciente->kilos == 0) {
					$paciente->fill([
						'kilos' => $kilos
					]);
				}
				else {
					$dif_peso = $paciente->kilos - $kilos;
					$paciente->fill([
						'kilos' => $kilos
					]);
				}
			}
			else {$dif_peso = 0;}

			if ($request['cintura'] != null && $request['cintura'] != 0 && $request['cintura'] != "") {
				$cintura = $request['cintura'];
				$dif_cintura = 0;
				if ($paciente->cintura == 0) {
					$paciente->fill([
						'cintura' => $cintura
					]);
				}
				else {
					$dif_cintura = $paciente->cintura - $cintura;
					$paciente->fill([
						'cintura' => $cintura
					]);
				}
			}
			else {$dif_cintura = 0;}

			if ($request['cadera'] != null && $request['cintura'] != 0 && $request['cintura'] != "") {
				$cadera = $request['cadera'];
				$dif_cadera = 0;
				if ($paciente->cadera == 0) {
					$paciente->fill([
						'cadera' => $cadera
					]);
				}
				else {
					$dif_cadera = $paciente->cadera - $cadera;
					$paciente->fill([
						'cadera' => $cadera
					]);
				}
			}
			else {$dif_cadera = 0;}
			//Se guardan los cambios hechos
			$paciente->save();

			//se extrae la fecha de hoy
			$fecha = Carbon::now();
			//se crea un registro en la bitácora de citas
			Date_action::create(['id_cita' =>$id,'fecha' =>$fecha,
			'modificaciones' =>$modificado,'asistencia' =>$request['asistencia'],
			'nota' =>$request['nota'],'peso_actual' =>$paciente->kilos,
			'peso_dif' =>$dif_peso,'cintura_actual' =>$paciente->cintura,
			'cintura_dif' =>$dif_cintura,'cadera_actual' =>$paciente->cadera,
			'cadera_dif' =>$dif_cadera]);
	 		//se manda mensaje mensaje de confirmación
	 		Session::flash('message','Cita Actualizada Correctamente');
	 		//Se redirecciona a la vista que muestra los registros
	 		return Redirect::to('/date/show');

	 	}
	 	 //Muestra todos las citas de la base de datos para elegir al que se quiere eliminar

		 public function deleter()
	 	 {
	 		 $dates = Date::paginate(7);
			 $medicaments = Medicament::all();
			 $pacients = DB::table('pacients')
 									->orderBy('apaterno', 'asc')
 									->get();
	 		 return view('Citas.date_delete',compact('dates','medicaments','pacients'));
	 	 }
	 	 /**
	 		* Remueve el elemento de la base de datos, recibe como parámetro
	 		*el id del usuario que se va a eliminar
	 		* @param  int  $id
	 		* @return Response
	 		*/
	 	 public function destroy($id)
	 	 {
	 		 //se invoca a la función del modelo que elimina el paciente que tenga ese id
	 		 //Date::destroy($id);
			 $date = Date::find($id);
			 $date->delete();
	 		 //se manda mensaje mensaje de confirmación
	 		 Session::flash('message','Cita eliminada de la base de datos correctamente');
	 		 //Se redirecciona a la vista que muestra los registros
	 		 return Redirect::to('/date/show');
			 //se extrae la fecha de hoy
			 $fecha = Carbon::now();
			 //se crea un registro en la bitácora de citas
			 Date_action::create(['id_cita' =>$id,'fecha' =>$fecha,
			 'accion' =>'Eliminación de cita','motivo' =>$request['motivo'],'nota' =>$request['nota']]);
	 	 }

		 //Muestra el hostial de pesos de los pacientes
		 public function historial_pesos(){
			//El método all() retorna todos los registros
			$dates = Date_action::All();
			foreach ($dates as $date) {
				$id_cita = $date->id_cita;
				$cita = Date::find($id_cita);
				$id_cliente = $cita->id_paciente;
				$paciente = Pacient::find($id_cliente);
				$nombre_paciente = $paciente->nombre.' '.$paciente->apaterno.' '.$paciente->amaterno;
				$pesos_array[] = array('id_paciente'=> $id_cliente, 'nombre'=> $nombre_paciente,
        'peso'=> $date->peso_actual);
			}
			//Se crea el archivo json, si existe, se sobreescribe
			$collection_2 = Collection::make($pesos_array);
			$collection_2->toJson();
			$file = 'json/pesos.json';
			file_put_contents($file, $collection_2);
		}
	 //Muestra el hostial de pesos de los pacientes
	 public function show_pacient(){
		//El método all() retorna todos los registros
		$dates = Date::All();
		foreach ($dates as $date) {
			$id_cita = $date->id_cita;
			$fecha_cita = $date->fecha;
			$id_cliente = $date->id_paciente;
			$paciente = Pacient::find($id_cliente);
			$nombre_paciente = $paciente->nombre.' '.$paciente->apaterno.' '.$paciente->amaterno;
			$doctor = $date->id_doctor;
			$fila_doc = Doctor::find($doctor);
			$doc = $fila_doc['nombre'].' '.$fila_doc['apaterno'].' '.$fila_doc['amaterno'];
			$pesos_array[] = array('id'=> $id_cita, 'paciente'=>$nombre_paciente,
			'fecha'=> $fecha_cita,'hora'=>$date->hora,'division'=>$date->division,
			'tipo_cita'=>$date->tipo_cita,'doctor'=>$doc);
		}
		//Se crea el archivo json, si existe, se sobreescribe
		$collection_2 = Collection::make($pesos_array);
		$collection_2->toJson();
		$file = 'json/citas.json';
		file_put_contents($file, $collection_2);
		return view('Citas/date_pacient');
	}
}
