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

Route::get('Liquidaciones/{fecha?}', 'ventasController@index' )->name('ventas.index');
Route::get('Liquidación/Nueva', 'ventasController@liquidacion' )->name('liquidacion.nueva');
Route::get('Liquidación/Editar/{id}', 'ventasController@edit' )->name('liquidacion.edit');


Route::get('productos/lista/', 'tipoProcesoControler@productosCompleto' )->name('productos.listado');
Route::post('productos/precios/{id}', 'tipoProcesoControler@productosPrecios' )->name('productos.precios.guardar');

Route::post('liquidacion/insertar/', 'tipoProcesoControler@liquidacion_insert' )->name('liquidacion.insertar');
Route::get('Liquidación/Reporte/{id?}', 'tipoProcesoControler@reporteLiquidacion' )->name('liquidacion.reporte');
Route::post('liquidacion/borrar/{id}', 'ventasController@destroy' )->name('liquidacion.borrar');
Route::post('liquidacion/cabecera/editar/', 'tipoProcesoControler@editarCabecera' )->name('liquidacion.cabecera.editar');
Route::post('liquidacion/ventas/crear/', 'tipoProcesoControler@crearVentaFila' )->name('liquidacion.ventas.crearFila');
Route::post('liquidacion/ventas/editar/', 'tipoProcesoControler@editarVentaFila' )->name('liquidacion.ventas.editarFila');
Route::post('liquidacion/ventas/borrar/', 'tipoProcesoControler@borrarVentaFila' )->name('liquidacion.ventas.borrarFila');
Route::post('liquidacion/stock/crear/', 'tipoProcesoControler@crearStockFila' )->name('liquidacion.stock.crearFila');
Route::post('liquidacion/stock/editar/', 'tipoProcesoControler@editarStockFila' )->name('liquidacion.stock.editarFila');
Route::post('liquidacion/stock/borrar/', 'tipoProcesoControler@borrarStockFila' )->name('liquidacion.stock.borrarFila');
Route::post('liquidacion/bonificacion/crear/', 'tipoProcesoControler@crearBonificacionFila' )->name('liquidacion.bonificacion.crearFila');
Route::post('liquidacion/bonificacion/editar/', 'tipoProcesoControler@editarBonificacionFila' )->name('liquidacion.bonificacion.editarFila');
Route::post('liquidacion/bonificacion/borrar/', 'tipoProcesoControler@borrarBonificacionFila' )->name('liquidacion.bonificacion.borrarFila');
Route::post('liquidacion/credito/crear/', 'tipoProcesoControler@crearCreditoFila' )->name('liquidacion.credito.crearFila');
Route::post('liquidacion/credito/editar/', 'tipoProcesoControler@editarCreditoFila' )->name('liquidacion.credito.editarFila');
Route::post('liquidacion/credito/borrar/', 'tipoProcesoControler@borrarCreditoFila' )->name('liquidacion.credito.borrarFila');
Route::post('liquidacion/cobro/crear/', 'tipoProcesoControler@crearCobroFila' )->name('liquidacion.cobro.crearFila');
Route::post('liquidacion/cobro/editar/', 'tipoProcesoControler@editarCobroFila' )->name('liquidacion.cobro.editarFila');
Route::post('liquidacion/cobro/borrar/', 'tipoProcesoControler@borrarCobroFila' )->name('liquidacion.cobro.borrarFila');
Route::post('liquidacion/adelanto/crear/', 'tipoProcesoControler@crearAdelantoFila' )->name('liquidacion.adelanto.crearFila');
Route::post('liquidacion/adelanto/editar/', 'tipoProcesoControler@editarAdelantoFila' )->name('liquidacion.adelanto.editarFila');
Route::post('liquidacion/adelanto/borrar/', 'tipoProcesoControler@borrarAdelantoFila' )->name('liquidacion.adelanto.borrarFila');
Route::post('liquidacion/gasto/crear/', 'tipoProcesoControler@crearGastoFila' )->name('liquidacion.gasto.crearFila');
Route::post('liquidacion/gasto/editar/', 'tipoProcesoControler@editarGastoFila' )->name('liquidacion.gasto.editarFila');
Route::post('liquidacion/gasto/borrar/', 'tipoProcesoControler@borrarGastoFila' )->name('liquidacion.gasto.borrarFila');

Route::get('Reportes/', 'reporteController@index' )->name('reportes.index');
Route::post('Reportes/Resultado', 'reporteController@busqueda' )->name('reportes.busqueda');



Route::get('prueba/', function(){
	dd(Auth::guest());
})->name('prueba');

