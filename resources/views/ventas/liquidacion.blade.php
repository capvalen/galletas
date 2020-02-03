@extends('plantillas.panel')

@section('css')

@endsection

@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Ventas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Liquidación</li>
  </ol>
</nav>
<h2><i class="icofont-cart"></i> Liquidación de Ventas</h2>
@endsection

@section('cuerpo')
<div class="container-fluid" id="app">
	
	
	<div class="row row-cols-1">
		<div class="col">
			<div class="row text-center my-3">
				<div class="col d-flex justify-content-center">
					<h4 class="">Ventas al contado</h4>
				</div>
				<div>
					<button type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addVentasContLista" @click="esNuevo = true; ventcCantidad=0; gasDescripcion=''; ventcPrecio= '0.00';" ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>N°</th>
								<th>Cant.</th>
								<th>Presentación</th>
								<th>Precio</th>
								<th>Total</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(venta, index) of listaVentasContado">
								<td>@{{index+1}}</td>
								<td>@{{venta.cantidad}}</td>
								<td>@{{venta.presentacion}}</td>
								<td>@{{parseFloat(venta.precio).toFixed(2)}}</td>
								<td>@{{parseFloat(venta.ventcSubTotal).toFixed(2)}}</td>
								<td>
									<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addVentasContLista" @click="esNuevo=false; ventascEditar(index)"><i class="icofont-edit"></i></button>
									<button class="btn btn-outline-danger border-0 btn-sm" @click="ventasBorrarFila(index)"><i class="icofont-close"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot v-if="ventcTotal>0">
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<th>@{{parseFloat(ventcTotal).toFixed(2)}}</th>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="row text-center my-3">
				<div class="col d-flex justify-content-center">
					<h4 class="">Stock final</h4>
				</div>
			<div>
					<button type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addStockEntrega" @click="esNuevo = true; stockPenta=0; stockFabrica=0; stockOficina=0; stockRetorno=0; stockObservacion='' " ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>N°</th>
								<th>Presentación</th>
								<th>Stock Pentapeacks</th>
								<th>Salida Fabrica</th>
								<th>Salida Oficina</th>
								<th>Total</th>
								<th>Retorno/ Stock Final</th>
								<th>Obs.</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(stock, index) of listaStockFinal">
								<td>@{{index+1}}</td>
								<td>@{{stock.presentacion}}</td>
								<td>@{{stock.pentapeaks}}</td>
								<td>@{{stock.fabrica}}</td>
								<td>@{{stock.oficina}}</td>
								<td>@{{stock.subTotal}}</td>
								<td>@{{stock.retorno}}</td>
								<td>@{{stock.observacion}}</td>
								<td>
									<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addStockEntrega" @click="esNuevo=false; stockEditar(index)"><i class="icofont-edit"></i></button>
									<button class="btn btn-outline-danger border-0 btn-sm" @click="stockBorrarFila(index)"><i class="icofont-close"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot v-if="stockTotal>0">
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<th>@{{parseFloat(stockTotal)}}</th>
								<th>@{{parseFloat(stockTotalEntrega)}}</th>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row text-center my-3">
		<div class="col d-flex justify-content-center">
			<h4 class="">Ventas al crédito</h4>
		</div>
		<div>
			<button type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addVentasCreditoLista" @click="esNuevo = true; gasDescripcion=''; gasMonto= '0.00';" ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre del cliente</th>
							<th># Nota de Pedido</th>
							<th>Cant.</th>
							<th>Presentación</th>
							<th>Precio</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						{{-- this.vencrePresentacion = $('#sltPresentacionCredito option[value="'+$('#sltPresentacionCredito').val()+'"]').text();
			this.listaVentasCredito.push({ presentacion: this.vencrePresentacion, idPresentacion: vencreIdPresentacion, cliente: this.vencreCliente, nota: this.vencreNumNota, cantidad: this.vencreCantidad, precio: this.vencrePrecio, subTotal: sub	}); --}}
						<tr v-for="(credito, index) of listaVentasCredito">
							<td>@{{index+1}}</td>
							<td>@{{credito.cliente}}</td>
							<td>@{{credito.nota}}</td>
							<td>@{{credito.cantidad}}</td>
							<td>@{{credito.presentacion}}</td>
							<td>@{{parseFloat(credito.precio).toFixed(2)}}</td>
							<td>@{{parseFloat(credito.subTotal).toFixed(2)}}</td>
						</tr>
					</tbody>
					<tfoot v-if="sumCredito>0">
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<th></th>
							<th>@{{parseFloat(sumCredito).toFixed(2)}}</th>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

	<h4 class="my-3 text-center">Cobranza</h4>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre del cliente</th>
							<th>Deuda</th>
							<th>A cuenta</th>
							<th># Nota de Pedido</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Inversiones Don mario</td>
							<td>110.00</td>
							<td>60.00</td>
							<td>50.00</td>
							<td>2485</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<h4 class="my-3 text-center">Pagos por adelantado</h4>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre del cliente</th>
							<th>Monto</th>
							<th>Cantidad</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Inversiones Don mario</td>
							<td>110.00</td>
							<td>60</td>
							<td>12/04/2020</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="row text-center my-3">
		<div class="col d-flex justify-content-center">
			<h4 class="">Gastos</h4>
		</div>
		<div>
			<button type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addGastosLista" @click="esNuevo = true; gasDescripcion=''; gasMonto= '0.00';" ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover" v-if="listaGastos.length>0">
					<thead>
						<tr>
							<th>N°</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>@</th>
						</tr>
					</thead>
					<tbody v-for="(gasto, index) of listaGastos">
						<tr>
							<td>@{{index+1}}</td>
							<td>@{{gasto.descripcion}}</td>
							<td>@{{parseFloat(gasto.monto).toFixed(2)}}</td>
							<td>
								<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addGastosLista" @click="esNuevo=false; gastosEditar(index)"><i class="icofont-edit"></i></button>
								<button class="btn btn-outline-danger border-0 btn-sm" @click="gastosBorrarFila(index)"><i class="icofont-close"></i></button>
							</td>
						</tr>
						
					</tbody>
					<tfoot v-if="gasTotal>0">
						<tr>
							<td></td>
							<td></td>
							<th>@{{parseFloat(gasTotal).toFixed(2)}}</th>
						</tr>
					</tfoot>
				</table>
				<p v-else>No hay registros</p>
			</div>
		</div>
	</div>

	<h4 class="my-3 text-center">Resumen de ventas</h4>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Contado</th>
							<th>Cobranza</th>
							<th>Gastos</th>
							<th>Pagos por adelantado</th>
							<th>Saldo a entregar</th>
							<th>Saldo entregado</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>@{{parseFloat(ventcTotal).toFixed(2)}}</td>
							<td>0.00</td>
							<td>@{{parseFloat(gasTotal).toFixed(2)}}</td>
							<td>0.00</td>
							<td>0.00</td>
							<td>0.00</td>
							
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>



