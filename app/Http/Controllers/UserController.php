<?php namespace COEM\Http\Controllers;

namespace COEM\Http\Controllers;
use Illuminate\Http\Request;
use COEM\Http\Requests;
use COEM\Http\Requests\UserCreateRequest;
use COEM\Http\Requests\UserUpdateRequest;
use COEM\Http\Controllers\Controller;
use COEM\User;
use Session;
use Redirect;
//una vez que pones use COEM\User; ya no es necesario usar esta notación
//	\COEM\User::create

class UserController extends Controller {

	public function __construct(){
		$this->middleware('auth');
		$this->middleware('admin',['only'=>['deleter','actualizar','show']]);
	}
	/**
	 * El método index redirecciona a la página principal de usuarios,
	 * mostrando el menú de opciones
	 *
	 * @return Response
	 */
	public function index()
	{
	  return view('Usuarios/index_usuario');
	}

	/**
	 * El método create devuelve la vista que tiene el formulario que se
	 *llenará para almacenar un nuevo registro
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('Usuarios/user_create');
	}

	/**
	 * Almacena el nuevo elemento en la base de datos,
	 * recibe un Request que es el formulario con los datos a registrar.
	 *
	 * @return Response
	 */
	public function store(UserCreateRequest $request)
	{
		//el método create() crea un nuevo registro, se deben asociar los datos del request
		//con las columnas de la tabla
		User::create([
			'nombre' => $request['nombre'],
			'apellidos' => $request['apellidos'],
			'telefono' => $request['telefono'],
			'correo' => $request['correo'],
			'tipo_usuario' => $request['tipo_usuario'],
			'password' => bcrypt($request['password'])
		]);
		return redirect('/user/show')->with('message','Se ha agregado un nuevo usuario correctamente');
	}

	/**
	 * Muestra a todos los usuarios sin realizar ninguna acción adicional
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		//El método all() retorna todos los registros
		$users = User::name($request->get('name'))->orderBy('apellidos','ASC')->paginate(4);
		//se returna la vista con todos los registros
		return view('Usuarios/user_show',compact('users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 //muestra a todos los usuario para elegir uno y actualizarlo
	 public function actualizar(Request $request)
 	{
		$users = User::name($request->get('name'))->orderBy('apellidos','ASC')->paginate(4);
 		return view('Usuarios.user_update',compact('users'));
 	}
	//ya que se ha eligido uno, se aparta para editarlo
	public function edit($id)
	{
		//se encuentra el registro con el id que se busca, y se almacena en una variable
		$user = User::find($id);
		//se returna la vista del formulario que contendrá los datos del elemento
		//a editar
		return view('Usuarios.user_edit',['user'=>$user]);
	}
	/**
	 * Actualiza el registro en la base de datos
	 * Recibe como parámetro un Request, que es el formulario que contiene
	 * los datos que se van a actualizar y el id del registro a modificar
	 * @param  int  $id
	 * @return Response
	 */

	public function update(UserUpdateRequest $request,$id)
	{
		//se encuentra el registro con el id que se busca, y se almacena en una variable
		$user = User::find($id);
		//se llama a la función que llena el registro con los datos almacenados en
		//el request
		$user->fill($request->all());
		//Se guardan los cambios hechos
		$user->save();
		//se manda mensaje mensaje de confirmación
		Session::flash('message','Usuario Actualizado Correctamente');
		//Se redirecciona a la vista que muestra los registros
		return Redirect::to('/user/show');

	}

	//Muestra todos los usuarios de la base de datos para elegir al que se quiere eliminar
	public function deleter(Request $request)
	{
		$users = User::name($request->get('name'))->orderBy('apellidos','ASC')->paginate(4);
		return view('Usuarios.user_delete',compact('users'));
	}
	/**
	 * Remueve el elemento de la base de datos, recibe como parámetro
	 *el id del usuario que se va a eliminar
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//se invoca a la función del modelo que elimina el usuario que tenga ese id
		///User::destroy($id);
		$user = User::find($id);
		$user->delete();
		//se manda mensaje mensaje de confirmación
		Session::flash('message','Usuario eliminado correctamente');
		//Se redirecciona a la vista que muestra los registros
		return Redirect::to('/user/show');

	}

}
