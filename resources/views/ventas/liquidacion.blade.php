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
	<div class="card">
		<div class="card-body">
			<form class="row">
				<div class="col">
					<label class="" for="">Fecha</label>
					<input type="date" class="form-control mb-2 mr-sm-2" id="" placeholder="Fecha" value="<?= date('Y-m-d');?>" v-model="fichFecha">
				</div>
			
				<div class="col">
					<label class="" for="">Vendedor</label>
					<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="Vendedor" value="" v-model="fichVendedor">
				</div>
				<div class="col">
					<label class="" for="">Lugar</label>
					<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="Lugar" value="" v-model="fichLugar">
				</div>
				<div class="col">
					<label class="" for="">Placa</label>
					<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="Placa" value="" v-model="fichPlaca">
				</div>
				<div class="col">
					<label class="" for="">Saldo que entrega</label>
					<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="Entrega" value="" v-model="entregado">
				</div>
			
				<div class="col d-flex align-items-end">
					<button type="button" class="btn btn-primary mb-2" @click="guardarFicha"> <i class="icofont-save"></i> Guardar ficha</button>
				</div>
			</form>
		</div>
	</div>
	
	<div class="row row-cols-1">
		<div class="col">
			<div class="row text-center my-3">
				<div class="col d-flex justify-content-center">
					<h4 class="">Ventas al contado</h4>
				</div>
				<div>
					<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addVentasContLista" @click="esNuevo = true; ventcCantidad=0; gasDescripcion=''; ventcPrecio= '0.00';" ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover" v-if="listaVentasContado.length>0">
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
					<p v-else>No hay registros</p>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="row text-center my-3">
				<div class="col d-flex justify-content-center">
					<h4 class="">Stock final</h4>
				</div>
			<div>
					<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addStockEntrega" @click="esNuevo = true; stockPenta=0; stockFabrica=0; stockOficina=0;stockRetorno=0;stockObservacion=''; " ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover" v-if="listaStockFinal.length>0">
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
					<p v-else>No hay registros</p>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-cols-1">
		<div class="col">
			<div class="row text-center my-3">
				<div class="col d-flex justify-content-center">
					<h4 class="">Bonificaciones</h4>
				</div>
				<div>
					<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addBonificacionLista" @click="esNuevo = true; bonCantidad=0; bonObservacion=0;" ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover" v-if="listaBonificaciones.length>0">
						<thead>
							<tr>
								<th>N°</th>
								<th>Presentación</th>
								<th>Cant.</th>
								<th>Observación</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(bonificacion, index) of listaBonificaciones">
								<td>@{{index+1}}</td>
								<td>@{{bonificacion.presentacion}}</td>
								<td>@{{bonificacion.cantidad}}</td>
								<td>@{{bonificacion.observacion}}</td>
								<td>
									<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addBonificacionLista" @click="esNuevo=false; bonifEditar(index)"><i class="icofont-edit"></i></button>
									<button class="btn btn-outline-danger border-0 btn-sm" @click="bonifBorrarFila(index)"><i class="icofont-close"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot v-if="bonifTotal>0">
							<tr>
								<td></td>
								<td></td>
								<th>@{{parseFloat(bonifTotal).toFixed(0)}}</th>
								<td></td>
							</tr>
						</tfoot>
					</table>
					<p v-else>No hay registros</p>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="row text-center my-3">
				<div class="col d-flex justify-content-center">
					<h4 class="">Stock final</h4>
				</div>
			<div>
					<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addStockEntrega" @click="esNuevo = true; stockPenta=0; stockFabrica=0; stockOficina=0; stockRetorno=0; stockObservacion='' " ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover" v-if="listaStockFinal.length>0">
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
					<p v-else>No hay registros</p>
				</div>
			</div>
		</div>
	</div>

	<div class="row text-center my-3">
		<div class="col d-flex justify-content-center">
			<h4 class="">Ventas al crédito</h4>
		</div>
		<div>
			<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addVentasCreditoLista" @click="esNuevo = true; vencreCliente='', vencreNumNota='', vencreCantidad=0; vencrePrecio=0; " ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover" v-if="listaVentasCredito.length>0">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre del cliente</th>
							<th># Nota de Pedido</th>
							<th>Cant.</th>
							<th>Presentación</th>
							<th>Precio</th>
							<th>Total</th>
							<td>@</td>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(credito, index) of listaVentasCredito">
							<td>@{{index+1}}</td>
							<td>@{{credito.cliente}}</td>
							<td>@{{credito.nota}}</td>
							<td>@{{credito.cantidad}}</td>
							<td>@{{credito.presentacion}}</td>
							<td>@{{parseFloat(credito.precio).toFixed(2)}}</td>
							<td>@{{parseFloat(credito.subTotal).toFixed(2)}}</td>
							<td>
								<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addVentasCreditoLista" @click="esNuevo=false; creditoEditar(index)"><i class="icofont-edit"></i></button>
								<button class="btn btn-outline-danger border-0 btn-sm" @click="creditoBorrarFila(index)"><i class="icofont-close"></i></button>
							</td>
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
				<p v-else>No hay registros</p>
			</div>
		</div>
	</div>

	<div class="row text-center my-3">
		<div class="col d-flex justify-content-center">
			<h4 class="">Cobranza</h4>
		</div>
		<div>
			<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addCobranzaLista" @click="esNuevo = true; cobraCliente= ''; cobraDeuda= 0; cobraAcuenta= 0; cobraSaldo= 0; cobraNumNota= ''; " ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover" v-if="listaCobranza.length>0">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre del cliente</th>
							<th>Deuda</th>
							<th>A cuenta</th>
							<th>Saldo</th>
							<th># Nota de Pedido</th>
							<th>@</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(cobro, index) of listaCobranza">
							<td>@{{index+1}}</td>
							<td>@{{cobro.cliente}}</td>
							<td>@{{parseFloat(cobro.deuda).toFixed(2)}}</td>
							<td>@{{parseFloat(cobro.acuenta).toFixed(2)}}</td>
							<td>@{{parseFloat(cobro.saldo).toFixed(2)}}</td>
							<td>@{{cobro.nota}}</td>
							<td>
								<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addCobranzaLista" @click="esNuevo=false; cobroEditar(index)"><i class="icofont-edit"></i></button>
								<button class="btn btn-outline-danger border-0 btn-sm" @click="cobroBorrarFila(index)"><i class="icofont-close"></i></button>
							</td>
						</tr>
					</tbody>
					<tfoot v-if="sumCobranza>0">
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<th>@{{parseFloat(sumCobranza).toFixed(2)}}</th>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
				<p v-else>No hay registros</p>
			</div>
		</div>
	</div>

	<div class="row text-center my-3">
		<div class="col d-flex justify-content-center">
			<h4 class="">Pagos por adelantado</h4>
		</div>
		<div>
			<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addAdelantoLista" @click="esNuevo = true; adelaCliente= ''; adelaMonto= 0; adelaCantidad= 0; adelaFecha= '<?= date('Y-m-d'); ?>'; " ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover" v-if="listaAdelantos.length>0">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre del cliente</th>
							<th>Monto</th>
							<th>Cantidad</th>
							<th>Fecha</th>
							<th>@</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(adelanto, index) of listaAdelantos">
							<td>@{{index+1}}</td>
							<td>@{{adelanto.cliente}}</td>
							<td>@{{parseFloat(adelanto.monto).toFixed(2)}}</td>
							<td>@{{adelanto.cantidad}}</td>
							<td>@{{fechaFormateada(adelanto.fecha)}}</td>
							<td>
								<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addAdelantoLista" @click="esNuevo=false; adelantoEditar(index)"><i class="icofont-edit"></i></button>
								<button class="btn btn-outline-danger border-0 btn-sm" @click="adelantoBorrarFila(index)"><i class="icofont-close"></i></button>
							</td>
						</tr>
					</tbody>
					<tfoot v-if="sumAdelanto>0">
						<tr>
							<td></td>
							<td></td>
							<th>@{{parseFloat(sumAdelanto).toFixed(2)}}</th>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
				<p v-else>No hay registros</p>
			</div>
		</div>
	</div>

	<div class="row text-center my-3">
		<div class="col d-flex justify-content-center">
			<h4 class="">Gastos</h4>
		</div>
		<div>
			<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addGastosLista" @click="esNuevo = true; gasDescripcion=''; gasMonto= '0.00';" ><i class="icofont-ui-add"></i></button>
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
							<td></td>
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
							<td>@{{parseFloat(sumCobranza).toFixed(2)}}</td>
							<td>@{{parseFloat(gasTotal).toFixed(2)}}</td>
							<td>@{{parseFloat(sumAdelanto).toFixed(2)}}</td>
							<td v-bind:class="{'text-danger': sumaTotales!=entregado, 'text-primary': sumaTotales==entregado } ">@{{parseFloat(sumaTotales).toFixed(2)}}</td>
							<td v-bind:class="{'text-danger': sumaTotales!=entregado, 'text-primary': sumaTotales==entregado } ">@{{parseFloat(entregado).toFixed(2)}}</td>
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
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="vencreActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de cobranza -->
<div class="modal fade" id="addCobranzaLista" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cobranza</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Nombre de cliente</label>
				<input type="text" name="" id="" class=" form-control" v-model="cobraCliente">
				
				<label class="mt-0 mb-2" for="">Deuda</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="cobraDeuda">
				<label class="mt-0 mb-2" for="">A cuenta</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="cobraAcuenta">
				<label class=" mb-2" for="">Saldo <strong>@{{cobraSaldos}}</strong></label> <br>
				<label class="mt-0 mb-2" for=""># Nota de pedido</label>
				<input type="text" name="" id="" class=" form-control" v-model="cobraNumNota">
				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="cobroAgregar() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="cobroActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de Pagos por adelantado -->
