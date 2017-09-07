<?php
namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use COEM\Http\Requests;
use COEM\Http\Requests\PacientCreateRequest;
use COEM\Http\Controllers\Controller;
use COEM\Pacient;
use COEM\Doctor;
use COEM\Medicament;
use DB;
use Session;
use Redirect;

class PacientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		  return view('pacient/index_paciente');
	}
	public function adddate($id)
	{
		$paciente = Pacient::find($id);
		$pacients = DB::table('pacients')
								->orderBy('apaterno', 'asc')
								->get();
		$doctors = DB::table('doctors')
								->orderBy('apaterno', 'asc')
								->get();;
		$medicaments = Medicament::all();
		return view('Citas/date_create',compact('pacients','doctors','medicaments','paciente'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$doctors = Doctor::all();
		$pacients = Pacient::All();
		//$doctors = Doctor::lists('nombre', 'id');
		return view('pacient/pacient_create',compact('doctors','pacients'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PacientCreateRequest $request)
	{
		//el método create() crea un nuevo registro, se deben asociar los datos del request
		//con las columnas de la tabla
		$referido_por = "";
		for ($i=0; $i < count($request->referidos); $i++) {
			if ($request->referidos[$i] == 'paciente') {
				$referido_por .= $request->referidos[$i];
				$referido_por .= ': ';
				$referido_por .= $request['paciente'];
				$referido_por .= ', ';
			}
			else {
				$referido_por .= $request->referidos[$i];
				$referido_por .= ', ';
			}

		}
		Pacient::create([
		'nombre' => $request['nombre'],
		'apaterno' => $request['apaterno'],
		'amaterno' => $request['amaterno'],
		'fecha_nac' => $request['fecha_nac'],
		'calle' => $request['calle'],
		'num_ext' => $request['num_ext'],
		'num_int' => $request['num_int'],
		'colonia' => $request['colonia'],
		'cp' => $request['cp'],
		'localidad' => $request['localidad'],
		'municipio' => $request['municipio'],
		'estado' => $request['estado'],
		'telefono_casa' => $request['telefono_casa'],
		'telefono_celular' => $request['telefono_celular'],
		'telefono_oficina' => $request['telefono_oficina'],
		'correo' => $request['correo'],
		'fecha_inicio' => $request['fecha_inicio'],
		'kilos' => $request['kilos'],
		'cintura' => $request['cintura'],
		'cadera' => $request['cadera'],
		'fecha_fin' => $request['fecha_fin'],
		'referido_por' => $referido_por,
		'id_doctor' => $request['id_doctor']
	]);
	 	Session::flash('message','Paciente agregado correctamente');
		return redirect('pacient/pacient_show');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		//dd($request->get('name'));
		$pacients = Pacient::name($request->get('name'))->orderBy('id','DESC')->paginate(6);
		//se returna la vista con todos los registros
		return view('pacient/pacient_show',compact('pacients'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id_usuario
	 * @return Response
	 */
	 //muestra a todos los pacientes para elegir uno y actualizarlo
	 public function actualizar(Request $request)
 	{
		$pacients = Pacient::name($request->get('name'))->orderBy('apaterno','ASC')->paginate(4);
 		return view('pacient.pacient_update',compact('pacients'));
 	}
	//ya que se ha eligido uno, se aparta para editarlo//
	public function edit($id)
	{
		//se encuentra el registro con el id que se busca, y se almacena en una variable
		$doctors = Doctor::all();
		$pacient = Pacient::find($id);
		$pacients = Pacient::all();
		//se returna la vista del formulario que contendrá los datos del elemento
		//a editar
		return view('pacient.pacient_edit',['pacient'=>$pacient,'pacients'=>$pacients,'doctors'=>$doctors]);
	}
	/**
	 * Actualiza el registro en la base de datos
	 * Recibe como parámetro un Request, que es el formulario que contiene
	 * los datos que se van a actualizar y el id del registro a modificar
	 * @param  int  $id
	 * @return Response
	 */

	public function update(PacientCreateRequest $request,$id)
	{
		//se encuentra el registro con el id que se busca, y se almacena en una variable
		$pacient = Pacient::find($id);
		//se llama a la función que llena el registro con los datos almacenados en
		//el request
		$pacient->fill($request->all());
		//Se guardan los cambios hechos
		$pacient->save();
		//se manda mensaje mensaje de confirmación
		Session::flash('message','Paciente Actualizado Correctamente');
		//Se redirecciona a la vista que muestra los registros
		return Redirect::to('/pacient/show');

	}
	 //Muestra todos los pacientes de la base de datos para elegir al que se quiere eliminar
	 public function deleter(Request $request)
	 {
		 $pacients = Pacient::name($request->get('name'))->orderBy('apaterno','ASC')->paginate(4);
		 return view('pacient.pacient_delete',compact('pacients'));
	 }
	 /**
		* Remueve el elemento de la base de datos, recibe como parámetro
		*el id del usuario que se va a eliminar
		* @param  int  $id
		* @return Response
		*/
	 public function destroy($id)
	 {
		 $pacient = Pacient::find($id);
		 $pacient->delete();
		 //se manda mensaje mensaje de confirmación
		 Session::flash('message','Paciente eliminado de la base de datos correctamente');
		 //Se redirecciona a la vista que muestra los registros
		 return Redirect::to('/pacient/show');

	 }

}
