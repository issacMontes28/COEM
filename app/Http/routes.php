<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
|Notas por Issac:
| Es importante siempre poner las rutas resource hasta el final, para que no genere confuciones
| con las rutas que tú mismo especifícas
*/
use Illuminate\Http\Request;
//Rutas para inicios de sesión
Route::resource('log', 'LogController');
Route::get('logout','LogController@logout');

//Rutas generales
Route::get('/', 'WelcomeController@index');
Route::get('index', 'WelcomeController@indexdos');

//Rutas para usuarios
Route::get('user/actualizar','UserController@actualizar');
Route::get('user/deleter','UserController@deleter');
Route::resource('user', 'UserController');

//Rutas para pacientes
Route::get('pacient/deleter','PacientController@deleter');
Route::get('pacient/actualizar','PacientController@actualizar');
Route::get('/pacient/addate/{id}',
['uses' => 'PacientController@adddate', 'as' => 'asignar_cita_paciente']);
Route::get('/date/show/sale/{id}',
['uses' => 'SalesController@addsale', 'as' => 'asignar_venta_cita']);
Route::POST('date/show/sale/dateSale/agregarVentaCita',
['uses' => 'SalesController@AddItem', 'as' => 'agregarVentaCita']);
Route::resource('pacient', 'PacientController');

//Rutas para medicamentos
Route::get('medicament/deleter','MedicamentController@deleter');
Route::get('medicament/actualizar','MedicamentController@actualizar');
Route::resource('medicament', 'MedicamentController');

//Rutas para doctores
Route::get('doctor/deleter','DoctorController@deleter');
Route::get('doctor/actualizar','DoctorController@actualizar');
Route::resource('doctor', 'DoctorController');

//Rutas para proveedores
Route::get('provider/deleter','ProviderController@deleter');
Route::get('provider/actualizar','ProviderController@actualizar');
Route::resource('provider', 'ProviderController');

//Rutas para citas
Route::get('date/deleter','DateController@deleter');
Route::get('date/actualizar','DateController@actualizar');
Route::get('date/bitacora','Date_actionController@show');
Route::get('date/show_pacient','DateController@show_pacient');
Route::get('/date/show/{id}',
['uses' => 'DateController@show_date_pacient', 'as' => 'paciente_cita']);
Route::get('/date/bitacora/{id}',
['uses' => 'Date_actionController@bitacora_paciente', 'as' => 'paciente_bitacora']);
Route::resource('date', 'DateController');
Route::resource('date_action', 'Date_actionController');

//Rutas para ventas
//Ruta para escoger si se realizará una venta en base a una cita o a un cliente
Route::get('sale/create_options','SalesController@create_options');
//Ruta para añadir una venta en base a una cita
Route::get('sale/create_venta_cliente','SalesController@create_venta_cliente');
//Ruta para añadir una venta en base a un cliente
Route::post('sale/sales/AddItem','SalesController@AddItem');
Route::get('/sale/show/{id}',
['uses' => 'SalesController@show_dos', 'as' => 'ventas_paciente']);
Route::resource('sale', 'SalesController');

//Rutas para gastos
Route::get('expense/create_options','ExpenseController@create_options');
Route::get('expense/show_options','ExpenseController@show_options');
Route::get('expense/show_dos','ExpenseController@show_dos');
//Ruta para escoger si se elimina un concepto de gasto o gastos mensuales
Route::get('expense/delete_options','ExpenseController@delete_options');
Route::get('expense/actualizar_options','ExpenseController@actualizar_options');
Route::get('expense/actualizar','ExpenseController@actualizar');
Route::get('expense/deleter','ExpenseController@deleter');
Route::resource('expense', 'ExpenseController');

//Rutas para Promociones
Route::get('promotion/create_options','PromotionController@create_options');
Route::get('promotion/show_options','PromotionController@show_options');
Route::get('promotion/show_dos','PromotionController@show_dos');
//Ruta para escoger si se elimina un concepto de gasto o gastos mensuales
Route::get('promotion/delete_options','PromotionController@delete_options');
Route::get('promotion/actualizar_options','PromotionController@actualizar_options');
Route::get('promotion/actualizar','PromotionController@actualizar');
Route::get('promotion/deleter','PromotionController@deleter');
Route::resource('promotion', 'PromotionController');


//Rutas para asignación de productos a las promociones
Route::get('promotionProduct/show_options','PromotionController@show_options');
Route::get('promotionProduct/show_dos','PromotionController@show_dos');
//Ruta para escoger si se elimina un concepto de gasto o gastos mensuales
Route::get('promotionProduct/actualizar','PromotionProductController@actualizar');
Route::get('promotionProduct/deleter','PromotionProductController@deleter');
//Ruta para añadir productos a las promociones
Route::post('promotionProduct/promotionProduct/AddItem','PromotionProductController@AddItem');
Route::resource('promotionProduct', 'PromotionProductController');

//Rutas para gastos mensuales
Route::get('monthlyExpense/actualizar','MonthlyExpenseController@actualizar');
Route::get('monthlyExpense/deleter','MonthlyExpenseController@deleter');
Route::get('monthlyExpense/balance','MonthlyExpenseController@balance');
Route::get('/monthlyExpense/doctors_dates_info','MonthlyExpenseController@doctors_dates_info');
//Ruta para añadir los gastos mensuales
Route::post('monthlyExpense/monthlyExpenses/AddItem','MonthlyExpenseController@AddItem');
//Ruta para reporte de gastos en un rango de fechas
Route::post('monthlyExpense/monthlyExpenses/AddReport','MonthlyExpenseController@AddReport');
//Ruta para reporte de citas en un rango de fechas
Route::post('monthlyExpense/monthlyExpenses/AddReportDates','MonthlyExpenseController@AddReportDates');
Route::get('/monthlyExpense/show/{id}',
['uses' => 'MonthlyExpenseController@show_concepto', 'as' => 'concepto']);
Route::resource('monthlyExpense', 'MonthlyExpenseController');

Route::get('/pdf','SalesController@reporte');
Route::get('peso','DateController@historial_pesos');


/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
