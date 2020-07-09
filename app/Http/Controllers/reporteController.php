<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use Carbon\Carbon;

class reporteController extends Controller
{
    public function index()
    {
			$desde=date('Y-m-d');
			$hasta=date('Y-m-d');
			$lugares = App\Liquidacion::select('lugar')->whereNotNull('lugar')->groupBy('lugar')->orderBy('lugar')->get();
			$sellers = App\Liquidacion::select('vendedor')->whereNotNull('vendedor')->groupBy('vendedor')->orderBy('vendedor')->get();
		//	return $lugares;
      return view('reportes.index', compact('desde', 'hasta', 'lugares', 'sellers'));
    }

    public function busqueda(Request $request)
    {
			//return $request;
			$desde=Carbon::createFromFormat('d/m/Y', $request->start )->isoFormat('YYYY-MM-DD');
			$hasta=Carbon::createFromFormat('d/m/Y', $request->end )->isoFormat('YYYY-MM-DD');
			$lugares = App\Liquidacion::select('lugar')->whereNotNull('lugar')->groupBy('lugar')->orderBy('lugar')->get();
			$sellers = App\Liquidacion::select('vendedor')->whereNotNull('vendedor')->groupBy('vendedor')->orderBy('vendedor')->get();
			//return $sellers;
			$tipo= $request->tipoReporte;
			$gastos = collect();

			$inicio = Carbon::createFromFormat('d/m/Y', $request->start )->isoFormat('YYYY-MM-DD')." 00:00:00";
			$fin = Carbon::createFromFormat('d/m/Y', $request->end )->isoFormat('YYYY-MM-DD')." 23:59:59";

			switch ($tipo) {
					case 'R0': return back()->with('mensaje', 'Debes selecionar un tipo de reporte válido'); break;
					case 'R1':
							$productos = DB::table('productos')
							->join('tipo_productos', 'tipo_productos.id', '=', 'productos.tipo_productos_id')
							->join('tipo_displays', 'tipo_displays.id', '=', 'productos.tipo_displays_id')
							->join('marca_displays', 'marca_displays.id', '=', 'productos.marca_displays_id')
							->select('productos.id', 'productos.precioMayor', 'productos.descripcion', DB::raw('case productos.tipo_displays_id when 6 then "" else concat(tipo_productos.descripcion, " ", tipo_displays.descripcion," ", marca_displays.descripcion ) end as presentacion'), DB::raw('case tipo_displays_id when 1 then concat(productos.peso, " kg.") when 2 then concat(cast(productos.cantidad as int), "x", cast(productos.cantidad_x_display as int)) when 6 then "" else concat(cast(productos.cantidad as int), " Und." )
								end as contenido') )->where('activo', 1)->orderby('presentacion', 'asc')->get()->toJson();

							/* 	$contado = DB::table('liquidacions')
								->join('ventas_contados', 'liquidacions.id', '=', 'ventas_contados.liquidacion_id')
								->whereBetween('liquidacions.created_at', [$inicio, $fin])
								->get(); */

							$vContado = App\ventasContado::join('liquidacions', 'liquidacions.id', '=', 'ventas_contados.liquidacion_id')
								->select('idPresentacion')->selectRaw('sum(cantidad) as suma')->groupBy('idPresentacion')
								->whereBetween('liquidacions.created_at', [$inicio, $fin])
								->get();
						
							$vCredito = App\ventasCredito::join('liquidacions', 'liquidacions.id', '=', 'ventas_creditos.liquidacion_id')
								->select('idPresentacion')->selectRaw('sum(cantidad) as suma')->groupBy('idPresentacion')
								->whereBetween('liquidacions.created_at', [$inicio, $fin])
								->get();

							$vBonificacion = App\VentasBonificacion::join('liquidacions', 'liquidacions.id', '=', 'ventas_bonificacions.liquidacion_id')
								->select('idPresentacion')->selectRaw('sum(bonificacion) as suma')->groupBy('idPresentacion')
								->whereBetween('liquidacions.created_at', [$inicio, $fin])->where('esBono', 1)
								->get();
							
							$vBonificacionAdela = App\VentasAdelanto::join('liquidacions', 'liquidacions.id', '=', 'ventas_adelantos.liquidacion_id')
							->select('idPresentacion')->selectRaw('sum(bonificacion) as suma')->groupBy('idPresentacion')
							->whereBetween('liquidacions.created_at', [$inicio, $fin])->where('bonificacion', '>', 0)
							->get();

							$vAdelanto = App\VentasAdelanto::join('liquidacions', 'liquidacions.id', '=', 'ventas_adelantos.liquidacion_id')
							->select('idPresentacion')->selectRaw('sum(cantidad) as suma')->groupBy('idPresentacion')
							->whereBetween('liquidacions.created_at', [$inicio, $fin])
							->get();

							$vDegustacion = App\VentasBonificacion::join('liquidacions', 'liquidacions.id', '=', 'ventas_bonificacions.liquidacion_id')
								->select('idPresentacion')->selectRaw('sum(bonificacion) as suma')->groupBy('idPresentacion')
								->whereBetween('liquidacions.created_at', [$inicio, $fin])->where('esBono', 0)
								->get();
							//return $vBonificacionAdela;
							return view('reportes.index', compact('desde', 'hasta', 'lugares', 'gastos', 'tipo', 'sellers'));
					break;
				case 'R2':
					//$inicio = Carbon::createFromFormat('d/m/Y', $request->start );
					//$fin = Carbon::createFromFormat('d/m/Y', $request->end );
					//return $inicio->fin('YYYY-MM-DD');
					$gastos = App\VentasGasto::whereBetween('created_at', [$inicio, $fin])->get();
					
					/* foreach($cv as $temporal){
						$gastos->push( $temporal->vendedores::where('lugar', 'satipo')->get() );
					}*/
					
					//return $gastos;
					return view('reportes.index', compact('desde', 'hasta', 'lugares', 'gastos', 'tipo', 'sellers'));
				break;
				case 'R4':
					if($request->vendedor!='0'){ 
						$liquidaciones = App\Liquidacion::whereBetween('fecha', [$inicio, $fin])->where('vendedor', $request->vendedor)->get();
					}else{
						$liquidaciones = App\Liquidacion::whereBetween('fecha', [$inicio, $fin])->get();
					}
					//return $liquidaciones;
					return view('reportes.index', compact('desde', 'hasta', 'lugares', 'liquidaciones', 'tipo', 'sellers'));
				break;
				case "R1":
					$ventas = DB::table('ventas_contados')
            ->join('liquidacions', 'liquidacions.id', '=', 'ventas_contados.liquidacion_id')
            ->select('ventas_contados.*')->whereBetween('liquidacions.fecha', [$inicio, $fin])
						->get();
						return $ventas;
				break;
				default:
					# code...
					break;
			}
		
    }
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
