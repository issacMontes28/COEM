<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use COEM\Http\Requests\PromotionCreateRequest;
use COEM\Http\Requests;
use COEM\Http\Controllers\Controller;
use COEM\Promotion;
use Session;
use Redirect;

class PromotionController extends Controller
{
  /**
   * El método index redirecciona a la página principal de Promotions,
   * mostrando el menú de opciones
   *
   * @return Response
   */
  public function index()
  {
    return view('Promotions/index_promotion');
  }

  /**
   * El método create devuelve la vista que tiene el formulario que se
   *llenará para almacenar un nuevo registro
   *
   * @return Response
   */
  public function create()
  {

    return view('promotionProducts/PromotionProduct_create');
  }
  /**
   * Almacena el nuevo elemento en la base de datos,
   * recibe un Request que es el formulario con los datos a registrar.
   *
   * @return Response
   */
  public function store(PromotionCreateRequest $request)
  {
    //el método create() crea un nuevo registro, se deben asociar los datos del request
    //con las columnas de la tabla
    Promotion::create($request->all());
    return redirect('/promotion/show')->with('message','Se ha agregado una nueva promoción');
  }

  /**
   * Muestra a todas las promociones
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request)
  {
    $promotions = Promotion::name($request->get('name'))->orderBy('nombre','ASC')->paginate(5);
    return view('Promotions/promotion_show',compact('promotions'));

  }
  public function show_options(Request $request){return view('Promotions/promotion_show_options');}
  public function actualizar_options(Request $request){return view('Promotions/promotion_actualizar_options');}
//
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
   //muestra a todos los usuario para elegir uno y actualizarlo
   public function actualizar(Request $request)
  {
    $Promotions = Promotion::name($request->get('name'))->orderBy('nombre','ASC')->paginate(5);
    return view('Promotions.promotion_update',compact('Promotions'));
  }
  //ya que se ha eligido uno, se aparta para editarlo
  public function edit($id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $promotion = Promotion::find($id);
    //se returna la vista del formulario que contendrá los datos del elemento
    //a editar
    return view('Promotions.promotion_edit',['promotion'=>$promotion]);
  }
  /**
   * Actualiza el registro en la base de datos
   * Recibe como parámetro un Request, que es el formulario que contiene
   * los datos que se van a actualizar y el id del registro a modificar
   * @param  int  $id
   * @return Response
   */

  public function update(PromotionCreateRequest $request,$id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $promotion = Promotion::find($id);
    //se llama a la función que llena el registro con los datos almacenados en
    //el request
    $promotion->fill($request->all());
    //Se guardan los cambios hechos
    $promotion->save();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','Promoción actualizada Correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/promotion/show');

  }

  //Muestra todos los Promotions de la base de datos para elegir al que se quiere eliminar
  public function deleter(Request $request)
  {
    $promotions = Promotion::name($request->get('name'))->orderBy('nombre','ASC')->paginate(5);
    return view('Promotions.promotion_delete',compact('promotions'));
  }
  /**
   * Remueve el elemento de la base de datos, recibe como parámetro
   *el id del usuario que se va a eliminar
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $promotion = Promotion::find($id);
		$promotion->delete();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','Promoción eliminada correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/promotion/show');

  }
  public function delete_options(){return view('Promotions.promotion_delete_options');}
}
