<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
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

			$lugares = App\liquidacion::select('lugar')->whereNotNull('lugar')->get()->toJson();
			$vendedores = App\liquidacion::select('vendedor')->whereNotNull('vendedor')->get()->toJson();
			$placas = App\liquidacion::select('placa')->whereNotNull('placa')->get()->toJson();
			//return $placas;
      return view('ventas.liquidacion', compact('comprobantes', 'destinos', 'lugares', 'vendedores', 'placas'));
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
        //
    }
}
