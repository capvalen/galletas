<?php

namespace App\Http\Controllers;

use App;
use DB;
use Auth;
use Illuminate\Http\Request;

class tipoProcesoControler extends Controller
{
	public function __construct() { $this->middleware('auth'); }

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

			//return $request; 
			$contador = DB::table('liquidacions')->select(DB::raw('count(*)+1 as conta'))->where('fecha', $request->fecha )->get();
			$idCodInterno=json_decode($contador, true);
			
			$liquidacion = new App\Liquidacion;
			$liquidacion->fecha = $request->fecha;
			$liquidacion->vendedor = $request->vendedor;
			$liquidacion->placa = $request->placa;
			$liquidacion->conductor = $request->conductor;
			$liquidacion->lugar = $request->lugar;
			$liquidacion->idUser = Auth::id();

			$liquidacion->sumaContado = $request->sumaContado;
			$liquidacion->sumaCobranza = $request->sumaCobranza;
			$liquidacion->sumaCredito = $request->sumaCredito;
			$liquidacion->sumaGasto = $request->sumaGasto;
			$liquidacion->sumaAdelanto = $request->sumaAdelanto;
			$liquidacion->sumaEntregar = $request->sumaEntregar;
			$liquidacion->sumaEntregado = $request->sumaEntregado;
			$liquidacion->codInterno = $idCodInterno[0]['conta'];

			$liquidacion->save(); //correcto

			if( count($request->alContado)>0 ){
				foreach ($request->alContado as $alcontado) {
					$alContado = new App\ventasContado;
					$alContado->liquidacion_id= $liquidacion->id;
					$alContado->cantidad = $alcontado['cantidad'];
					$alContado->idPresentacion = $alcontado['idPresentacion'];
					$alContado->presentacion = $alcontado['presentacion'];
					$alContado->precio = $alcontado['precio'];
					$alContado->total = $alcontado['ventcSubTotal'];	
					$alContado->save();
				}
			} //correcto

		
			if( count($request->stockFinal)>0 ){
				foreach ($request->stockFinal as $stockFinal) {
					$stock = new App\ventasStock;
					$stock->liquidacion_id= $liquidacion->id;
					$stock->presentacion = $stockFinal['presentacion'];
					$stock->idPresentacion = $stockFinal['idPresentacion'];
					$stock->pentapeaks = $stockFinal['pentapeaks'];
					$stock->oficina = $stockFinal['oficina'];
					$stock->fabrica = $stockFinal['fabrica'];
					$stock->total = $stockFinal['subTotal'];
					$stock->retorno = $stockFinal['retorno'];
					$stock->retornoFabrica = $stockFinal['retornoFabrica'];
					$stock->retornoOficina = $stockFinal['retornoOficina'];
					$stock->vencido = $stockFinal['vencido'];
					$stock->observacion = $stockFinal['observacion'];
					$stock->save();
				}
			} //correcto

			
			if( count($request->alCredito)>0 ){
				foreach ($request->alCredito as $ventasCredito) {
					$credito = new App\ventasCredito;
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
					$adelanto->idPresentacion = $vAdelantos['idPresentacion'];
					$adelanto->presentacion = $vAdelantos['presentacion'];
					$adelanto->bonificacion = $vAdelantos['bonificacion'];
					$adelanto->save();
				}
			} //correcto

			
			if( count($request->listaGastos)>0 ){
				foreach ($request->listaGastos as $vGastos) {
					$gasto = new App\VentasGasto;
					$gasto->liquidacion_id= $liquidacion->id;
					if( $vGastos['tipo']==1){ $gasto->monto = $vGastos['monto']; }else{ $gasto->monto = $vGastos['entra']; }
					
					$gasto->descripcion = $vGastos['descripcion'];
					$gasto->idComprobante = $vGastos['idComprobante'];
					$gasto->comprobante = $vGastos['comprobante'];
					$gasto->empresa_id = $vGastos['idDestino'];
					$gasto->destino = $vGastos['destino'];
					$gasto->tipo = $vGastos['tipo'];
					
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
					$gasto->idPresentacion = $vBonificacion['idPresentacion'];
					$gasto->bonificacion = $vBonificacion['bonificacion'];
					if( $vBonificacion['cliente']==null ){ $vBonificacion['cliente'] ='';$vBonificacion['direccion']=''; }
					$gasto->cliente = $vBonificacion['cliente'];
					$gasto->direccion = $vBonificacion['direccion'];
					$gasto->esBono = $vBonificacion['esBono'];
					
					$gasto->save();
				}
			} //correcto

