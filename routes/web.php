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

Route::get('compras', function(){ return view('compras.inicio'); })->name('compras');
Route::get('compra/nuevo', function(){ return view('compras.crear'); })->name('compras.nuevo');
Route::get('compra/editar', function(){ /* return view('compras.editar'); */ })->name('compras.editar');
Route::get('compra/historial', function(){ return view('compras.historial'); })->name('compras.historial');

Route::get('caja', 'frontend@caja' )->name('caja');