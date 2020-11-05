<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {

    return view('alte');
});*/

/*Route::get('/', function () {

    return view('alte');
})->middleware('auth');*/


Route::get('/', function () {

      return view('alte');
  
  })->middleware('auth');;


Route::resource('categorias', 'CategoriaController');
Route::resource('gastos', 'GastoController');
Route::resource('gastods', 'GastodController');
Route::resource('personas', 'PersonaController');
Route::resource('productos', 'ProductoController');
Route::resource('facturas', 'FacturaController');
Route::resource('ingresos', 'IngresoController');
Route::resource('inventarios', 'InventarioController');
Route::resource('ventas', 'VentaController');
Route::resource('pagos', 'PagoController');

Route::get('/imprimir', 'PDFController@imprimir')->name('imprimir');


Route::get('/info', array('as'=>'info','uses'=>'VentaController@create'));


Route::get('/findPrice', array('as'=>'findPrice','uses'=>'VentaController@findPrice'));

Route::post('/insert',array('as'=>'insert','uses'=>'VentaController@insert'));


//Route::get('/pdfproductos', 'PDFController@PDFProductos')->name('descargarPDFProductos');

Route::get('/pdf', 'ReporteriaController@reporteFacturas');
Route::get('reporterias/facturasPDF', 'ReporteriaController@reporteFacturasPDF');

Route::get('/pdfventas', 'ReporteriaController@reporteVentas');
Route::get('reporterias/ventasPDF', 'ReporteriaController@reporteVentasPDF');


Auth::routes(['register'=>false,'reset'=>false,'email'=>false]);

//Route::get('/home', 'HomeController@index')->name('home');



