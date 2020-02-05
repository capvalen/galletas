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
	return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('logout', function(){
    return redirect('login')->with(Auth::logout());
} );

Route::get('panel', 'frontend@index' )->name('panel');

Route::get('clientes', function(){ return view('clientes.inicio'); })->name('clientes');
Route::get('cliente/nuevo', function(){ return view('clientes.crear'); })->name('clientes.nuevo');
Route::get('cliente/editar', function(){ return view('clientes.editar'); })->name('clientes.editar');
Route::get('clientes/historial', function(){ return view('clientes.historial'); })->name('clientes.historial');

Route::get('compras', 'frontend@compras' )->name('compras'); //proveedoresControler@show
Route::get('compra/nuevo', 'frontend@comprasNuevo')->name('compras.nuevo');
Route::get('compra/editar', function(){ /* return view('compras.editar'); */ })->name('compras.editar');
Route::get('compra/historial', function(){ return view('compras.historial'); })->name('compras.historial');
Route::post('compra/insertar', 'comprasController@store' )->name('compra.insertar');

Route::get('caja', 'frontend@caja' )->name('caja');

Route::get('proveedores/crear', 'frontend@crearProveedor' )->name('proveedores.crear');
Route::post('proveedores/insertar', 'proveedoresControler@store' )->name('proveedor.insertar');

Route::get('marcas/todos', 'marcasController@show' )->name('marcas.todos');
Route::get('insumos/todos', 'insumosController@show' )->name('insumos.todos');

Route::get('galeria/subir', 'galeriaControler@subida' )->name('galeria.subida');
Route::get('galeria/mostrar/{fecha?}', 'galeriaControler@index' )->name('galeria.mostrar');
Route::get('galeria/mostrar/{fecha?}/grupo/{grupo?}', 'galeriaControler@grupo' )->name('galeria.mostrar.grupo');
Route::get('galeria/editar/{id}', 'galeriaControler@edit' )->name('galeria.editar');
Route::post('fotos/editar/{id}', 'galeriaControler@update' )->name('galeria.update');
Route::post('fotos/subida', 'galeriaControler@store' )->name('galeria.subir');
Route::post('fotos/borrar', 'galeriaControler@destroy' )->name('galeria.borrar');

Route::get('tipoProceso/nuevo/', 'tipoProcesoControler@index' )->name('tproceso.nuevo');
Route::post('tipoProceso/nuevo/', 'tipoProcesoControler@store' )->name('tproceso.crear');
Route::post('tipoProceso/eliminar/{id}', 'tipoProcesoControler@destroy' )->name('tproceso.eliminar');

Route::get('ventas/', 'ventasController@index' )->name('ventas.index');
Route::get('ventas/liquidacion', 'ventasController@liquidacion' )->name('liquidacion.nueva');


Route::post('liquidacion/insertar/', 'tipoProcesoControler@liquidacion_insert' )->name('liquidacion.insertar');