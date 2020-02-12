@extends('plantillas.panel')
@php
	use Carbon\Carbon;
@endphp


@section('titulo')
<div id="app">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Liquidaciones</a></li>
	    <li class="breadcrumb-item" aria-current="page">Reporte {{substr(str_replace('-', '', $liquidacion->fecha ),0, 4)."-". str_pad ($liquidacion->codInterno, 2, "0", STR_PAD_LEFT)}}</li>
	    <li class="breadcrumb-item " aria-current="page"></li>
	  </ol>
	</nav>
	<h2><i class="icofont-paper"></i> Reporte de Liquidación Cod. {{substr(str_replace('-', '', $liquidacion->fecha ),0, 4)."-". str_pad ($liquidacion->codInterno, 2, "0", STR_PAD_LEFT)}}</h2>
	@endsection
	
	@section('cuerpo')
	<section>
		<div class="card w-100">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<label for="">Vendedor: </label>
						<p class="text-capitalize">{{$liquidacion->vendedor}}</p>
					</div>
					<div class="col">
						<label for="">Placa: </label>
						<p class="text-uppercase">{{$liquidacion->placa}}</p>
					</div>
					<div class="col">
						<label for="">Conductor: </label>
						<p class="text-capitalize">{{$liquidacion->conductor}}</p>
					</div>
					<div class="col">
						<label for="">Fecha: </label>
						<p class="text-capitalize">{{$liquidacion->fecha}}</p>
					</div>
				</div>
			</div>
		</div>
		<button class="d-none" @click="buscarRepetidos()"> Mostrar informe</button>
	</section>
	
	<section class="my-3">
		<div class="card w-100">
			<div class="card-body table-responsive">
				<h4>Ventas liquidación</h4>
				<table class="table table-hover table-sm">
					<thead class="thead-dark ">
						<tr>
							<th>Item</th>
							<th>Producto</th>
							<th data-toggle="tooltip" data-placement="top" title="Stock Pentapeaks">Stk. Pent.</th>
							<th data-toggle="tooltip" data-placement="top" title="Salida de Fábrica">Sal. Fáb.</th>
							<th data-toggle="tooltip" data-placement="top" title="Salida de Oficina">Sal. Ofi.</th>
							<th data-toggle="tooltip" data-placement="top" title="Total a vender">Total Venta</th>
							<th data-toggle="tooltip" data-placement="top" title="Vencido o dañado">Venc.</th>
							<th data-toggle="tooltip" data-placement="top" title="Stock Final Pentapeaks">Stk. Fin.</th>
							<th data-toggle="tooltip" data-placement="top" title="Entrada a oficina">Entrada</th>
							<th data-toggle="tooltip" data-placement="top" title="Unidades vendidas">Und. Vend.</th>
							<th data-toggle="tooltip" data-placement="top" title="Degustación">Degustación</th>
							<th data-toggle="tooltip" data-placement="top" title="Bonificación en Unidades">Bonificación</th>
							<th data-toggle="tooltip" data-placement="top" title="Precio Unidad">Precio Und.</th>
							<th data-toggle="tooltip" data-placement="top" title="Precio en Promedio">Promedio.</th>
							<th data-toggle="tooltip" data-placement="top" title="Venta Total">Venta</th>
						</tr>
					</thead>
					<tbody>
						
						<tr v-for="(producto, index) in listaProductos">
							<td>@{{index+1}}</td>
							<td>@{{producto.presentacion}}</td>
							<td>@{{producto.pentapeaks}}</td>
							<td>@{{producto.fabrica}}</td>
							<td>@{{producto.oficina}}</td>
							<td>@{{producto.totalVenta}}</td>
							<td>@{{producto.vencido}}</td>
							<td>@{{producto.totalVenta + producto.vencido}}</td>
							<td>@{{producto.retorno}}</td>
							<td>@{{producto.vendido}}</td>
							<td>@{{producto.bonificacion}}</td>
							<td>@{{producto.degustacion}}</td>
							
					
						</tr>
						
					</tbody>
					
				</table>
			</div>
		</div>
	</section>

	<section class="my-3">
		<div class="card w-100">
			<div class="card-body table-responsive">
				<h4>Créditos</h4>
				<table class="table table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Código</th>
							<th>Cliente</th>
							<th>Nota de pedido</th>
							<th>Presentación</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(credito, index) in tempoCreditos">
							<td>@{{index+1}}</td>
							<td class="text-capitalize">CR-@{{credito.id}}</td>
							<td class="text-capitalize">@{{credito.cliente}}</td>
							<td class="text-capitalize">@{{credito.nota}}</td>
							<td class="text-capitalize">@{{credito.presentacion}}</td>
							<td class="text-capitalize">@{{credito.cantidad}}</td>
							<td>@{{parseFloat(credito.precio).toFixed(2)}}</td>
							<td>@{{parseFloat(credito.total).toFixed(2)}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>@{{creCantidad}}</th>
							<th>@{{crePrecio}}</th>
							<th>@{{creTotal}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>

	<section class="my-3">
		<div class="card w-100">
			<div class="card-body table-responsive">
				<h4>Cobranzas</h4>
				<table class="table table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Código</th>
							<th>Cliente</th>
							<th>Nota de pedido</th>
							<th>Deuda</th>
							<th>A cuenta</th>
							<th>Saldo</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(cobranza, index) in tempoCobranzas">
							<td>@{{index+1}}</td>
							<td class="text-capitalize">CO-@{{cobranza.id}}</td>
							<td class="text-capitalize">@{{cobranza.cliente}}</td>
							<td class="text-capitalize">@{{cobranza.nota}}</td>
							<td>@{{parseFloat(cobranza.deuda).toFixed(2)}}</td>
							<td>@{{parseFloat(cobranza.acuenta).toFixed(2)}}</td>
							<td>@{{parseFloat(cobranza.saldo).toFixed(2)}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th></th><th></th><th></th><th></th>
							<th>@{{coDeuda}}</th>
							<th>@{{coAcuenta}}</th>
							<th>@{{coSaldo}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
	<section class="my-3">
		<div class="card w-100">
			<div class="card-body table-responsive">
				<h4>Pago adelantado</h4>
				<table class="table table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Código</th>
							<th>Cliente</th>
							<th>Presentación</th>
							<th>Unidades</th>
							<th>Bonificación</th>
							<th>Prec. Unit.</th>
							<th>Prec. Promedio</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(adelanto, index) in tempoAdelantos">
							<td>@{{index+1}}</td>
							<td class="text-capitalize">AD-@{{adelanto.id}}</td>
							<td class="text-capitalize">@{{adelanto.cliente}}</td>
							<td class="text-capitalize">@{{adelanto.presentacion}}</td>
							<td class="text-capitalize">@{{adelanto.cantidad}}</td>
							<td class="text-capitalize">@{{adelanto.bonificacion}}</td>
							<td class="text-capitalize">@{{parseFloat(adelanto.monto).toFixed(2)}}</td>
							<td class="text-capitalize">@{{parseFloat(adelanto.cantidad*adelanto.monto/(adelanto.cantidad+adelanto.bonificacion)).toFixed(2)}}</td>
							<td class="text-capitalize">@{{parseFloat(adelanto.cantidad*adelanto.monto).toFixed(2)}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>@{{adeMonto}}</th>
							<th>@{{adeProm}}</th>
							<th>@{{adeTotal}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
	<section class="my-3">
		<div class="card w-100">
			<div class="card-body table-responsive">
				<h4>Gastos</h4>
				<table class="table table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Descripción</th>
							<th>Monto</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(gasto, index) in tempoGastos">
							<td>@{{index+1}}</td>
							<td class="text-capitalize">@{{gasto.descripcion}}</td>
							<td>@{{parseFloat(gasto.monto).toFixed(2)}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th>@{{gastTotal}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
	<section class="my-3">
		<div class="card w-100">
			<div class="card-body table-responsive">
				<h4>Bonificaciones</h4>
				<table class="table table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Código</th>
							<th>Cliente</th>
							<th>Condición</th>
							<th>Presentación</th>
							<th>Cantidad Bonif.</th>
							<th>Venta Displays</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(bono, index) in tempoBonos">
							<td>@{{index+1}}</td>
							<td class="text-capitalize">BO-@{{bono.id}}</td>
							<td class="text-capitalize">@{{bono.cliente}}</td>
							<td class="text-capitalize"><span v-id="esBono=='1'">Bonificación</span><span v-else>Degustación</span></td>
							<td class="text-capitalize">@{{bono.presentacion}}</td>
							<td class="text-capitalize">@{{bono.bonificacion}}</td>
							<td class="text-capitalize">@{{bono.cantidad}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th></th><th></th><th></th><th></th><th></th>
							<th>@{{boniBoni}}</th>
							<th>@{{boniCant}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
</div>


@endsection

@section('script')
<script>
	var app = new Vue({
  el: '#app',
  data: { a:0,
		tempoGastos: JSON.parse({!! json_encode($gastos) !!}),
		tempoProductos: JSON.parse({!! json_encode($productos) !!}),
		tempoVentas: JSON.parse({!! json_encode($ventas) !!}),
		tempoBonos: JSON.parse({!! json_encode($bonificaciones) !!}),
		tempoCreditos: JSON.parse({!! json_encode($creditos) !!}),
		tempoCobranzas: JSON.parse({!! json_encode($cobranzas) !!}),
		tempoAdelantos: JSON.parse({!! json_encode($adelantos) !!}),
		crePrecio:0,creCantidad:0,creTotal:0, coDeuda:0,coAcuenta:0,coSaldo:0, adeMonto:0,adeProm:0,adeTotal:0,gastTotal:0, boniBoni:0,boniCant:0,

		listaProductos: [],
	},
	methods:{
		buscarRepetidos(){
			let contador =0;
			for (let i = 0; i < this.tempoProductos.length; i++) {
				for (let j = 0; j < this.listaProductos.length; j++) {
					if(this.tempoProductos[i].idPresentacion== this.listaProductos[j].idPresentacion ){ contador++; break; }
				}

				if( contador==0){ this.addListaProductoNuevo(this.tempoProductos[i], 'base' );
				}else{ this.addListaProductoExistente(this.tempoProductos[i], this.tempoProductos[i].idPresentacion ); }
				contador=0;
			}

			for (let i = 0; i < this.tempoVentas.length; i++) {
				for (let j = 0; j < this.listaProductos.length; j++) {
					if(this.tempoVentas[i].idPresentacion== this.listaProductos[j].idPresentacion ){ contador++; break; }
				}

				if( contador==0){ this.addListaProductoNuevo(this.tempoVentas[i], 'ventas' );
				}else{ this.addListaProductoExistente(this.tempoVentas[i], this.tempoVentas[i].idPresentacion ); }
				contador=0;
			}
			for (let i = 0; i < this.tempoBonos.length; i++) {
				for (let j = 0; j < this.listaProductos.length; j++) {
					if(this.tempoBonos[i].idPresentacion== this.listaProductos[j].idPresentacion ){ contador++; break; }
				}

				if( contador==0){ this.addListaProductoNuevo(this.tempoBonos[i], 'bonos' );
				}else{ this.addListaProductoExistente(this.tempoBonos[i], this.tempoBonos[i].idPresentacion ); }
				contador=0;
			}

		},
		addListaProductoNuevo(presentacion, conArgumentos){
			switch (conArgumentos) {
				case 'base':
					let minSum= parseFloat(presentacion.pentapeaks + presentacion.fabrica + presentacion.oficina);
					this.listaProductos.push({ 'idPresentacion': presentacion.liquidacion_id, 'presentacion': presentacion.presentacion, pentapeaks: presentacion.pentapeaks,fabrica: presentacion.fabrica, oficina: presentacion.oficina, totalVenta: minSum, vencido: presentacion.vencido, stkFinal: minSum-presentacion.vencido, retorno: presentacion.retorno, vendido:0, bonificacion:0, degustacion:0, promedio:0 });
				break;
				case 'ventas':
					this.listaProductos.push({ 'idPresentacion': presentacion.liquidacion_id, 'presentacion': presentacion.presentacion, pentapeaks: 0,fabrica: 0, oficina: 0, totalVenta: presentacion.cantidad, vencido: 0, stkFinal: presentacion.cantidad, retorno: 0, vendido:presentacion.cantidad, bonificacion:0, degustacion:0, promedio: presentacion.precio/presentacion.cantidad });
				break;
				case 'bonos': console.log( 'bono' );
					let bono =0; let degusta=0;
					if( presentacion.esBono ==1){ bono= presentacion.bonificacion; degusta=0; }else{ degusta= presentacion.bonificacion; bono=0; }
					this.listaProductos.push({ 'idPresentacion': presentacion.liquidacion_id, 'presentacion': presentacion.presentacion, pentapeaks: 0,fabrica: 0, oficina: 0, totalVenta: 0, vencido: 0, stkFinal: 0, retorno: 0, vendido:0, bonificacion: bono, degustacion:degusta, promedio:0 });
				break;
				default:
					break;
			}

		},
		addListaProductoExistente(presentacion, idPrepetido){
			for (let i = 0; i < this.listaProductos.length; i++) {
				if(this.tempoProductos[i].idPresentacion== idPrepetido ){
					var minSum= parseFloat(presentacion.pentapeaks + presentacion.fabrica + presentacion.oficina);
					//var prome = parseFloat( this.listaProductos[i].vendido+presentacion.vendido )
					this.listaProductos[i].pentapeaks += parseFloat(presentacion.pentapeaks);
					this.listaProductos[i].fabrica += parseFloat(presentacion.fabrica);
					this.listaProductos[i].oficina += parseFloat(presentacion.oficina);
					this.listaProductos[i].vencido += parseFloat(presentacion.vencido);
					this.listaProductos[i].totalVenta += minSum;
					this.listaProductos[i].stkFinal += parseFloat(minSum-presentacion.vencido);
					this.listaProductos[i].retorno += parseFloat(presentacion.retorno);
					this.listaProductos[i].vendido += parseFloat(presentacion.vendido);
					this.listaProductos[i].bonificacion += parseFloat(presentacion.bonificacion);
					this.listaProductos[i].degustacion += parseFloat(presentacion.degustacion);
					this.listaProductos[i].promedio += parseFloat(prome);
					
					break;
				}
			}
		},
		sumaCreditos(){
			let precio=0, cantidad=0, total=0;
			for (let index = 0; index < this.tempoCreditos.length; index++) {
				precio+= this.tempoCreditos[index].precio;
				cantidad+= this.tempoCreditos[index].cantidad;
				total+= this.tempoCreditos[index].total;
			}
			this.crePrecio= parseFloat(precio).toFixed(2);
			this.creCantidad= parseFloat(cantidad).toFixed(0);
			this.creTotal= parseFloat(total).toFixed(2);
		},
		sumaCobranza(){
			let deuda=0, acuenta=0, saldo=0;
			for (let index = 0; index < this.tempoCobranzas.length; index++) {
				deuda+= this.tempoCobranzas[index].deuda;
				acuenta+= this.tempoCobranzas[index].acuenta;
				saldo+= this.tempoCobranzas[index].saldo;
			}
			this.coDeuda= parseFloat(deuda).toFixed(2);
			this.coAcuenta= parseFloat(acuenta).toFixed(2);
			this.coSaldo= parseFloat(saldo).toFixed(2);
		},
		sumaAdelantos(){
			let monto=0, prom=0, total=0;
			for (let index = 0; index < this.tempoAdelantos.length; index++) {
				monto+= this.tempoAdelantos[index].monto;
				prom+= (this.tempoAdelantos[index].cantidad*this.tempoAdelantos[index].monto)/(this.tempoAdelantos[index].cantidad+this.tempoAdelantos[index].bonificacion);
				total+= this.tempoAdelantos[index].cantidad*this.tempoAdelantos[index].monto;
			}
			this.adeMonto= parseFloat(monto).toFixed(2);
			this.adeProm= parseFloat(prom).toFixed(2);
			this.adeTotal= parseFloat(total).toFixed(2);
		},
		sumaGastos(){
			let gastos=0;
			for (let index = 0; index < this.tempoGastos.length; index++) {
				gastos+= this.tempoGastos[index].monto;
			}
			this.gastTotal = parseFloat(gastos).toFixed(2);
		},
		sumaBonificaciones(){
			let boniBoni=0,boniCant=0;
			for (let index = 0; index < this.tempoBonos.length; index++) {
				boniBoni+= this.tempoBonos[index].bonificacion;
				boniCant+= this.tempoBonos[index].cantidad;
			}
			this.boniBoni = parseFloat(boniBoni).toFixed(0);
			this.boniCant = parseFloat(boniCant).toFixed(0);
		}
	
	},
	mounted(){
		this.buscarRepetidos();
		this.sumaCreditos();
		this.sumaCobranza();
		this.sumaAdelantos();
		this.sumaGastos();
		this.sumaBonificaciones();
	},
	computed:{
		
	}
	
})
</script>
@endsection