			return $idCodInterno[0]['conta']; //$liquidacion->id;
		}

		public function reporteLiquidacion($id){
			$liquidacion = App\Liquidacion::findOrFail($id);
			$gastos= json_encode(App\VentasGasto::where('liquidacion_id', $id)->get());
			$productos = App\ventasStock::where('liquidacion_id', $liquidacion->id )->get()->toJson();
			$ventas = App\ventasContado::where('liquidacion_id', $liquidacion->id )->get()->toJson();
			$bonificaciones = json_encode(App\VentasBonificacion::where('liquidacion_id', $liquidacion->id )->get());
			$creditos = json_encode(App\ventasCredito::where('liquidacion_id', $liquidacion->id )->get());
			$cobranzas = json_encode(App\VentasCobranza::where('liquidacion_id', $liquidacion->id )->get());
			$adelantos = json_encode(App\VentasAdelanto::where('liquidacion_id', $liquidacion->id )->get());
			//return $bonificaciones;

			//return $gastos;
			return view('liquidaciones.reporte', compact('liquidacion', 'gastos', 'productos', 'ventas', 'bonificaciones', 'creditos', 'cobranzas', 'adelantos'));
		}

		public function productosCompleto(){
			$productos = App\Producto::all();
			//return $productos;
			return view('productos.lista', compact('productos'));
		}
		public function productosPrecios(Request $request, $id){
			//return $request;
			$resp = $request->validate([
				'precioBonificacion' => 'required',
				'precioMayor' => 'required',
				'precioMenor' => 'required',
			], [
				'precioBonificacion.required' => 'El precio por bonificación no puede estar vacío',
				'precioMayor.required' => 'El precio por mayor no puede estar vacío',
				'precioMenor.required' => 'El precio por menor no puede estar vacío',
				
			]);

			$producto = App\Producto::findOrFail($id);
			if($request->precioBonificacion)
			$producto -> precioBonificacion = $request->precioBonificacion;
			$producto -> precioMayor = $request->precioMayor;
			$producto -> precioMenor = $request->precioMenor;
			$producto-> save();
			return back()->with('actualizado', "Producto actualizado con éxito");
		}

		public function editarCabecera(Request $request){ 
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);;
			$liquidacion->fecha = $request->fecha;
			$liquidacion->vendedor = $request->vendedor;
			$liquidacion->placa = $request->placa;
			$liquidacion->conductor = $request->conductor;
			$liquidacion->lugar = $request->lugar;	
			$liquidacion->sumaEntregado = $request->sumaEntregado;
			$liquidacion->save();
			return "ok";
			
		}
		public function crearVentaFila(Request $request){ 
			$alContado = new App\ventasContado;
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);

			$alContado->liquidacion_id = $request->liquidacion_id;
			$alContado->cantidad = $request->cantidad;
			$alContado->idPresentacion = $request->idPresentacion;
			$alContado->presentacion = $request->presentacion;
			$alContado->precio = $request->precio;
			$alContado->total = $request->total;
			$alContado->save();

			$liquidacion->sumaContado = floatval($liquidacion->sumaContado) + floatval($request->cantidad * $request->precio) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($request->cantidad * $request->precio) ;
			$liquidacion->save();


			return $alContado->id;
		}
		public function editarVentaFila(Request $request){
			$alContado = App\ventasContado::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($alContado->liquidacion_id);

			$liquidacion->sumaContado = floatval($liquidacion->sumaContado) - floatval($alContado->total) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($alContado->total) ;

			$alContado->idPresentacion = $request->idPresentacion;
			$alContado->cantidad = $request->cantidad;
			$alContado->presentacion = $request->presentacion;
			$alContado->precio = $request->precio;
			$alContado->total = $request->cantidad*$request->precio;
			$alContado->save();

			$liquidacion->sumaContado = floatval($liquidacion->sumaContado) + floatval($alContado->total) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($alContado->total) ;
			$liquidacion->save();
			return "ok";
		}
		public function borrarVentaFila(Request $request){ 
			$ventas = App\ventasContado::findOrFail($request->fila);
			$liquidacion = App\Liquidacion::findOrFail($ventas->liquidacion_id);

			$liquidacion->sumaContado = floatval($liquidacion->sumaContado) - floatval($ventas->total ) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($ventas->total ) ;
			$liquidacion->save();
			$ventas->delete();

			return "ok";
		}

		public function crearStockFila(Request $request){ 
			$stock = new App\ventasStock;
			$stock->liquidacion_id= $request-> liquidacion_id;
			$stock->presentacion = $request-> presentacion;
			$stock->idPresentacion = $request-> idPresentacion;
			$stock->pentapeaks = $request-> pentapeaks;
			$stock->oficina = $request-> oficina;
			$stock->fabrica = $request-> fabrica;
			$stock->total = $request-> subTotal;
			$stock->retorno = $request-> retorno;
			$stock->retornoFabrica = $request-> retornoFabrica;
			$stock->retornoOficina = $request-> retornoOficina;
			$stock->vencido = $request-> vencido;
			$stock->observacion = $request-> observacion;
			$stock->save();

			return $stock->id;
		}
		public function editarStockFila(Request $request){
			$stock = App\ventasStock::findOrFail($request->id);
			
			$stock->presentacion = $request-> presentacion;
			$stock->idPresentacion = $request-> idPresentacion;
			$stock->pentapeaks = $request-> pentapeaks;
			$stock->oficina = $request-> oficina;
			$stock->fabrica = $request-> fabrica;
			$stock->total = $request-> subTotal;
			$stock->retorno = $request-> retorno;
			$stock->retornoFabrica = $request-> retornoFabrica;
			$stock->retornoOficina = $request-> retornoOficina;
			$stock->vencido = $request-> vencido;
			$stock->observacion = $request-> observacion;
			$stock->save();

			return "ok";
		}
		public function borrarStockFila(Request $request){ 
			$stock = App\ventasStock::findOrFail($request->id);
			$stock->delete();

			return "ok";
		}

		public function crearBonificacionFila(Request $request){
			$bonificacion = new App\VentasBonificacion;
			$bonificacion->liquidacion_id= $request->liquidacion_id;
			$bonificacion->cantidad = $request-> cantidad;
			$bonificacion->presentacion = $request-> presentacion;
			$bonificacion->idPresentacion = $request-> idPresentacion;
			$bonificacion->bonificacion = $request-> bonificacion;
			if( $request-> cliente==null ){ $request-> cliente =''; $request-> direccion=''; }
			$bonificacion->cliente = $request-> cliente;
			$bonificacion->direccion = $request-> direccion;
			$bonificacion->esBono = $request-> esBono;
			$bonificacion->save();

			return $bonificacion->id;
		}
		public function editarBonificacionFila(Request $request){
			$bonificacion = App\VentasBonificacion::findOrFail($request->id);
			
			$bonificacion->cantidad = $request-> cantidad;
			$bonificacion->presentacion = $request-> presentacion;
			$bonificacion->idPresentacion = $request-> idPresentacion;
			$bonificacion->bonificacion = $request-> bonificacion;
			if( $request-> cliente==null ){ $request-> cliente =''; $request-> direccion=''; }
			$bonificacion->cliente = $request-> cliente;
			$bonificacion->direccion = $request-> direccion;
			$bonificacion->esBono = $request-> esBono;
			$bonificacion->save();

			return "ok";
		}
		public function borrarBonificacionFila(Request $request){ 
			$bonificacion = App\VentasBonificacion::findOrFail($request->id);
			$bonificacion->delete();

			return "ok";
		}

		public function crearCreditoFila(Request $request){ 
			$credito = new App\ventasCredito;
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);
			$credito->liquidacion_id= $request->liquidacion_id;
			$credito->presentacion = $request-> presentacion;
			$credito->idPresentacion = $request-> idPresentacion;
			if( $request-> cliente==null ){ $request-> cliente =''; }
			$credito->cliente = $request-> cliente;
			$credito->nota = $request-> nota;
			$credito->cantidad = $request-> cantidad;
			$credito->precio = $request-> precio;
			$credito->total = $request-> cantidad * $request-> precio;
			$liquidacion->sumaCredito = floatval($liquidacion->sumaContado) + floatval($request-> cantidad * $request-> precio) ;
			$liquidacion->save();
			$credito->save();

			return $credito->id;
		}
		public function editarCreditoFila(Request $request){
			$credito = App\ventasCredito::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($credito->liquidacion_id);

			$liquidacion->sumaCredito = floatval($liquidacion->sumaContado) - floatval($credito->total) ;
			
			$credito->presentacion = $request-> presentacion;
			$credito->idPresentacion = $request-> idPresentacion;
			if( $request-> cliente==null ){ $request-> cliente =''; }
			$credito->cliente = $request-> cliente;
			$credito->nota = $request-> nota;
			$credito->cantidad = $request-> cantidad;
			$credito->precio = $request-> precio;
			$credito->total = $request-> cantidad * $request-> precio;
			$credito->save();

			$liquidacion->sumaCredito = floatval($liquidacion->sumaContado) + floatval($request-> cantidad * $request-> precio) ;
			$liquidacion->save();

			return "ok";
		}
		public function borrarCreditoFila(Request $request){ 
			$credito = App\ventasCredito::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($credito->liquidacion_id);
			$liquidacion->sumaCredito = floatval($liquidacion->sumaCredito) - floatval($credito->total) ;
			$liquidacion->save();
			$credito->delete();

			return "ok";
		}

		public function crearCobroFila(Request $request){ 
			$cobranza = new App\ventasCobranza;
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);
			$cobranza->liquidacion_id= $request->liquidacion_id;
			if( $request-> cliente==null ){ $request-> cliente =''; }
			$cobranza->cliente = $request-> cliente;
			$cobranza->deuda = $request-> deuda;
			$cobranza->acuenta = $request-> acuenta;
			$cobranza->saldo = $request-> saldo;
			$cobranza->nota = $request-> nota;
			$liquidacion->sumaCobranza = floatval($liquidacion->sumaCobranza) + floatval($request->acuenta) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($request->acuenta) ;
			$cobranza->save();
			$liquidacion->save();

			return $cobranza->id;
		}
		public function editarCobroFila(Request $request){
			$cobranza = App\ventasCobranza::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($cobranza->liquidacion_id);

			$liquidacion->sumaCobranza = floatval($liquidacion->sumaCobranza) - floatval($cobranza->acuenta) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($cobranza->acuenta) ;

			if( $request-> cliente==null ){ $request-> cliente =''; }
			$cobranza->cliente = $request-> cliente;
			$cobranza->deuda = $request-> deuda;
			$cobranza->acuenta = $request-> acuenta;
			$cobranza->saldo = $request-> saldo;
			$cobranza->nota = $request-> nota;
			$liquidacion->sumaCobranza = floatval($liquidacion->sumaCobranza) + floatval($request->acuenta) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($request->acuenta) ;
			$cobranza->save();
			$liquidacion->save();


			return "ok";
		}
		public function borrarCobroFila(Request $request){ 
			$cobranza = App\ventasCobranza::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($cobranza->liquidacion_id);
			$liquidacion->sumaCobranza = floatval($liquidacion->sumaCobranza) - floatval($cobranza->acuenta) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($cobranza->acuenta) ;
			$liquidacion->save();
			$cobranza->delete();

			return "ok";
		}

		public function crearAdelantoFila(Request $request){ 
			$adelanto = new App\VentasAdelanto;
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);

			$adelanto->liquidacion_id= $request->liquidacion_id;
			if( $request-> cliente==null ){ $request-> cliente =''; }
			$adelanto->cliente = $request-> cliente;
			$adelanto->monto = $request-> monto;
			$adelanto->cantidad = $request-> cantidad;
			$adelanto->idPresentacion = $request-> idPresentacion;
			$adelanto->presentacion = $request-> presentacion;
			$adelanto->bonificacion = $request-> bonificacion;
			$adelanto->save();

			$liquidacion->sumaAdelanto = floatval($liquidacion->sumaAdelanto) + floatval($request->monto) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($request->monto) ;
			$liquidacion->save();

			return $adelanto->id;
		}
		public function editarAdelantoFila(Request $request){ 
			$adelanto = App\VentasAdelanto::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);

			$liquidacion->sumaAdelanto = floatval($liquidacion->sumaAdelanto) - floatval($adelanto->monto) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($adelanto->monto) ;

			$adelanto->liquidacion_id= $request->liquidacion_id;
			if( $request-> cliente==null ){ $request-> cliente =''; }
			$adelanto->cliente = $request-> cliente;
			$adelanto->monto = $request-> monto;
			$adelanto->cantidad = $request-> cantidad;
			$adelanto->idPresentacion = $request-> idPresentacion;
			$adelanto->presentacion = $request-> presentacion;
			$adelanto->bonificacion = $request-> bonificacion;
			$adelanto->save();

			$liquidacion->sumaAdelanto = floatval($liquidacion->sumaAdelanto) + floatval($request->monto) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($request->monto) ;
			$liquidacion->save();

			return "ok";
		}
		public function borrarAdelantoFila(Request $request){ 
			$adelanto = App\VentasAdelanto::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($adelanto->liquidacion_id);
			$liquidacion->sumaAdelanto = floatval($liquidacion->sumaAdelanto) - floatval($adelanto->monto) ;
			$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($adelanto->monto) ;
			$adelanto->delete();
			$liquidacion->save();

			return "ok";
		}

		public function crearGastoFila(Request $request){ 
			$gasto = new App\VentasGasto;
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);
			$gasto->liquidacion_id= $request->liquidacion_id;
			if( $request->tipo=="1"){
				$gasto->monto = $request-> monto;
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) + floatval(abs($request->monto)) ;
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($request->monto) ;
			}else{
				$gasto->monto = $request->entra;
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) - floatval(abs($request->entra)) ;
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($request->entra) ;
			}
			$gasto->descripcion = $request-> descripcion;
			$gasto->idComprobante = $request-> idComprobante;
			$gasto->comprobante = $request-> comprobante;
			$gasto->empresa_id = $request-> empresa_id;
			$gasto->destino = $request-> destino;
			$gasto->tipo = $request-> tipo;
			
			$gasto->save();
			$liquidacion->save();

			return $gasto->id;
		}
		public function editarGastoFila(Request $request){ 
			$gasto = App\VentasGasto::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($request->liquidacion_id);
			
			if( $request->tipo=="1"){
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) - floatval(abs($gasto->monto)) ;
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($gasto->monto) ;
				$gasto->monto = $request-> monto;
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) + floatval(abs($request->monto)) ;
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval($request->monto) ;
			}else{
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval(abs($liquidacion->sumaGasto)) ;
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) + floatval(abs($gasto->monto)) ;
				$gasto->monto = $request->entra;
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) - floatval(abs($request->entra)) ;
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval(abs($liquidacion->sumaGasto)) ;
			}
			$gasto->descripcion = $request-> descripcion;
			$gasto->idComprobante = $request-> idComprobante;
			$gasto->comprobante = $request-> comprobante;
			$gasto->empresa_id = $request-> empresa_id;
			$gasto->destino = $request-> destino;
			$gasto->tipo = $request-> tipo;
			
			$gasto->save();
			$liquidacion->save();

			return $gasto->id;
		}
		public function borrarGastoFila(Request $request){ 
			$gasto = App\VentasGasto::findOrFail($request->id);
			$liquidacion = App\Liquidacion::findOrFail($gasto->liquidacion_id);
			
			if( $request->tipo=="1"){
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) - floatval(abs($gasto->monto)) ;
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) + floatval($gasto->monto) ;
			
			}else{
				$liquidacion->sumaEntregar = floatval($liquidacion->sumaEntregar) - floatval(abs($liquidacion->sumaGasto)) ;
				$liquidacion->sumaGasto = floatval($liquidacion->sumaGasto) + floatval(abs($gasto->monto)) ;
				
			}
						
			$gasto->delete();
			$liquidacion->save();

			return "ok";
		}
}