<!-- Modal de ventas al contado -->
<div class="modal fade" id="addVentasContLista" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Venta al Contado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Cantidad</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="ventcCantidad">
				<label class="mt-0 mb-2" for="">Presentación</label>
				<div class="form-group">
					<select id="sltPPresentaciones" class="form-control" name="" v-model="ventcIdPresentacion">
						<option v-for="(producto, index) of listaPresentaciones" :value="index">@{{producto.presentacion}}</option>
					</select>
				</div>
				<label class="mt-0 mb-2" for="">Precio</label>
				<input type="number" name="" id="" class="esMoneda form-control esMoneda" v-model="ventcPrecio">
				<label for="">Total: <strong>@{{parseFloat(ventcCantidad*ventcPrecio).toFixed(2)}}</strong></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="ventcAgregar() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="ventcActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de ventas al credito -->
<div class="modal fade" id="addVentasCreditoLista" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Venta al Crédito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Nombre de cliente</label>
				<input type="text" name="" id="" class=" form-control" v-model="vencreCliente">
				<label class="mt-0 mb-2" for=""># Nota de pedido</label>
				<input type="text" name="" id="" class=" form-control" v-model="vencreNumNota">
				<label class="mt-0 mb-2" for="">Cantidad</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="vencreCantidad">
				<label class="mt-0 mb-2" for="">Presentación</label>
				<div class="form-group">
					<select id="sltPresentacionCredito" class="form-control" name="" v-model="vencreIdPresentacion">
						<option v-for="(producto, index) of listaPresentaciones" :value="index">@{{producto.presentacion}}</option>
					</select>
				</div>
				<label class="mt-0 mb-2" for="">Precio</label>
				<input type="number" name="" id="" class="esMoneda form-control esMoneda" v-model="vencrePrecio">
				<label for="">Total: <strong>@{{parseFloat(vencreCantidad*vencrePrecio).toFixed(2)}}</strong></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="vencreAgregar() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="ventcActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de stock -->