<div class="modal fade" id="addAdelantoLista" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pagos por adelantado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Nombre de cliente</label>
				<input type="text" name="" id="" class=" form-control" v-model="adelaCliente">
				<label class="mt-0 mb-2" for="">Monto</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="adelaMonto">
				<label class="mt-0 mb-2" for="">Cantidad</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="adelaCantidad">
				<label class="mt-0 mb-2" for="">Fecha</label>
				<input type="date" name="" id="" class=" form-control" v-model="adelaFecha">
				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="adelaAgregar() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="adelaActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Gasto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Descripción del gasto</label>
				<input type="text" name="" id="" class="form-control" v-model="gasDescripcion">
				<label class="mt-0 mb-2" for="">Monto</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="gasMonto">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="agregarGasto() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="actualizarGasto();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de Bonificaciones -->
<div class="modal fade" id="addBonificacionLista" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Bonificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<label class="mt-0 mb-2" for="">Cantidad</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="bonCantidad">
				<label class="mt-0 mb-2" for="">Presentación</label>
				<div class="form-group">
					<select id="sltPresentacionBonif" class="form-control" name="" v-model="bonIdPresentacion">
						<option v-for="(producto, index) of listaPresentaciones" :value="index">@{{producto.presentacion}}</option>
					</select>
				</div>
				<label class="mt-0 mb-2" for="">Observación</label>
				<input type="text" name="" id="" class="form-control" v-model="bonObservacion">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="agregarBonificacion() "> <i class="icofont-sale-discount"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="bonifActualizar();"> <i class="icofont-sale-discount"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>

