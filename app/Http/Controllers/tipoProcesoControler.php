<?php

namespace App\Http\Controllers;

use App;
use DB;
use Auth;
use Illuminate\Http\Request;

class tipoProcesoControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$procesos = App\galeria_tipo::where('activo', 1)->get();
			$procesos=App\galeria_tipo::select(DB::raw('galeria_tipos.*, grupos.grupo'))
				->crossJoin('grupos', 'galeria_tipos.grupo_id', '=', 'grupos.id')
				->where('galeria_tipos.activo', 1)
				->get();
			$grupos = App\Grupos::where('activo', 1)->get();
			$usuarios = App\User::where('activo', 1)->get();
			//return $procesos;
			return view('categorias.crear', compact('grupos', 'usuarios', 'procesos'));
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
			//return $request;
			$proceso =  new App\galeria_tipo;
			$proceso -> grupo_id = $request->sltGrupo;
			$proceso -> descripcion = $request->descripcion;
			$proceso -> save();
			//$procesosCompleto = App\galeria_tipo::where('activo', 1)->get();
			return back()->with('mensaje', 'Se guardó correctamente');
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
				//return $id;
				$proceso = App\galeria_tipo::findOrFail($id);
				//return $proceso;
				$proceso ->activo = 0;
				$proceso->save();
				return back()->with('borrado', 'Se borró correctamente');
		}
		
		public function liquidacion_insert(Request $request){
			//return auth()->id;
			$liquidacion = new App\Liquidacion;
			$liquidacion->fecha = $request->fecha;
			$liquidacion->vendedor = $request->vendedor;
			$liquidacion->placa = $request->placa;
			$liquidacion->lugar = $request->lugar;
			$liquidacion->idUser = Auth::id();

			$liquidacion->sumaContado = $request->sumaContado;
			$liquidacion->sumaCobranza = $request->sumaCobranza;
			$liquidacion->sumaCredito = $request->sumaCredito;
			$liquidacion->sumaGasto = $request->sumaGasto;
			$liquidacion->sumaAdelanto = $request->sumaAdelanto;
			$liquidacion->sumaEntregar = $request->sumaEntregar;
			$liquidacion->sumaEntregado = $request->sumaEntregado;

			$liquidacion->save(); //correcto

			if( count($request->alContado)>0 ){
				foreach ($request->alContado as $alcontado) {
					$alContado = new App\VentasContado;
					$alContado->liquidacion_id= $liquidacion->id;
					$alContado->cantidad = $alcontado['cantidad'];
					$alContado->presentacion = $alcontado['presentacion'];
					$alContado->precio = $alcontado['precio'];
					$alContado->total = $alcontado['ventcSubTotal'];	
					$alContado->save();
				}
			} //correcto

		
			if( count($request->stockFinal)>0 ){
				foreach ($request->stockFinal as $stockFinal) {
					$stock = new App\VentasStock;
					$stock->liquidacion_id= $liquidacion->id;
					$stock->presentacion = $stockFinal['presentacion'];
					$stock->pentapeaks = $stockFinal['pentapeaks'];
					$stock->oficina = $stockFinal['oficina'];
					$stock->fabrica = $stockFinal['fabrica'];
					$stock->total = $stockFinal['subTotal'];
					$stock->final = $stockFinal['retorno'];
					$stock->observacion = $stockFinal['observacion'];
					$stock->save();
				}
			} //correcto

			
			if( count($request->alCredito)>0 ){
				foreach ($request->alCredito as $ventasCredito) {
					$credito = new App\VentasCredito;
					$credito->liquidacion_id= $liquidacion->id;
					$credito->presentacion = $ventasCredito['presentacion'];
					$credito->idPresentacion = $ventasCredito['idPresentacion'];
					$credito->cliente = $ventasCredito['cliente'];
					$credito->nota = $ventasCredito['nota'];
					$credito->cantidad = $ventasCredito['cantidad'];
					$credito->precio = $ventasCredito['precio'];
					$credito->total = $ventasCredito['subTotal'];
					$credito->save();
				}
			} //correcto


			if( count($request->vCobranza)>0 ){
				foreach ($request->vCobranza as $ventasCobranza) {
					$cobranza = new App\VentasCobranza;
					$cobranza->liquidacion_id= $liquidacion->id;
					$cobranza->cliente = $ventasCobranza['cliente'];
					$cobranza->deuda = $ventasCobranza['deuda'];
					$cobranza->acuenta = $ventasCobranza['acuenta'];
					$cobranza->saldo = $ventasCobranza['saldo'];
					$cobranza->nota = $ventasCobranza['nota'];
					$cobranza->save();
				}
			} //correcto

			
			if( count($request->adelantos)>0 ){
				foreach ($request->adelantos as $vAdelantos) {
					$adelanto = new App\VentasAdelanto;
					$adelanto->liquidacion_id= $liquidacion->id;
					$adelanto->cliente = $vAdelantos['cliente'];
					$adelanto->monto = $vAdelantos['monto'];
					$adelanto->cantidad = $vAdelantos['cantidad'];
					$adelanto->fecha = $vAdelantos['fecha'];
					$adelanto->save();
				}
			} //correcto

			
			if( count($request->listaGastos)>0 ){
				foreach ($request->listaGastos as $vGastos) {
					$gasto = new App\VentasGasto;
					$gasto->liquidacion_id= $liquidacion->id;
					$gasto->monto = $vGastos['monto'];
					$gasto->descripcion = $vGastos['descripcion'];
					
					$gasto->save();
				}
			} //correcto

			//return $request->listaBonificacion;
			if( count($request->listaBonificacion)>0 ){
				foreach ($request->listaBonificacion as $vBonificacion) {
					$gasto = new App\VentasBonificacion;
					$gasto->liquidacion_id= $liquidacion->id;
					$gasto->cantidad = $vBonificacion['cantidad'];
					$gasto->presentacion = $vBonificacion['presentacion'];
					
					$gasto->save();
				}
			} //correcto

			return $liquidacion->id;
		}
}