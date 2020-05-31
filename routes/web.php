<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');

//Vendedoras
Route::get('vendedoras', 'VendedoraController@index')->name('vendedoras.index');
Route::get('vendedoras/create', 'VendedoraController@create')->name('vendedoras.create');
Route::post('vendedoras', 'VendedoraController@store')->name('vendedoras.store');
Route::get('vendedoras/{vendedora}/edit', 'VendedoraController@edit')->name('vendedoras.edit');
Route::put('vendedoras/{vendedora}', 'VendedoraController@update')->name('vendedoras.update');
Route::delete('vendedoras/delete/{vendedora}', 'VendedoraController@destroy')->name('vendedoras.destroy');


//Prendas
Route::get('prendas', 'PrendaController@index')->name('prendas.index');
Route::get('prendas/create', 'PrendaController@create')->name('prendas.create');
Route::post('prendas', 'PrendaController@store')->name('prendas.store');
Route::get('prendas/{prenda}/edit', 'PrendaController@edit')->name('prendas.edit');
Route::put('prendas/{prenda}', 'PrendaController@update')->name('prendas.update');
Route::delete('prendas/delete/{prenda}', 'PrendaController@destroy')->name('prendas.destroy');
Route::get('prendas/consultar_prenda', 'PrendaController@consultarPrenda')->name('prendas.consultarPrendas');

//Ventas
Route::get('ventas', 'VentaController@index')->name('ventas.index');
Route::get('ventas/resumen', 'VentaController@indexResumen')->name('ventas.indexResumen');
Route::get('ventas/create', 'VentaController@create')->name('ventas.create');
Route::post('ventas', 'VentaController@store')->name('ventas.store');
Route::get('ventas/{venta}/edit', 'VentaController@edit')->name('ventas.edit');
Route::put('ventas/{venta}', 'VentaController@update')->name('ventas.update');
Route::delete('ventas/delete/{venta}', 'VentaController@destroy')->name('ventas.destroy');
Route::get('ventas/consultar_resumen', 'VentaController@consultarResumen')->name('ventas.consultarResumen');
});
