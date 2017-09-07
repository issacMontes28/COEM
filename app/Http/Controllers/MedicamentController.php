<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use COEM\Http\Requests;
use COEM\Http\Requests\MedicamentCreateRequest;
use COEM\Http\Requests\MedicamentUpdateRequest;
use COEM\Http\Controllers\Controller;
use COEM\Medicament;
use COEM\Provider;
use Session;
use Redirect;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {return view('Medicamentos/index_medicament');}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        return view('Medicamentos/medicament_create',compact('providers'));}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicamentCreateRequest $request)
    {
      //el método create() crea un nuevo registro, se deben asociar los datos del request
      //con las columnas de la tabla
       Medicament::create($request->all());
       return redirect('/medicament/show')->with('message','Se ha agregado un nuevo producto correctamente');
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
      $medicaments = Medicament::name($request->get('name'))->orderBy('nombre','ASC')->paginate(8);
      //se returna la vista con todos los registros
      return view('Medicamentos.medicament_show',compact('medicaments'));
    }
    /**
     * Muestra el registro que se va actualizar
     *
     * @param  int  $id_usuario
     * @return Response
     */
     //muestra a todos los medicamentos para elegir uno y actualizarlo
     public function actualizar(Request $request)
    {
      $medicaments = Medicament::name($request->get('name'))->orderBy('nombre','ASC')->paginate(8);
      return view('Medicamentos.medicament_update',compact('medicaments'));
    }
    //ya que se ha eligido uno, se aparta para editarlo
    public function edit($id)
    {
      //se encuentra el registro con el id que se busca, y se almacena en una variable
      $medicament = Medicament::find($id);
      $providers = Provider::all();
      //se returna la vista del formulario que contendrá los datos del elemento
      //a editar
      return view('Medicamentos.medicament_edit',['medicament'=>$medicament,'providers'=>$providers]);
    }
    /**
     * Actualiza el registro en la base de datos
     * Recibe como parámetro un Request, que es el formulario que contiene
     * los datos que se van a actualizar y el id del registro a modificar
     * @param  int  $id
     * @return Response
     */

    public function update(MedicamentUpdateRequest $request,$id)
    {
      //se encuentra el registro con el id que se busca, y se almacena en una variable
      $medicament = Medicament::find($id);
      //se llama a la función que llena el registro con los datos almacenados en
      //el request
      $medicament->fill($request->all());
      //Se guardan los cambios hechos
      $medicament->save();
      //se manda mensaje mensaje de confirmación
      Session::flash('message','Producto Actualizado Correctamente');
      //Se redirecciona a la vista que muestra los registros
      return Redirect::to('/medicament/show');

    }
     //Muestra todos los medicamentos de la base de datos para elegir al que se quiere eliminar
     public function deleter(Request $request)
     {
       $medicaments = Medicament::name($request->get('name'))->orderBy('nombre','ASC')->paginate(8);

       return view('Medicamentos.medicament_delete',compact('medicaments'));
     }
     /**
      * Remueve el elemento de la base de datos, recibe como parámetro
      *el id del usuario que se va a eliminar
      * @param  int  $id
      * @return Response
      */
     public function destroy($id)
     {
       //se encuentra el registro con el id que se busca, y se almacena en una variable
       $med=Medicament::find($id);
       if ($med->imagen != null) {
         \Storage::delete($med->imagen);
       }
		   $med->delete();
       //se manda mensaje mensaje de confirmación
       Session::flash('message','Producto eliminado de la base de datos correctamente');
       //Se redirecciona a la vista que muestra los registros
       return Redirect::to('/medicament/show');

     }
     public function show_options(){ return view('Medicamentos.medicaments_show_options');}
     public function show_info()
     {
       $medicaments = Medicament::all();
       $file = 'json/medicamentos.json';
  		 file_put_contents($file, $medicaments);
       return view('Medicamentos.medicament_show_info');
     }
}