<div class="modal fade" id="addStockEntrega" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Salida de stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Presentación</label>
				<div class="form-group">
					<select id="sltPresentacionStock" class="form-control" name="" v-model="stockIdPresentacion">
						<option v-for="(producto, index) of listaPresentaciones" :value="index">@{{producto.presentacion}}</option>
					</select>
				</div>
				<label class="mt-0 mb-2" for="">Cantidad Pentapeacks</label>
				<input type="number" name="" id="" class=" form-control" v-model="stockPenta">
				<label class="mt-0 mb-2" for="">Cantidad Fabrica</label>
				<input type="number" name="" id="" class=" form-control" v-model="stockFabrica">
				<label class="mt-0 mb-2" for="">Cantidad Oficina</label>
				<input type="number" name="" id="" class=" form-control" v-model="stockOficina">
				<label class="mt-0 mb-2" for="">Retorno</label>
				<input type="number" name="" id="" class=" form-control" v-model="stockRetorno">
				<label class="mt-0 mb-2" for="">Observación</label>
				<input type="text" name="" id="" class=" form-control" v-model="stockObservacion">

				<label for="">Total vendido: <strong>@{{parseFloat(parseFloat(stockPenta)+parseFloat(stockFabrica)+parseFloat(stockOficina))}}</strong></label><br>
				<label for="">Total retorno: <strong>@{{parseFloat(stockRetorno)}}</strong></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="stockAgregar() "> <i class="icofont-plus-circle"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="stockActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de gastos -->
<div class="modal fade" id="addGastosLista" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Gasto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Descripción del gasto</label>
				<input type="text" name="" id="" class="form-control" v-model="gasDescripcion">
				<label class="mt-0 mb-2" for="">Monto</label>
				<input type="number" name="q" id="2" class="esMoneda form-control" v-model="gasMonto">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="agregarGasto() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="actualizarGasto();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>

{{-- Fin de container APP --}}
</div>





@endsection

