<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use COEM\Http\Requests\PromotionProductCreateRequest;
use COEM\Http\Requests;
use Illuminate\Support\Collection;
use COEM\Http\Controllers\Controller;
use COEM\PromotionProduct;
use DB;
use PDF;
use COEM\Medicament;
use COEM\Promotion;
use Carbon\Carbon;
use Session;
use Redirect;

class PromotionProductController extends Controller
{
  /**
   * El método index redirecciona a la página principal de promotionProducts,
   * mostrando el menú de opciones
   *
   * @return Response
   */
  public function index()
  {
    return view('PromotionProducts/index_promotionProduct');
  }

  /**
   * El método create devuelve la vista que tiene el formulario que se
   *llenará para almacenar un nuevo registro
   *
   * @return Response
   */
  public function create()
  {
    $medicaments = Medicament::all();
    $promotions = Promotion::all();

    $collection = Collection::make($medicaments);
    $collection->toJson();

    $collection2 = Collection::make($promotions);
    $collection2->toJson();

    //Se crea el archivo json, si existe, se sobreescribe
    $file = 'json/medicamentos.json';
    file_put_contents($file, $collection);
    $file = 'json/promociones.json';
    file_put_contents($file, $collection2);
    return view('PromotionProducts/promotionProduct_create');
  }

  public function create_options(){return view('PromotionProducts/promotionProduct_create_options');}

  /**
   * Almacena el nuevo elemento en la base de datos,
   * recibe un Request que es el formulario con los datos a registrar.
   *
   * @return Response
   */
  public function store(PromotionProductCreateRequest $request)
  {
    //el método create() crea un nuevo registro, se deben asociar los datos del request
    //con las columnas de la tabla
    PromotionProduct::create($request->all());
    return redirect('/promotionProduct/show')->with('message','Se ha agregado una nueva promoción');
  }
  public function AddItem(Request $request)
  {
    if($request->ajax()){
      if ($request->promocion["id"]==0) {
         Promotion::create([
           'nombre' => $request->promocion["nombre"],
           'descripcion' => $request->promocion["descripcion"],
           'tipo' => $request->promocion["tipo"]
         ]);
         $promotions = Promotion::all();
         $ultima_promocion = $promotions->last();
         $id_promocion = $ultima_promocion->id;
      }
      else {
        $id_promocion = $request->promocion["id"];
      }
      for ($i=0; $i < count($request->productos) ; $i++) {
         PromotionProduct::create([
          'id_producto' => $request->productos[$i]["id"],
          'id_promocion' => $id_promocion,
          'cantidad_productos' => $request->productos[$i]["cantidad_productos"],
          'precio' => $request->productos[$i]["precio_venta_promocion"]
        ]);
    }
    return response()->json(["mensaje"=>"Productos agregados a las promociones correctamente"]);
   }
  }
  /**
   * Muestra a todas las promociones
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request)
  {
    $promotionProducts = PromotionProduct::name($request->get('name'))->orderBy('nombre','ASC')->paginate(5);
    return view('PromotionProducts/promotionProduct_show',compact('promotionProducts'));

  }
  public function show_options(Request $request){return view('PromotionProducts/promotionProduct_show_options');}
  public function actualizar_options(Request $request){return view('PromotionProducts/promotionProduct_actualizar_options');}
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
   //muestra a todos los usuario para elegir uno y actualizarlo
   public function actualizar(Request $request)
  {
    $promotionProducts = PromotionProduct::name($request->get('name'))->orderBy('nombre','ASC')->paginate(5);
    return view('PromotionProducts.promotionProduct_update',compact('promotionProducts'));
  }
  //ya que se ha eligido uno, se aparta para editarlo
  public function edit($id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $promotionProduct = PromotionProduct::find($id);
    //se returna la vista del formulario que contendrá los datos del elemento
    //a editar
    return view('PromotionProducts.promotionProduct_edit',['promotionProduct'=>$promotionProduct]);
  }
  /**
   * Actualiza el registro en la base de datos
   * Recibe como parámetro un Request, que es el formulario que contiene
   * los datos que se van a actualizar y el id del registro a modificar
   * @param  int  $id
   * @return Response
   */

  public function update(PromotionProductCreateRequest $request,$id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $promotionProduct = PromotionProduct::find($id);
    //se llama a la función que llena el registro con los datos almacenados en
    //el request
    $promotionProduct->fill($request->all());
    //Se guardan los cambios hechos
    $promotionProduct->save();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','Promoción actualizada Correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/promotionProduct/show');

  }

  //Muestra todos los promotionProducts de la base de datos para elegir al que se quiere eliminar
  public function deleter(Request $request)
  {
    $promotionProducts = PromotionProduct::name($request->get('name'))->orderBy('nombre','ASC')->paginate(5);
    return view('PromotionProducts.promotionProduct_delete',compact('promotionProducts'));
  }
  /**
   * Remueve el elemento de la base de datos, recibe como parámetro
   *el id del usuario que se va a eliminar
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $promotionProduct = PromotionProduct::find($id);
		$promotionProduct->delete();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','Promoción eliminada correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/promotionProduct/show');

  }
  public function delete_options(){return view('PromotionProducts.promotionProduct_delete_options');}
}
