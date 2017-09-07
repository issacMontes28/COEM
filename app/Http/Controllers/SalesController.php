<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;
use PDF;
use COEM\Sale;
use COEM\Medicament;
use COEM\Date;
use COEM\Pacient;
use COEM\Promotion;
use COEM\PromotionProduct;
use Carbon\Carbon;
use COEM\Http\Requests;
use COEM\Http\Controllers\Controller;
use Session;
use Redirect;


class SalesController extends Controller
{
    /**
     * Regresa en menú de ventas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Ventas/index');
    }
    //Se usa para generar una nueva venta desde el menú de consultas
    public function addsale($id)
    {
      $medicaments = DB::select("select * from medicaments where tipo!='Consulta'");

      //Se recuperan las promociones y los productos de éstas.
      $promotions = Promotion::all();
      $promotionProducts = PromotionProduct::all();

      $date = Date::find($id);
      //obtenemos el id de la cita
      $id_paciente=$date->id_paciente;
      //se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
      $filas = DB::select("select * from pacients where id='$id_paciente'");
      foreach ($filas as $fila) {
        $pac = $fila->nombre.' '.$fila->apaterno.' '.$fila->amaterno;
      }

      $id=$date->id;
      $division=$date->division;
      //Se saca el tipo de cita, el cual es una lláve foránea de la tabla productos
      $tipo_cita=$date->tipo_cita;
      $filas2 = DB::select("select * from medicaments where id='$tipo_cita'");
      //se extraen los datos del tipo de cita.
      foreach ($filas2 as $fila2) {
        $id_producto = $fila2->id;
        $producto = $fila2->nombre;
        $precio_cita = $fila2->precio_venta;
        $precio_cita_tarjeta = $fila2->precio_venta_tarjeta;
      }
      $fecha=$date->fecha;
      $hora=$date->hora;

      $date_1[] = array('id'=> $id, 'id_cliente'=>$id_paciente,'paciente'=> $pac,
      'tipo_cita'=> $tipo_cita,'id_producto'=>$id_producto,'producto'=> $producto,
      'id_producto'=>$id_producto,'cantidad'=>'1' ,'subtotal'=>$precio_cita,
      'precio_cita'=>$precio_cita,'precio_cita_tarjeta'=>$precio_cita_tarjeta,
      'fecha'=> $fecha, 'hora'=> $hora,'division'=>$division,'id_promocion'=>1,
      'promocion'=>'Ninguna');

      $collection = Collection::make($date_1);
      $collection->toJson();

      $collection2 = Collection::make($medicaments);
      $collection2->toJson();
      //Se crea el archivo json, si existe, se sobreescribe
      $file = 'json/medicamentos.json';
      file_put_contents($file, $collection2);
      $file = 'json/cita_venta.json';
      file_put_contents($file, $collection);
      $file = 'json/promotions.json';
      file_put_contents($file, $promotions);
      $file = 'json/promotionProducts.json';
      file_put_contents($file, $promotionProducts);

      return view('Ventas/venta_create2');
    }
    /**
     * Muestra las opciones para crear una venta
     *
     * @return \Illuminate\Http\Response
     */
    public function create_options()
    {
        return view('Ventas/create_options');
    }
    /**
     * Muestra el formulario para una nueva venta en base a una cita
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       $medicaments = DB::select("select * from medicaments where tipo!='Consulta'");
       $dates = Date::all();

       foreach($dates as $date)
        {
           //obtenemos el id de la cita
           $id_paciente=$date->id_paciente;
           //se obtienen los datos de esa cita, interesa el nombre del paciente y el doctor que lo está atendiendo
           $filas = DB::select("select * from pacients where id='$id_paciente'");
           foreach ($filas as $fila) {
             $pac = $fila->nombre.' '.$fila->apaterno.' '.$fila->amaterno;
           }

           $id=$date->id;
           $division=$date->division;
           $tipo_cita=$date->tipo_cita;
           $filas2 = DB::select("select * from medicaments where id='$tipo_cita'");
           foreach ($filas2 as $fila2) {
             $id_producto = $fila2->id;
             $producto = $fila2->nombre;
             $precio_cita = $fila2->precio_venta;
           }
           $fecha=$date->fecha;
           $hora=$date->hora;

           $dates_1[] = array('id'=> $id, 'id_cliente'=>$id_paciente,'paciente'=> $pac,
           'tipo_cita'=> $tipo_cita,'id_producto'=>$id_producto , 'producto'=> $producto,
           'cantidad'=>'1' ,'subtotal'=>$precio_cita,'fecha'=> $fecha, 'hora'=> $hora,'division'=>$division);
        }

        $collection = Collection::make($dates_1);
        $collection->toJson();

        $collection2 = Collection::make($medicaments);
        $collection2->toJson();
        //Se crea el archivo json, si existe, se sobreescribe
        $file = 'json/citas.json';
        file_put_contents($file, $collection);
        $file = 'json/medicamentos.json';
        file_put_contents($file, $collection2);

         return view('Ventas/venta_create');
     }
    //Método para pasar lo mismo que el método anterior, solo que en vez de citas serán clientes
    public function create_venta_cliente()
    {
      //Se retornan todos los medicamentos y todos los pacientes
      $medicaments = DB::select("select * from medicaments where tipo!='Servicio'");
      $pacients = Pacient::all();

      foreach ($pacients as $pacient) {
        $id=$pacient->id;
        $nombre=$pacient->nombre;
        $apaterno=$pacient->apaterno;
        $amaterno=$pacient->amaterno;
        $correo=$pacient->correo;
        $fecha_inicio=$pacient->fecha_inicio;
        $peso=$pacient->kilos;

        $pac = $nombre.' '.$apaterno.' '.$amaterno;

        $pacient_array[] = array('id'=> $id, 'cliente'=> $pac,
        'correo'=> $correo, 'fecha_inicio'=> $fecha_inicio, 'peso'=> $peso);
      }

      //Se convierten a objetos json ya que knockout lee ese formato
      $collection = Collection::make($pacient_array);
      $collection->toJson();

      $collection2 = Collection::make($medicaments);
      $collection2->toJson();

      //Se crea el archivo json, si existe, se sobreescribe
      $file = 'json/clientes.json';
      file_put_contents($file, $collection);
      $file = 'json/medicamentos.json';
      file_put_contents($file, $collection2);

      return view('Ventas/venta_cliente_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //no lo utilizo ya que no lo puedo invocar desde ajax()
    public function store(Request $request){}
    //Método que agrega ventas a la tabla que factura mediante la cita
    public function AddItem(Request $request)
    {
        if($request->ajax()){
          $fecha = Carbon::now();
          $total = Sale::all()->count();
          if($total==0){
              $nfactura = 9620;
          }else{
            $ventas= Sale::all();
            $ultima_venta = $ventas->last();
            $ufactura = $ultima_venta->nfactura;
            $nfactura = $ufactura + 1;
          }

          for ($i=0; $i < count($request->ventas) ; $i++) {
            $id_producto = $request->ventas[$i]["id_producto"];
            if ($id_producto=="ndepilacion" || $id_producto="nmesoterapia") {
               if ($id_producto=="ndepilacion" ) {
                 $tipo_producto = "Fotodepilación";
               }
               else {
                 $tipo_producto = "Mesoterapia";
               }

              $precio_unitario = $request->ventas[$i]['subtotal']/$request->ventas[$i]['cantidad'];
              if ($request->ventas[$i]["promocion"]!=null) {
                $promocion=$request->ventas[$i]["promocion"];}
              else {$promocion=1;}
              Medicament::create([
          		'nombre' => $request->ventas[$i]['producto'],
          		'descripcion' => "-",
          		'tipo' => $tipo_producto,
          		'existencias' => 0,
          		'precio_compra' => $precio_unitario - 50,
          		'precio_venta' => $precio_unitario,
          		'precio_venta_tarjeta' => $precio_unitario + 50,
          		'id_proveedor' => "6",
              'area' => "Área Bienestar",
              'imagen' => ""]);
              $medicamentos= Medicament::all();
              $umedicamento= $medicamentos->last();
              Sale::create([
                'id_cliente' => $request->ventas[$i]["id_cliente"],
          			'id_producto' => $umedicamento->id,
          			'cantidad' => $request->ventas[$i]["cantidad"],
          			'fecha' => $fecha,
                'nfactura' => $nfactura,
                'forma_pago' => $request->ventas[$i]["formaPago"],
                'id_promocion'=> $promocion
          		]);
            }
            else {
              $filas2 = DB::select("select * from medicaments where id='$id_producto'");
              foreach ($filas2 as $fila2) {
                $existencias_actuales = $fila2->existencias;
                $descuento_existencias = $request->ventas[$i]["cantidad"];
                $llenar_producto = Medicament::find($id_producto);
                if ($llenar_producto->tipo!="Servicio" && $llenar_producto->tipo!="Consulta" && $llenar_producto->tipo!="Fotodepilación") {
                  $llenar_producto->fill([
                    'existencias' => $existencias_actuales - $descuento_existencias
                  ]);
                  //Se guardan los cambios hechos
                  $llenar_producto->save();
                }
              }
              if ($request->ventas[$i]["promocion"]!=null) {
                $promocion=$request->ventas[$i]["promocion"];
              }
              else {$promocion=1;}
              Sale::create([
                'id_cliente' => $request->ventas[$i]["id_cliente"],
          			'id_producto' => $id_producto,
          			'cantidad' => $request->ventas[$i]["cantidad"],
          			'fecha' => $fecha,
                'nfactura' => $nfactura,
                'forma_pago' => $request->ventas[$i]["formaPago"],
                'id_promocion'=> $promocion
          		]);
            }
          }
          return response()->json(["mensaje"=>"Ventas agregadas correctamente"]);
          //self::reporte($request);
       }
    }
    public function reporte(){
      $fecha = Carbon::now();
      $ventas= Sale::all();
      $ultima_venta = $ventas->last();

      $ufactura = $ultima_venta->nfactura;
      $id_cliente = $ultima_venta->id_cliente;
      $forma_pago = $ultima_venta->forma_pago;
      $promocion = $ultima_venta->id_promocion;
      $clientes = DB::select("select * from pacients where id='$id_cliente'");
      foreach ($clientes as $paciente) {
        $nombre_paciente = $paciente->nombre.' '.$paciente->apaterno.' '.$paciente->amaterno;
      }
      $promociones = DB::select("select * from promotions where id='$promocion'");
      foreach ($promociones as $promotion) {
        $nombre_promocion = $promotion->nombre;
        $tipo_promocion = $promotion->tipo;
      }
      $fila_venta = DB::select("select * from ventas where nfactura='$ufactura'");
      foreach ($fila_venta as $fila) {
        $id_producto = $fila->id_producto;
        $producto = Medicament::find($id_producto);
        $precio_venta = $producto->precio_venta;
        $precio_venta_tarjeta = $producto->precio_venta_tarjeta;
        $cantidad = $fila->cantidad;
        if ($forma_pago=="Efectivo") {$subtotal = $precio_venta * $cantidad;}
        else {$subtotal = $precio_venta_tarjeta * $cantidad; $precio_venta=$precio_venta_tarjeta;}
        $fila_promotion_product = DB::select("select * from promotionproducts where
        id_producto='$id_producto' and id_promocion='$promocion'");
        foreach ($fila_promotion_product as $promotion_product) {
          if ($tipo_promocion=="Precios especiales") {
            $precio_venta = $promotion_product->precio;
            $subtotal = $precio_venta * $cantidad;
          }
        }
        $ventas_array[] = array('producto'=> $producto->nombre, 'precio_unitario'=> $precio_venta,
        'cantidad'=> $fila->cantidad, 'subtotal'=>$subtotal);
        $ventas = Collection::make($ventas_array);
      }
      $pdf = PDF::loadView('ticket',['ventas' => $ventas,
      'cliente' => $nombre_paciente,'factura' => $ufactura, 'forma_pago'=>$forma_pago,
      'promocion'=>$promocion]);
      $nombre_ticket = 'notaCompra'.$nombre_paciente.$fecha.'.pdf';
      return $pdf ->download($nombre_ticket);

  }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      $sales = Sale::fecha($request->get('fecha1'))->orderBy('fecha','ASC')->paginate(5);
      $pacients = DB::table('pacients')
                  ->orderBy('apaterno', 'asc')
                  ->get();
      return view('Ventas/ventas_show',compact('sales','pacients'));
    }
    public function show_dos(Request $request)
    {
      $sales = Sale::name($request->get('cliente1'))->orderBy('fecha','ASC')->paginate(5);
      $pacients = DB::table('pacients')
                  ->orderBy('apaterno', 'asc')
                  ->get();
      return view('Ventas/ventas_show',compact('sales','pacients'));
    }
    public function destroy($id)
    {
      $sale = Sale::find($id);
      $sale->delete();
      //se manda mensaje mensaje de confirmación
      Session::flash('message','Venta eliminada correctamente');
      //Se redirecciona a la vista que muestra los registros
      return Redirect::to('/sale/show');
    }
}
