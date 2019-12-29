<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;
use DB;
//use App\Proveedores;

class frontend extends Controller
{
    //
    public function __construct(){
        //if (Auth::guest()){ return redirect('/login'); }else{  return view('plantillas.inicio');}
        $this->middleware('auth');
    }
    public function index(){
        return view('plantillas.inicio');
    }
    public function caja(){ return view('caja.cajaInicio'); }

    public function compras(){ 
				$proveedores = App\Proveedores::where('activo',1)->get();
        //$proveedores = DB::table('proveedores')->get();
        return view('compras.inicio', compact('proveedores')); 
		}
    public function comprasNuevo(){ 
				$proveedores = App\Proveedores::where('activo',1)->get();
				$categorias = App\CategoriaCompras::where('activo',1)->get();
				$monedas = App\Moneda::all();
				$comprobantes = App\Comprobantes::where('activo',1)->get();
				$unidades = App\Unidades::all();
				$marcas = App\Marcas::all();
				$insumos = App\Insumos::all();
				//$proveedores = DB::table('proveedores')->get();
				//return $insumos;
				return view('compras.crear', compact('proveedores', 'categorias', 'monedas', 'comprobantes', 'unidades', 'marcas', 'insumos' ));
		}
		
		public function crearProveedor(){
			return view('proveedores.crear'); 
		}
}
