<?php

namespace COEM\Http\Controllers;

  use Illuminate\Support\Collection;
  use Illuminate\Http\Request;
  use COEM\Http\Requests\MonthlyExpenseUpdateRequest;
  use DB;
  use PDF;
  use COEM\Expense;
  use COEM\Medicament;
  use COEM\Date;
  use COEM\Pacient;
  use COEM\Doctor;
  use COEM\MonthlyExpense;
  use COEM\Sale;
  use Carbon\Carbon;
  use COEM\Http\Requests;
  use COEM\Http\Controllers\Controller;
  use Session;
  use Redirect;

  class MonthlyExpenseController extends Controller
  {
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(){}

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          //Se retornan todos los medicamentos y todos los pacientes
          $expenses = Expense::all();

          $fecha_pago = Carbon::now();
          $fecha_pago = $fecha_pago->format('d/m/Y');
          foreach ($expenses as $expense) {
            $id=$expense->id;
            $concepto=$expense->concepto;
            $tipo_gasto=$expense->tipo_gasto;
            $cantidad=$expense->cantidad;
            $expenses_array[] = array('id'=> $id, 'concepto'=> $concepto,
            'tipo_gasto'=> $tipo_gasto, 'cantidad'=> $cantidad, 'fecha_pago'=> $fecha_pago);
          }

          //Se crea el archivo json, si existe, se sobreescribe
          $collection = Collection::make($expenses_array);
          $collection->toJson();
          $file = 'json/gastos.json';
          file_put_contents($file, $collection);
          return view('MonthlyExpenses/monthlyExpenses_create');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request){}
      public function AddItem(Request $request){
          if($request->ajax())
         {
             $expenses= Expense::all();
             for ($i=0; $i < count($request->nuevos_gastos_variables) ; $i++) {
               Expense::create([
                 'concepto' => $request->nuevos_gastos_variables[$i]["concepto"],
                 'tipo_gasto' => $request->nuevos_gastos_variables[$i]["tipo_gasto"],
                 'cantidad' => $request->nuevos_gastos_variables[$i]["cantidad"]
               ]);
               $expenses= Expense::all();
               $fila = $expenses->last();
               MonthlyExpense::create([
           			'id_gasto' => $fila->id,
           			'gasto_mensual' => $fila->cantidad,
           			'fecha_pago' => $request->nuevos_gastos_variables[$i]["fecha_pago"]
           		]);
             }
            for ($i=0; $i < count($request->gastos) ; $i++) {
              MonthlyExpense::create([
          			'id_gasto' => $request->gastos[$i]["id"],
          			'gasto_mensual' => $request->gastos[$i]["cantidad"],
          			'fecha_pago' => $request->gastos[$i]["fecha_pago"]
          		]);
            }
            return response()->json(["mensaje"=>"Gastos mensuales agregadas correctamente,
             se han agregado los nuevos gastos variables a la base de datos"]);
         }
      }
  public function AddReport(Request $request){
      //Se retornan todos los gastos e ingresos entre las fechas
      $fecha_inicial = $request['fecha_inicial'];
      $fecha_final = $request['fecha_final'];
      $expenses = DB::table('monthlyexpenses')
                  ->whereBetween('fecha_pago', [$fecha_inicial, $fecha_final])->get();
      $sales = DB::table('ventas')
                  ->whereBetween('fecha', [$fecha_inicial, $fecha_final])->get();
      /*Se escogen solo las fechas sin repetir del arreglo de los ingresos y gastos elegidos
      para mostrarlos en las tablas*/
      foreach ($sales as $sale) {
        $auxiliar_fechas_ingresos[] = array('fecha'=>$sale->fecha);
      }
      foreach ($expenses as $expense) {
        $auxiliar_fechas_gastos[] = array('fecha'=>$expense->fecha_pago);
      }
      $bandera_busqueda = 0;
      for ($i = 0; $i < count($auxiliar_fechas_ingresos); $i++) {
        $nfecha = $auxiliar_fechas_ingresos[$i]['fecha'];
        if ($i == 0) {
          $fechas[] = array('fecha'=>$nfecha);
        }
        else {
            for ($z = 0; $z< count($fechas); $z++) {
              if ($nfecha == $fechas[$z]['fecha']) {$bandera_busqueda=1;}}
              if ($bandera_busqueda==0) {
                $fechas[] = array('fecha'=>$nfecha);
              }$bandera_busqueda=0;}
      }
      $bandera_busqueda=0;
      for ($i = 0; $i < count($auxiliar_fechas_gastos); $i++) {
        $nfecha = $auxiliar_fechas_gastos[$i]['fecha'];
        if ($i == 0) {
          $fechas[] = array('fecha'=>$nfecha);
        }
        else {
            for ($z = 0; $z< count($fechas); $z++) {
              if ($nfecha == $fechas[$z]['fecha']) {$bandera_busqueda=1;}}
              if ($bandera_busqueda==0) {
                $fechas[] = array('fecha'=>$nfecha);}
                $bandera_busqueda=0;
              }
      }
      /***se ordena el arreglo de fechas***/
      //Se pasan las fechas a un arreglo auxiliar para poder ordenarlos
      usort($fechas, function($a,$b){
        return strtotime($a['fecha']) - strtotime($b['fecha']);
      });
      //Se hace un arreglo de las fechas pasadas a letra
      for ($i = 0; $i < count($fechas); $i++) {
        $fecha = new Carbon($fechas[$i]['fecha']);
        $fecha2 = new Carbon($fechas[$i]['fecha']);
        $fecha=$fecha->format('Y-n-w');
        $fecha2=$fecha2->format('Y-m-d');
        list($year, $month, $day) = explode('-',$fecha);
        list($year2, $month2, $day2) = explode('-',$fecha2);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio",
        "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $diasSemana = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fechasLetra[] = array('fechaLetra'=>$diasSemana[$day]."  ".$day2." de ".
        $meses[$month-1]." de ".$year);
        //echo $fechasLetra[$i]['fechaLetra'].'<br>';
      }

      foreach ($expenses as $expense) {
        $id=$expense->id_gasto;
        $fila_gasto = DB::select("select * from expenses where id='$id'");
        foreach ($fila_gasto as $fila) {
          $concepto = $fila->concepto;
        }
        $cantidad=$expense->gasto_mensual;
        $fecha_1=$expense->fecha_pago;
        $expenses_array[] = array('fecha'=> $fecha_1, 'concepto'=> $concepto,
        'cantidad'=> $cantidad);
      }

      foreach ($sales as $sale) {
        $id_producto = $sale->id_producto;
        $producto = Medicament::find($id_producto);
        $concepto = $producto->nombre;
        $cantidad=$sale->cantidad * $producto->precio_venta;
        $fecha_1=$sale->fecha;
        $earnings_array[] = array('fecha'=> $fecha_1, 'concepto'=> $concepto,
        'cantidad'=> $cantidad, 'area'=>$producto->area);
      }

      $suma_ganancias = 0;
      $suma_imagen = 0;
      $suma_salud = 0;
      $suma_gastos = 0;
      $diferencia = 0;
      foreach ($earnings_array as $earning) {
        $suma_ganancias += $earning["cantidad"];
      }
      foreach ($earnings_array as $earning) {
        if ($earning["area"]=="Área Imagen") {$suma_imagen += $earning["cantidad"];}
      }
      foreach ($earnings_array as $earning) {
        if ($earning["area"]=="Área Salud") {$suma_salud += $earning["cantidad"];}
      }
      foreach ($expenses_array as $expense) {
        $suma_gastos += $expense["cantidad"];
      }
      $diferencia = $suma_ganancias - $suma_gastos;
      //Se crea el archivo json, si existe, se sobreescribe
      $collection = Collection::make($expenses_array);
      $collection->toJson();

      //Se crea el archivo json, si existe, se sobreescribe
      $collection_2 = Collection::make($earnings_array);
      $collection_2->toJson();

      $pdf = PDF::loadView('reporte_balance',['ingresos' => $collection_2,'gastos' => $collection,
      'fecha_inicial' => $fecha_inicial,'fecha_final' => $fecha_final,
      "suma_ganancias" => $suma_ganancias, "suma_imagen" => $suma_imagen, "suma_salud"=>$suma_salud,
      "suma_gastos" => $suma_gastos,"diferencia" => $diferencia,'fechas'=>$fechas,
      'fechasLetra'=>$fechasLetra]);
      $nombre_reporte = 'balance'.$fecha_inicial.'/'.$fecha_final.'.pdf';
      return $pdf ->download($nombre_reporte);
  }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $gastos = Expense::all();
        //El método all() retorna todos los registros
        $expenses = MonthlyExpense::name($request->get('fecha1'))->orderBy('fecha_pago','DESC')->paginate(5);
        return view('MonthlyExpenses/monthlyExpenses_show2',compact('expenses','gastos'));
    }
    public function show_concepto(Request $request)
    {
        $gastos = Expense::all();
        //El método all() retorna todos los registros
        $expenses = MonthlyExpense::nombre($request->get('id_gasto'))->orderBy('fecha_pago','DESC')->paginate(5);
        return view('MonthlyExpenses/monthlyExpenses_show2',compact('expenses','gastos'));
    }

    public function balance(){
      //Se retornan todos los medicamentos y todos los pacientes
      $expenses = MonthlyExpense::all();
      $sales = Sale::all();

      foreach ($expenses as $expense) {
        $id=$expense->id_gasto;
        $fila_gasto = DB::select("select * from expenses where id='$id'");
        foreach ($fila_gasto as $fila) {
          $concepto = $fila->concepto;
        }
        $cantidad=$expense->gasto_mensual;
        $fecha_1=$expense->fecha_pago;
        list($year, $month, $day) = explode('-', $fecha_1);
        $newDate = "{$month}-{$day}-{$year}"; // MM-DD-YYYY
        $expenses_array[] = array('fecha'=> $newDate, 'concepto'=> $concepto,
        'cantidad'=> $cantidad);
      }

      foreach ($sales as $sale) {
        $id_producto = $sale->id_producto;
        $producto = Medicament::find($id_producto);
        $concepto = $producto->nombre;
        $cantidad=$sale->cantidad * $producto->precio_venta;
        $fecha_1=$sale->fecha;
        list($year, $month, $day) = explode('-', $fecha_1);
        $newDate = "{$month}-{$day}-{$year}"; // MM-DD-YYYY
        $earnings_array[] = array('fecha'=> $newDate, 'concepto'=> $concepto,
        'cantidad'=> $cantidad,'area'=>$producto->area);
      }
      //Se crea el archivo json, si existe, se sobreescribe
      $collection = Collection::make($expenses_array);
      $collection->toJson();

      //Se crea el archivo json, si existe, se sobreescribe
      $collection_2 = Collection::make($earnings_array);
      $collection_2->toJson();


      $file = 'json/gastos_mensuales.json';
      file_put_contents($file, $collection);
      $file = 'json/ingresos_mensuales.json';
      file_put_contents($file, $collection_2);
      return view('MonthlyExpenses/MonthlyExpenses_show');
    }

    public function doctors_dates_info(){
      //Se retornan todos los medicamentos y todos los pacientes
      $dates = Date::all();
      foreach ($dates as $date) {
        $id_cita = $date->id;

        $id_paciente = $date->id_paciente;
        $paciente = Pacient::find($id_paciente);
        $nombre_paciente = $paciente->nombre.' '.$paciente->apaterno.' '.$paciente->amaterno;

        $fecha1 = $date->fecha;
        list($year, $month, $day) = explode('-', $fecha1);
        $fecha = "{$month}/{$day}/{$year}"; // MM-DD-YYYY

        $hora=$date->hora;
        $division=$date->division;

        $id_tipo_cita=$date->tipo_cita;
        $producto = Medicament::find($id_tipo_cita);
        $tipo_cita = $producto->nombre;
        $cantidad = $producto->precio_venta;

        $id_doctor = $date->id_doctor;
        $doctor = Doctor::find($id_doctor);
        $nombre_doctor = $doctor->nombre.' '.$doctor->apaterno.' '.$doctor->amaterno;

        $dates_array[] = array('id_cita'=>$id_cita,'paciente'=>$nombre_paciente,'fecha'=>$fecha,
        'hora'=>$hora,'division'=>$division,'tipo_cita'=>$tipo_cita,'doctor'=>$nombre_doctor,
        'cantidad'=>$cantidad);
      }
      //Se crea el archivo json, si existe, se sobreescribe
      $collection_2 = Collection::make($dates_array);
      $collection_2->toJson();

      $doctors = Doctor::all();

      $file = 'json/citas.json';
      $file2 = 'json/doctores.json';
      file_put_contents($file, $collection_2);
      file_put_contents($file2, $doctors);
        return view('MonthlyExpenses/MonthlyExpenses_show_doctors');
    }
    public function AddReportDates(Request $request){
        //Se retornan todos los gastos e ingresos entre las fechas
        $fecha_inicial = $request['fecha_inicial'];
        $fecha_final = $request['fecha_final'];
        $dates = DB::table('dates')
                    ->whereBetween('fecha', [$fecha_inicial, $fecha_final])->get();
        $doctors = Doctor::all();
        /*Se escogen solo las fechas sin repetir del arreglo de los ingresos y gastos elegidos
        para mostrarlos en las tablas*/
        foreach ($dates as $date) {
          $auxiliar_fechas_citas[] = array('fecha'=>$date->fecha);
        }
        $bandera_busqueda = 0;
        for ($i = 0; $i < count($auxiliar_fechas_citas); $i++) {
          $nfecha = $auxiliar_fechas_citas[$i]['fecha'];
          if ($i == 0) {
            $fechas[] = array('fecha'=>$nfecha);
          }
          else {
              for ($z = 0; $z< count($fechas); $z++) {
                if ($nfecha == $fechas[$z]['fecha']) {$bandera_busqueda=1;}}
                if ($bandera_busqueda==0) {$fechas[] = array('fecha'=>$nfecha);}
                $bandera_busqueda=0;
              }
        }

        /***se ordena el arreglo de fechas***/
        //Se pasan las fechas a un arreglo auxiliar para poder ordenarlos
        usort($fechas, function($a,$b){
          return strtotime($a['fecha']) - strtotime($b['fecha']);
        });
        //Se hace un arreglo de las fechas pasadas a letra
        for ($i = 0; $i < count($fechas); $i++) {
          $fecha = new Carbon($fechas[$i]['fecha']);
          $fecha2 = new Carbon($fechas[$i]['fecha']);
          $fecha=$fecha->format('Y-n-w');
          $fecha2=$fecha2->format('Y-m-d');
          list($year, $month, $day) = explode('-',$fecha);
          list($year2, $month2, $day2) = explode('-',$fecha2);
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio",
          "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
          $diasSemana = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
          $fechasLetra[] = array('fechaLetra'=>$diasSemana[$day]."  ".$day2." de ".
          $meses[$month-1]." de ".$year);
        }

        foreach ($dates as $date) {
          $id_cita = $date->id;

          $id_paciente = $date->id_paciente;
          $paciente = Pacient::find($id_paciente);
          $nombre_paciente = $paciente->nombre.' '.$paciente->apaterno.' '.$paciente->amaterno;

          $fecha1 = $date->fecha;
          /*list($year, $month, $day) = explode('-', $fecha1);
          $fecha = "{$month}/{$day}/{$year}"; // MM-DD-YYYY*/

          $hora=$date->hora;
          $division=$date->division;

          $id_tipo_cita=$date->tipo_cita;
          $producto = Medicament::find($id_tipo_cita);
          $tipo_cita = $producto->nombre;
          $cantidad = $producto->precio_venta;

          $id_doctor = $date->id_doctor;
          $doctor = Doctor::find($id_doctor);
          $nombre_doctor = $doctor->nombre.' '.$doctor->apaterno.' '.$doctor->amaterno;

          $dates_array[] = array('id_cita'=>$id_cita,'paciente'=>$nombre_paciente,'fecha'=>$fecha1,
          'hora'=>$hora,'division'=>$division,'tipo_cita'=>$tipo_cita,'doctor'=>$nombre_doctor,
          'cantidad'=>$cantidad);
        }

        $suma_ganancias = 0;
        foreach ($dates_array as $date) {
          $suma_ganancias += $date["cantidad"];
        }

        //Se crea el archivo json, si existe, se sobreescribe
        $collection_2 = Collection::make($dates_array);
        $collection_2->toJson();


        $pdf = PDF::loadView('reporte_citas',['citas' => $collection_2,'doctors' => $doctors,
        'fecha_inicial' => $fecha_inicial,'fecha_final' => $fecha_final,
        "suma_ganancias" => $suma_ganancias,'fechas'=>$fechas,
        'fechasLetra'=>$fechasLetra]);
        $nombre_reporte = 'ReporteCitas'.$fecha_inicial.'/'.$fecha_final.'.pdf';
        return $pdf ->download($nombre_reporte);
    }
    //muestra a todos los usuario para elegir uno y actualizarlo
    public function actualizar(Request $request)
    {
     $gastos = Expense::all();
     $expenses = MonthlyExpense::name($request->get('fecha1'))->orderBy('fecha_pago','DESC')->paginate(5);
     return view('MonthlyExpenses.MonthlyExpense_update',compact('expenses','gastos'));
    }
    //ya que se ha eligido uno, se aparta para editarlo
    public function edit($id)
    {
     $expenses = Expense::all();
     //se encuentra el registro con el id que se busca, y se almacena en una variable
     $monthlyExpense = MonthlyExpense::find($id);
     $id_expense = $monthlyExpense->id_gasto;
     $expense_gasto = Expense::find($id_expense);
     //se returna la vista del formulario que contendrá los datos del elemento
     //a editar
     return view('MonthlyExpenses.monthlyExpense_edit',['monthlyExpense'=>$monthlyExpense,
     'expenses'=>$expenses,'expense_gasto'=>$expense_gasto]);
    }
    /**
    * Actualiza el registro en la base de datos
    * Recibe como parámetro un Request, que es el formulario que contiene
    * los datos que se van a actualizar y el id del registro a modificar
    * @param  int  $id
    * @return Response
    */

    public function update(MonthlyExpenseUpdateRequest $request,$id)
    {
     //se encuentra el registro con el id que se busca, y se almacena en una variable
     $expense = MonthlyExpense::find($id);
     //se llama a la función que llena el registro con los datos almacenados en
     //el request
     $expense->fill($request->all());
     //Se guardan los cambios hechos
     $expense->save();
     //se manda mensaje mensaje de confirmación
     Session::flash('message','Gasto Actualizado Correctamente');
     //Se redirecciona a la vista que muestra los registros
     return Redirect::to('/monthlyExpense/show');

    }

    //Muestra todos los Expenses de la base de datos para elegir al que se quiere eliminar
    public function deleter(Request $request)
    {
      $gastos = Expense::all();
      $expenses = MonthlyExpense::name($request->get('fecha1'))->orderBy('fecha_pago','DESC')->paginate(5);
      return view('MonthlyExpenses.monthlyExpense_delete',compact('expenses','gastos'));
    }
    /**
     * Remueve el elemento de la base de datos, recibe como parámetro
     *el id del usuario que se va a eliminar
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      $expense = MonthlyExpense::find($id);
  		$expense->delete();
      //se manda mensaje mensaje de confirmación
      Session::flash('message','Gasto eliminado correctamente');
      //Se redirecciona a la vista que muestra los registros
      return Redirect::to('/monthlyExpense/show');

    }
  }
