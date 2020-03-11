<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use Carbon\Carbon;

class ventasController extends Controller
{
	public function __construct() { $this->middleware('auth'); }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fecha=''){
			if($fecha!=''){
				$liquidaciones = App\Liquidacion::where('fecha', $fecha)->where('activo', 1)->get();
				
				//$liquidaciones = App\Liquidacion::find(1)->usuarios;
				//return $liquidaciones;
				$fechaMaster = $fecha;
				return view('ventas.index', compact('liquidaciones', 'fechaMaster'));
			}else{
				$liquidaciones = App\Liquidacion::where('fecha', Carbon::now()->format('Y-m-d') )->where('activo', 1)->get();
				//return $liquidaciones;
				$fechaMaster = date('Y-m-d');
				return view('ventas.index', compact('liquidaciones', 'fechaMaster'));
			}
    }
    public function liquidacion(){
			$comprobantes = App\comprobantes::all()->toJson();
			$destinos = App\DestinoGasto::orderBy('destino', 'asc')->get()->toJson();

			$lugares = App\Liquidacion::select('lugar')->whereNotNull('lugar')->get()->toJson();
			$vendedores = App\Liquidacion::select('vendedor')->whereNotNull('vendedor')->get()->toJson();
			$placas = App\Liquidacion::select('placa')->whereNotNull('placa')->get()->toJson();
			$productos = DB::table('productos')
								->join('tipo_productos', 'tipo_productos.id', '=', 'productos.tipo_productos_id')
								->join('tipo_displays', 'tipo_displays.id', '=', 'productos.tipo_displays_id')
								->join('marca_displays', 'marca_displays.id', '=', 'productos.marca_displays_id')
								->select('productos.id', 'productos.precioMayor', 'productos.descripcion', DB::raw('case productos.tipo_displays_id when 6 then "" else concat(tipo_productos.descripcion, " ", tipo_displays.descripcion," ", marca_displays.descripcion ) end as presentacion'), DB::raw('case tipo_displays_id when 1 then concat(productos.peso, " kg.") when 2 then concat(cast(productos.cantidad as int), "x", cast(productos.cantidad_x_display as int)) when 6 then "" else concat(cast(productos.cantidad as int), " Und." )
								 end as contenido') )->orderby('presentacion', 'asc')->get()->toJson();
			//return $productos;

			//return $placas;
      return view('ventas.liquidacion', compact('comprobantes', 'destinos', 'lugares', 'vendedores', 'placas', 'productos'));
		}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$liquidacion = App\Liquidacion::find($id);
			$liquidacion -> activo = 0;
			$liquidacion -> save();
			return back();
    }
}
