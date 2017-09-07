<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use COEM\Http\Requests\ProviderCreateRequest;
use COEM\Http\Requests;
use COEM\Http\Controllers\Controller;
use COEM\Provider;
use Session;
use Redirect;

class ProviderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('Proveedores/index_proveedor');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
        return view('Proveedores/proveedor_create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProviderCreateRequest $request)
  {
    //el método create() crea un nuevo registro, se deben asociar los datos del request
    //con las columnas de la tabla
     Provider::create($request->all());
     return redirect('/provider/show')->with('message','Se ha agregado un nuevo proveedor correctamente');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    //El método all() retorna todos los registros
    $providers = Provider::name($request->get('name'))->orderBy('apellidos','ASC')->paginate(4);
    //se returna la vista con todos los registros
    return view('Proveedores/proveedor_show',compact('providers'));
  }
  /**
   * Muestra el registro que se va actualizar
   *
   * @param  int  $id_usuario
   * @return Response
   */
   //muestra a todos los provideres para elegir uno y actualizarlo
   public function actualizar(Request $request)
  {
    $providers = Provider::name($request->get('name'))->orderBy('apellidos','ASC')->paginate(4);
    return view('Proveedores.proveedor_update',compact('providers'));
  }
  //ya que se ha eligido uno, se aparta para editarlo
  public function edit($id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $provider = Provider::find($id);
    //se returna la vista del formulario que contendrá los datos del elemento
    //a editar
    return view('Proveedores.proveedor_edit',['provider'=>$provider]);
  }
  /**
   * Actualiza el registro en la base de datos
   * Recibe como parámetro un Request, que es el formulario que contiene
   * los datos que se van a actualizar y el id del registro a modificar
   * @param  int  $id
   * @return Response
   */

  public function update(ProviderCreateRequest $request,$id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $provider = Provider::find($id);
    //se llama a la función que llena el registro con los datos almacenados en
    //el request
    $provider->fill($request->all());
    //Se guardan los cambios hechos
    $provider->save();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','proveedor Actualizado Correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/provider/show');

  }
   //Muestra todos los provideres de la base de datos para elegir al que se quiere eliminar
   public function deleter(Request $request)
   {
     $providers = Provider::name($request->get('name'))->orderBy('apellidos','ASC')->paginate(4);

     return view('Proveedores.proveedor_delete',compact('providers'));
   }
   /**
    * Remueve el elemento de la base de datos, recibe como parámetro
    *el id del usuario que se va a eliminar
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
     $provider = Provider::find($id);
		 $provider->delete();
     //se manda mensaje mensaje de confirmación
     Session::flash('message','proveedor eliminado de la base de datos correctamente');
     //Se redirecciona a la vista que muestra los registros
     return Redirect::to('/provider/show');

   }
}
