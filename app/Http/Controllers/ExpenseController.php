<?php

namespace COEM\Http\Controllers;

use Illuminate\Http\Request;
use COEM\Http\Requests\ExpenseCreateRequest;
use COEM\Http\Requests;
use COEM\Http\Controllers\Controller;
use COEM\Expense;
use Session;
use Redirect;

class ExpenseController extends Controller
{
  /**
   * El método index redirecciona a la página principal de Expenses,
   * mostrando el menú de opciones
   *
   * @return Response
   */
  public function index()
  {
    return view('Expenses/index_expense');
  }

  /**
   * El método create devuelve la vista que tiene el formulario que se
   *llenará para almacenar un nuevo registro
   *
   * @return Response
   */
  public function create()
  {

    return view('Expenses/expense_create');
  }
  public function create_options()
  {

    return view('Expenses/expense_create_options');
  }

  /**
   * Almacena el nuevo elemento en la base de datos,
   * recibe un Request que es el formulario con los datos a registrar.
   *
   * @return Response
   */
  public function store(ExpenseCreateRequest $request)
  {
    //el método create() crea un nuevo registro, se deben asociar los datos del request
    //con las columnas de la tabla
    Expense::create($request->all());
    return redirect('/monthlyExpense/show')->with('message','Se ha agregado un nuevo gasto correctamente');
  }

  /**
   * Muestra a todos los Expenses sin realizar ninguna acción adicional
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request)
  {
    $expenses = Expense::name($request->get('name'))->orderBy('concepto','ASC')->paginate(5);
    return view('Expenses/expense_show',compact('expenses'));

  }
  public function show_options(Request $request){return view('Expenses/expense_show_options');}
  public function show_dos(Request $request){return view('MonthlyExpenses/monthlyExpense_show_options');}
  public function actualizar_options(Request $request){return view('MonthlyExpenses/expense_actualizar_options');}
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
    $expenses = Expense::name($request->get('name'))->orderBy('concepto','ASC')->paginate(5);
    return view('Expenses.expense_update',compact('expenses'));
  }
  //ya que se ha eligido uno, se aparta para editarlo
  public function edit($id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $expense = Expense::find($id);
    //se returna la vista del formulario que contendrá los datos del elemento
    //a editar
    return view('Expenses.expense_edit',['expense'=>$expense]);
  }
  /**
   * Actualiza el registro en la base de datos
   * Recibe como parámetro un Request, que es el formulario que contiene
   * los datos que se van a actualizar y el id del registro a modificar
   * @param  int  $id
   * @return Response
   */

  public function update(ExpenseCreateRequest $request,$id)
  {
    //se encuentra el registro con el id que se busca, y se almacena en una variable
    $expense = Expense::find($id);
    //se llama a la función que llena el registro con los datos almacenados en
    //el request
    $expense->fill($request->all());
    //Se guardan los cambios hechos
    $expense->save();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','Concepto de gasto Actualizado Correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/monthlyExpense/show');

  }

  //Muestra todos los Expenses de la base de datos para elegir al que se quiere eliminar
  public function deleter(Request $request)
  {
    $expenses = Expense::name($request->get('name'))->orderBy('concepto','ASC')->paginate(5);
    return view('Expenses.expense_delete',compact('expenses'));
  }
  /**
   * Remueve el elemento de la base de datos, recibe como parámetro
   *el id del usuario que se va a eliminar
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $expense = Expense::find($id);
		$expense->delete();
    //se manda mensaje mensaje de confirmación
    Session::flash('message','Concepto de gasto eliminado correctamente');
    //Se redirecciona a la vista que muestra los registros
    return Redirect::to('/monthlyExpense/show');

  }
  public function delete_options(){return view('monthlyExpenses.expense_delete_options');}
}