@section('script')
<script>
	var app = new Vue({
  el: '#app',
  data: {
		listaVentasContado: [],
		listaStockFinal: [],
		listaVentasCredito:[],
		listaCobranza:[],
		listaPagosAdelantado:[],
		listaGastos:[],
		ventcCantidad:0, ventcIdPresentacion:0, ventcPresentacion:'', ventcPrecio: '0.00', ventcSubTotal:0, ventcTotal:0, ventcNuevo: true,
		gasDescripcion:'', gasMonto: '0.00', gasTotal:0, esNuevo: true, idEditar:0,
		stockPenta: 0, stockFabrica: 0, stockOficina:0, stockRetorno:0, stockIdPresentacion:0, stockObservacion:'', stockTotal:0, stockTotalEntrega:0,
		vencreCliente:'', vencreNumNota:'', vencreCantidad:0, vencrePrecio:0, vencreIdPresentacion:0, sumCredito:0, 
		listaPresentaciones:[{
			presentacion: '5x700',
			precio: 13.5
		},{
			presentacion: '10x180',
			precio: 7.50
		},{
			presentacion: 'Letras',
			precio: 7.50
		},{
			presentacion: 'Pan integral',
			precio: 11.00
		},
	]
	},
	methods:{
		agregarGasto(){
			this.listaGastos.push({ monto: this.gasMonto, descripcion: this.gasDescripcion});
			this.gasTotal+=parseFloat(this.gasMonto);
		},
		gastosBorrarFila(index){
			this.gasTotal-= parseFloat(this.listaGastos[index].monto);
			this.listaGastos.splice(index,1);
		},
		gastosEditar(index){
			this.gasDescripcion = this.listaGastos[index].descripcion;
			this.gasMonto = this.listaGastos[index].monto;
			this.idEditar = index;
		},
		actualizarGasto(){
			this.listaGastos[this.idEditar].descripcion = this.gasDescripcion;
			this.gasTotal-= parseFloat(this.listaGastos[this.idEditar].monto);
			this.listaGastos[this.idEditar].monto = this.gasMonto;
			this.gasTotal+=parseFloat(this.gasMonto);
		},
		ventcAgregar(){
			this.ventcPresentacion = $('#sltPPresentaciones option[value="'+$('#sltPPresentaciones').val()+'"]').text();
			this.listaVentasContado.push({ cantidad: this.ventcCantidad, presentacion: this.ventcPresentacion, idPresentacion: this.ventcIdPresentacion,  precio: this.ventcPrecio, ventcSubTotal: parseFloat(this.ventcCantidad*this.ventcPrecio) });
			this.ventcTotal += parseFloat(this.ventcCantidad*this.ventcPrecio);
		},
		ventascEditar(index){
			this.ventcIdPresentacion = this.listaVentasContado[index].idPresentacion;
			this.ventcCantidad = this.listaVentasContado[index].cantidad;
			this.ventcPrecio = this.listaVentasContado[index].precio;
			this.idEditar = index;
		},
		ventcActualizar(){
			this.ventcTotal -= parseFloat( this.listaVentasContado[this.idEditar].ventcSubTotal );

			this.listaVentasContado[ this.idEditar ].idPresentacion = this.ventcIdPresentacion;
			this.listaVentasContado[ this.idEditar ].cantidad = parseFloat(this.ventcCantidad);
			this.listaVentasContado[ this.idEditar ].precio = parseFloat(this.ventcPrecio);
			this.listaVentasContado[ this.idEditar ].ventcSubTotal = parseFloat(this.ventcCantidad*this.ventcPrecio);
			this.listaVentasContado[ this.idEditar ].presentacion = $('#sltPPresentaciones option[value="'+$('#sltPPresentaciones').val()+'"]').text();
			this.ventcTotal += parseFloat(this.ventcCantidad*this.ventcPrecio);
		},
		ventasBorrarFila(index){
			this.ventcTotal-= parseFloat(this.listaVentasContado[index].ventcSubTotal);
			this.listaVentasContado.splice(index,1);
		},
		stockAgregar(){
			let sub= parseFloat(this.stockPenta) + parseFloat(this.stockFabrica) + parseFloat(this.stockOficina);
			this.listaStockFinal.push({ presentacion: $('#sltPresentacionStock option[value="'+$('#sltPresentacionStock').val()+'"]').text(), idPresentacion: this.stockIdPresentacion,
			pentapeaks: this.stockPenta, fabrica: this.stockFabrica, oficina: this.stockOficina, subTotal: sub, retorno: this.stockRetorno, observacion: this.stockObservacion  });
			this.stockTotal+= sub;
			this.stockTotalEntrega += parseFloat(this.stockRetorno);
		},
		stockEditar(index){
			this.stockIdPresentacion = this.listaStockFinal[index].idPresentacion;
			this.stockPenta = this.listaStockFinal[index].pentapeaks;
			this.stockFabrica = this.listaStockFinal[index].fabrica;
			this.stockOficina = this.listaStockFinal[index].oficina;
			this.stockObservacion = this.listaStockFinal[index].observacion;
			
			this.idEditar = index;
		},
		stockActualizar(){
			this.stockTotal -= parseFloat( this.listaStockFinal[this.idEditar].subTotal );
			this.stockTotalEntrega -= parseFloat( this.listaStockFinal[this.idEditar].retorno );

			let sub= parseFloat(this.stockPenta) + parseFloat(this.stockFabrica) + parseFloat(this.stockOficina);
			
			this.listaStockFinal[ this.idEditar ].idPresentacion = this.stockIdPresentacion;
			this.listaStockFinal[ this.idEditar ].presentacion = $('#sltPresentacionStock option[value="'+$('#sltPresentacionStock').val()+'"]').text();
			this.listaStockFinal[ this.idEditar ].pentapeaks = this.stockPenta;
			this.listaStockFinal[ this.idEditar ].fabrica = this.stockFabrica;
			this.listaStockFinal[ this.idEditar ].oficina = this.stockOficina;
			this.listaStockFinal[ this.idEditar ].subTotal = sub;
			this.listaStockFinal[ this.idEditar ].retorno = this.stockRetorno;

			this.stockTotal+= sub;
			this.stockTotalEntrega += parseFloat(this.stockRetorno);

		},
		stockBorrarFila(index){
			this.stockTotal -= parseFloat( this.listaStockFinal[index].subTotal );
			this.stockTotalEntrega -= parseFloat( this.listaStockFinal[index].retorno );
			this.listaStockFinal.splice(index,1);
		},
		vencreAgregar(){
			let sub = parseFloat(this.vencrePrecio)	* parseFloat(this.vencreCantidad)
			this.vencrePresentacion = $('#sltPresentacionCredito option[value="'+$('#sltPresentacionCredito').val()+'"]').text();
			this.listaVentasCredito.push({ presentacion: this.vencrePresentacion, idPresentacion: this.vencreIdPresentacion, cliente: this.vencreCliente, nota: this.vencreNumNota, cantidad: this.vencreCantidad, precio: this.vencrePrecio, subTotal: sub	});
			this.sumCredito += sub;

		}
	}
});
$("input").focus(function() {
   $(this).select();
});
</script>
@endsection