{{-- Fin de container APP --}}
</div>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>



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
		listaAdelantos:[],
		listaGastos:[],
		listaBonificaciones:[],
		ventcCantidad:0, ventcIdPresentacion:0, ventcPresentacion:'', ventcPrecio: '0.00', ventcSubTotal:0, ventcTotal:0, ventcNuevo: true,
		gasDescripcion:'', gasMonto: '0.00', gasTotal:0, esNuevo: true, idEditar:0,
		stockPenta: 0, stockFabrica: 0, stockOficina:0, stockRetorno:0, stockIdPresentacion:0, stockObservacion:'', stockTotal:0, stockTotalEntrega:0,
		vencreCliente:'', vencreNumNota:'', vencreCantidad:0, vencrePrecio:0, vencreIdPresentacion:0, sumCredito:0,
		cobraCliente: '', cobraDeuda: 0, cobraAcuenta: 0, cobraSaldo:0, cobraNumNota: '', sumCobranza:0,
		adelaCliente: '', adelaMonto: 0, adelaCantidad: 0, adelaFecha: '<?= date('Y-m-d'); ?>', sumAdelanto:0, entregado:0,
		bonDescripcion:'',bonCantidad:0, bonifTotal:0, bonIdPresentacion:0, bonObservacion:'',
		fichFecha: '<?= date('Y-m-d')?>', fichVendedor: '', fichLugar: '', fichPlaca: '',
		guardado: false,
		listaPresentaciones:[{presentacion: 'Galleta de agua Bolsa 1.6kg Marie', precio: 0.00},
			{presentacion: 'Galleta de agua Bolsa 1.2kg Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Bolsa 1.05kg Rey del centro',precio: 0.00},
			{presentacion: 'Galleta de agua Display 5x 0.95kg Rey del centro',precio: 0.00},
			{presentacion: 'Galleta de agua Display 5x 0.95kg Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Display 5x 0.7kg Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Display 10x 1.7kg Marie',precio: 0.00},
			{presentacion: 'Galleta de letras Display 10x 1.4kg Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Display 10x 1.65kg Rey del centro',precio: 0.00},
			{presentacion: 'Pan de molde blanco Marie',precio: 0.00},
			{presentacion: 'Pan de molde integral Marie',precio: 0.00},
			{presentacion: 'Keke domo Marie',precio: 0.00},
			{presentacion: 'Keke pirotín Rey del centro',precio: 0.00},

			{presentacion: 'Galleta de agua Marie Bolsa 1.2kg ',precio: 0.00}]
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
			let sub = parseFloat(this.vencrePrecio)	* parseFloat(this.vencreCantidad);
			this.vencrePresentacion = $('#sltPresentacionCredito option[value="'+$('#sltPresentacionCredito').val()+'"]').text();
			this.listaVentasCredito.push({ presentacion: this.vencrePresentacion, idPresentacion: this.vencreIdPresentacion, cliente: this.vencreCliente, nota: this.vencreNumNota, cantidad: this.vencreCantidad, precio: this.vencrePrecio, subTotal: sub	});
			this.sumCredito += sub;
		},
		creditoEditar(index){
			this.vencreIdPresentacion = this.listaVentasCredito[index].idPresentacion;
			this.vencreCliente = this.listaVentasCredito[index].cliente;
			this.vencreNumNota = this.listaVentasCredito[index].nota;
			this.vencreCantidad = this.listaVentasCredito[index].cantidad;
			this.vencrePrecio = this.listaVentasCredito[index].precio;
			this.idEditar = index;
		},
		vencreActualizar(){
			let sub = parseFloat(this.vencrePrecio)	* parseFloat(this.vencreCantidad);
			this.sumCredito -= parseFloat(this.listaVentasCredito[ this.idEditar ].subTotal);

			this.listaVentasCredito[ this.idEditar ].idPresentacion = this.vencreIdPresentacion ;
			this.listaVentasCredito[ this.idEditar ].cliente = this.vencreCliente ;
			this.listaVentasCredito[ this.idEditar ].nota = this.vencreNumNota ;
			this.listaVentasCredito[ this.idEditar ].cantidad = this.vencreCantidad ;
			this.listaVentasCredito[ this.idEditar ].precio = this.vencrePrecio ;
			this.listaVentasCredito[ this.idEditar ].subTotal = sub ;
			this.sumCredito += sub;
		},
		creditoBorrarFila(index){
			this.sumCredito-= parseFloat( this.listaVentasCredito[this.idEditar].subTotal );
			this.listaVentasCredito.splice(index,1);
		},
		cobroAgregar(){
			this.listaCobranza.push({cliente: this.cobraCliente, deuda: this.cobraDeuda, acuenta: this.cobraAcuenta, saldo: this.cobraSaldos, nota: this.cobraNumNota });
			this.sumCobranza+= parseFloat(this.cobraAcuenta);
		},
		cobroEditar(index){
			this.cobroCliente = this.listaCobranza[index].cliente;
			this.cobraDeuda = this.listaCobranza[index].deuda;
			this.cobraAcuenta = this.listaCobranza[index].acuenta;
			this.cobraNumNota = this.listaCobranza[index].nota;
			this.idEditar = index;
		},
		cobroActualizar(){
			this.sumCobranza-= parseFloat(this.listaCobranza[this.idEditar].acuenta);

			this.listaCobranza[this.idEditar].cliente= this.cobraCliente;
			this.listaCobranza[this.idEditar].deuda= this.cobraDeuda;
			this.listaCobranza[this.idEditar].acuenta= this.cobraAcuenta;
			this.listaCobranza[this.idEditar].saldo= this.cobraSaldos;
			this.listaCobranza[this.idEditar].nota= this.cobraNumNota;

			this.sumCobranza+=parseFloat(this.cobraAcuenta);

		},
		cobroBorrarFila(index){
			this.sumCobranza-= parseFloat( this.listaCobranza[index].acuenta);
			this.listaCobranza.splice(index,1);
		},
		adelaAgregar(){
			this.listaAdelantos.push({cliente: this.adelaCliente, monto: this.adelaMonto, cantidad: this.adelaCantidad, fecha: this.adelaFecha });
			this.sumAdelanto+= parseFloat(this.adelaMonto);
		},
		adelantoEditar(index){
			this.adelaCliente = this.listaAdelantos[index].cliente;
			this.adelaMonto = this.listaAdelantos[index].monto
			this.adelaCantidad = this.listaAdelantos[index].cantidad;
			this.adelaFecha = this.listaAdelantos[index].fecha;
			this.idEditar = index;
		},
		adelaActualizar(){
			this.sumAdelanto-=parseFloat(this.listaAdelantos[this.idEditar].monto);

			this.listaAdelantos[this.idEditar].cliente = this.adelaCliente;
			this.listaAdelantos[this.idEditar].monto = this.adelaMonto;
			this.listaAdelantos[this.idEditar].cantidad = this.adelaCantidad;
			this.listaAdelantos[this.idEditar].fecha = this.adelaFecha;
			this.sumAdelanto+= parseFloat(this.adelaMonto);
		},
		adelantoBorrarFila(index){
			this.sumAdelanto-= this.listaAdelantos[index].monto;
			this.listaAdelantos.splice(index,1);
		},
		fechaFormateada(fecha){
			return moment(fecha).format('DD/MM/YYYY');
		},
		agregarBonificacion(){
			this.bonDescripcion = $('#sltPresentacionBonif option[value="'+$('#sltPresentacionBonif').val()+'"]').text();
			this.listaBonificaciones.push({ cantidad: this.bonCantidad, presentacion: this.bonDescripcion, idPresentacion: $('#sltPresentacionBonif').val(), observacion: this.bonObservacion});
			this.bonifTotal+=parseFloat(this.bonCantidad);
		},
		bonifEditar(index){
			this.bonIdPresentacion = this.listaBonificaciones[index].idPresentacion;
			this.bonDescripcion = this.listaBonificaciones[index].presentacion;
			this.bonCantidad = this.listaBonificaciones[index].cantidad;
			this.idEditar = index;
		},
		bonifActualizar(){
			this.bonifTotal-=parseFloat(this.listaBonificaciones[this.idEditar].cantidad);

			this.listaBonificaciones[this.idEditar].idPresentacion= $('#sltPresentacionBonif').val()
			this.listaBonificaciones[this.idEditar].presentacion = this.bonDescripcion;
			this.listaBonificaciones[this.idEditar].cantidad = this.bonCantidad;
			this.bonifTotal+= parseFloat(this.bonCantidad);
		},
		bonifBorrarFila(index){
			this.bonifTotal-= parseFloat(this.listaBonificaciones[index].cantidad);
			this.listaBonificaciones.splice(index,1);
		},
		guardarFicha(){
			axios.post('{{route("liquidacion.insertar")}}', {
				fecha: this.fichFecha, vendedor: this.fichVendedor, placa: this.fichPlaca, lugar: this.fichLugar,
				sumaContado: this.ventcTotal, sumaCobranza: this.sumCobranza, sumaCredito: this.ventcTotal, sumaGasto: this.gasTotal, sumaAdelanto: this.sumAdelanto, sumaEntregar: this.sumaTotales, sumaEntregado: this.entregado,
				alContado: this.listaVentasContado, stockFinal: this.listaStockFinal, alCredito: this.listaVentasCredito, vCobranza: this.listaCobranza, adelantos: this.listaAdelantos, listaGastos: this.listaGastos, listaBonificacion: this.listaBonificaciones
			}).then(function(resp){
				console.log(resp);
				this.guardado=true;
				if(isNaN(parseInt(resp))){ //alert('Ficha guardada');
					alertify.alert('Notificación','Ficha guardada').set({transition:'fade'});
				}
			});
		}
	},
	computed:{
		cobraSaldos(){
			return parseFloat(this.cobraDeuda - this.cobraAcuenta).toFixed(2);
		},
		sumaTotales(){
			return parseFloat(this.ventcTotal)+ parseFloat(this.sumCobranza) + parseFloat(this.sumAdelanto) - parseFloat(this.gasTotal);
		}
	}
});
$("input").focus(function() {
   $(this).select();
});
</script>
@endsection
