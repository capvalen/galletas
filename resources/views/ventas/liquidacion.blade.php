@extends('plantillas.panel')

@section('css')
<style>
	#divPlacas li{
		text-transform: uppercase;
	}
	#provPlacas::placeholder{
		text-transform: capitalize;
	}
	.divProviders li{ text-transform: capitalize; }
</style>
@endsection

@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Liquidaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nueva</li>
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
			
				<div class="col divProviders">
					<label class="" for="">Vendedor</label>
					<input type="text" class="form-control mb-2 mr-sm-2 text-capitalize" id="provVendedores" placeholder="Vendedor" value="" v-model="fichVendedor">
				</div>
				<div class="col divProviders">
					<label class="" for="">Lugar</label>
					<input type="text" class="form-control mb-2 mr-sm-2 text-capitalize" id="provLugar" placeholder="Lugar" value="" v-model="fichLugar">
				</div>
				<div class="col" id="divPlacas">
					<label class="" for="">Placa</label>
					<input type="text" class="form-control mb-2 mr-sm-2 text-uppercase" id="provPlacas" placeholder="Placa" value="" v-model="fichPlaca">
				</div>
				<div class="col">
					<label class="" for="">Conductor</label>
					<input type="text" class="form-control mb-2 mr-sm-2" id="" placeholder="Conductor" value="" v-model="fichConductor">
				</div>
				<div class="col">
					<label class="" for="">Saldo que entrega</label>
					<input type="number" class="form-control mb-2 mr-sm-2 esMoneda" id="txtEntrega" placeholder="Entrega" value="" v-model="entregado">
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
								<th>Retorno</th>
								<th>Vencido/ Dañado</th>
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
								<td>@{{stock.vencido}}</td>
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
					<h4 class="">Bonificación - Degustación</h4>
				</div>
				<div>
					<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addBonificacionLista" @click="esNuevo = true; bonCantidad=0; bonCliente='', bonBonificacion=0, bonDireccion=''; bonObservacion=''; bonQuees=1;" ><i class="icofont-ui-add"></i></button>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-hover" v-if="listaBonificaciones.length>0">
						<thead>
							<tr>
								<th>N°</th>
								<th>Tipo</th>
								<th>Presentación</th>
								<th>Cant.</th>
								<th>Oferta</th>
								<th>Cliente.</th>
								<th>Dirección.</th>
								<th>Observación</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(bonificacion, index) of listaBonificaciones">
								<td>@{{index+1}}</td>
								<td><span v-if="bonificacion.esBono=='1'">Bonificación</span><span v-else>Degustación</span></td>
								<td>@{{bonificacion.presentacion}}</td>
								<td>@{{bonificacion.cantidad}}</td>
								<td>@{{bonificacion.bonificacion}}</td>
								<td class="text-capitalize">@{{bonificacion.cliente}}</td>
								<td>@{{bonificacion.direccion}}</td>
								<td>@{{bonificacion.observacion}}</td>
								<td>
									<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addBonificacionLista" @click="esNuevo=false; bonifEditar(index)"><i class="icofont-edit"></i></button>
									<button class="btn btn-outline-danger border-0 btn-sm" @click="bonifBorrarFila(index)"><i class="icofont-close"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot v-if="bonifTotal>0">
							<tr>
								<td></td><td></td>
								<td></td><td></td>
								<th>@{{parseFloat(bonifTotal).toFixed(0)}}</th>
								<td></td><td></td>
								<td></td><td></td>
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
							<td class="text-capitalize">@{{credito.cliente}}</td>
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
							<td class="text-capitalize">@{{cobro.cliente}}</td>
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
			<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addAdelantoLista" @click="esNuevo = true; adelaCliente= ''; adelaMonto= 0; adelaCantidad= 0; adelaFecha= '<?= date('Y-m-d'); ?>'; adelaBonificacion=0; " ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover" v-if="listaAdelantos.length>0">
					<thead>
						<tr>
							<th>N°</th>
							<th>Presentación</th>
							<th>Nombre del cliente</th>
							<th>Monto</th>
							<th>Cantidad</th>
							<th>Bonificación</th>
							<th>@</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(adelanto, index) of listaAdelantos">
							<td>@{{index+1}}</td>
							<td>@{{adelanto.presentacion}}</td>
							<td class="text-capitalize">@{{adelanto.cliente}}</td>
							<td>@{{parseFloat(adelanto.monto).toFixed(2)}}</td>
							<td>@{{adelanto.cantidad}}</td>
							<td>@{{adelanto.bonificacion}}{{-- @{{fechaFormateada(adelanto.fecha)}} --}}</td>
							<td>
								<button class="btn btn-outline-primary border-0 btn-sm" data-toggle="modal" data-target="#addAdelantoLista" @click="esNuevo=false; adelantoEditar(index)"><i class="icofont-edit"></i></button>
								<button class="btn btn-outline-danger border-0 btn-sm" @click="adelantoBorrarFila(index)"><i class="icofont-close"></i></button>
							</td>
						</tr>
					</tbody>
					<tfoot v-if="sumAdelanto>0">
						<tr>
							<td></td>
							<td></td><td></td>
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
			<button v-show="!guardado" type="button" class="btn btn-outline-dark mr-5" data-toggle="modal" data-target="#addGastosLista" @click="esNuevo = true; gasDescripcion=''; gasMonto= '0.00'; gasidComprobante=1; gasComprobante=''; gasidDestino=1; gasDestino=''; " ><i class="icofont-ui-add"></i></button>
		</div>
	</div>
	<div class="row col">
		<div class="card w-100">
			<div class="card-body">
				<table class="table table-hover" v-if="listaGastos.length>0">
					<thead>
						<tr>
							<th>N°</th>
							<th>Destino</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Tipo de Comprobante</th>
							<th>Serie y Correlativo</th>
							<th>@</th>
						</tr>
					</thead>
					<tbody v-for="(gasto, index) of listaGastos">
						<tr>
							<td>@{{index+1}}</td>
							<td>@{{gasto.destino}}</td>
							<td>@{{gasto.descripcion}}</td>
							<td>@{{parseFloat(gasto.monto).toFixed(2)}}</td>
							<td>@{{gasto.tipoComprobante}}</td>
							<td>@{{gasto.comprobante}}</td>
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
							<td></td><td></td><td></td>
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
				<label class="mt-0 mb-2" for="">Presentación</label>
				<div class="form-group">
					<select id="sltPresentacionAdela" class="form-control" name="" v-model="adelaIdPresentacion">
						<option v-for="(producto, index) of listaPresentaciones" :value="index">@{{producto.presentacion}}</option>
					</select>
				</div>
				<label class="mt-0 mb-2" for="">Nombre de cliente</label>
				<input type="text" name="" id="" class=" form-control text-capitalize" v-model="adelaCliente">
				<label class="mt-0 mb-2" for="">Monto</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="adelaMonto">
				<label class="mt-0 mb-2" for="">Cantidad</label>
				<input type="number" name="" id="" class="esMoneda form-control" v-model="adelaCantidad">
				<label class="mt-0 mb-2" for="">Bonif.</label>
				<input type="number" name="" id="" class=" form-control" v-model="adelaBonificacion">
				
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
				<label class="mt-0 mb-2" for="">Vencido o Dañado</label>
				<input type="number" name="" id="" class=" form-control" v-model="stockVencido">
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
				<label class="mt-0 my-2" for="">Destino de gasto</label>
				<div class="form-group">
					<select id="sltDestinos" class="form-control" name="" v-model="gasidDestino">
						<option v-for="(destino, index) of listaDestinos" :value="destino.id">@{{destino.destino}}</option>
					</select>
				</div>
				<label class="mt-0 my-2" for="">Tipo comprobante</label>
				<div class="form-group">
					<select id="sltGrupoComprobantes" class="form-control" name="" v-model="gasidComprobante">
						<option v-for="(comprobante, index) of listaComprobantes" :value="comprobante.id">@{{comprobante.descripcion}}</option>
					</select>
				</div>
				<label v-if="gasidComprobante!='1'" for="">Serie y correlativo del comprobante</label>
				<input type="text" name="" id="" v-if="gasidComprobante!='1'" class="form-control" v-model="gasComprobante">
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
				<label for="">¿Qué es?</label>
				<select id="sltQueBonif" class="form-control" name="" v-model="bonQuees">
					<option value="1">Bonificación</option>
					<option value="0">Degustación</option>
				</select>
				<label class="mt-0 my-2" for="">Presentación</label>
				<div class="form-group">
					<select id="sltPresentacionBonif" class="form-control" name="" v-model="bonIdPresentacion">
						<option v-for="(producto, index) of listaPresentaciones" :value="index">@{{producto.presentacion}}</option>
					</select>
				</div>
				<label class="mt-0 my-2" for="">Cantidad</label>
				<input type="number" name="" id="" class=" form-control" v-model="bonCantidad">
				<label class="mt-0 my-2" for=""><span v-if="bonQuees=='1'">Cant. Bonificaciones entregadas</span><span v-else>Cant: Degustaciones dadas:</span></label>
				<input type="number" name="" id="" class=" form-control" v-model="bonBonificacion">
				<label class="mt-0 my-2" for="">Nombre de cliente</label>
				<input type="text" name="" id="" class=" form-control text-capitalize" v-model="bonCliente">
				<label class="mt-0 my-2" for="">Dirección de cliente</label>
				<input type="text" name="" id="" class=" form-control text-capitalize" v-model="bonDireccion">
				<label class="mt-0 my-2" for="">Observación</label>
				<input type="text" name="" id="" class="form-control" value="" v-model="bonObservacion">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" v-if="esNuevo" data-dismiss="modal" @click="agregarBonificacion() "> <i class="icofont-ticket"></i> Insertar</button>
        <button type="button" class="btn btn-outline-warning" v-if="!esNuevo" data-dismiss="modal" @click="bonifActualizar();"> <i class="icofont-ticket"></i> Actualizar</button>
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
		gasDescripcion:'', gasMonto: '0.00', gasTotal:0, esNuevo: true, idEditar:0, gasidComprobante:0, gasTipoComprobante:'', gasComprobante:'', gasidDestino:0, gasDestino:'',
		stockPenta: 0, stockFabrica: 0, stockOficina:0, stockRetorno:0, stockIdPresentacion:0, stockObservacion:'', stockTotal:0, stockTotalEntrega:0, stockVencido:0,
		vencreCliente:'', vencreNumNota:'', vencreCantidad:0, vencrePrecio:0, vencreIdPresentacion:0, sumCredito:0,
		cobraCliente: '', cobraDeuda: 0, cobraAcuenta: 0, cobraSaldo:0, cobraNumNota: '', sumCobranza:0,
		adelaCliente: '', adelaMonto: 0, adelaCantidad: 0, adelaFecha: '<?= date('Y-m-d'); ?>', adelaBonificacion:0, sumAdelanto:0, entregado:0, adelaIdPresentacion: '', adelaPresentacion:'',
		bonDescripcion:'',bonCantidad:0, bonifTotal:0, bonIdPresentacion:0, bonObservacion:'', bonBonificacion:0, bonCliente:'', bonDireccion:'', bonQuees:1,
		fichFecha: '<?= date('Y-m-d')?>', fichVendedor: '', fichLugar: '', fichPlaca: '', fichConductor:'',
		guardado: false,
		listaPresentaciones:[
			{presentacion: 'Ningún producto', precio: 0.00},
			{presentacion: 'Galleta de agua Bolsa 1.57kg Marie', precio: 0.00},
			{presentacion: 'Galleta de agua Bolsa 1.2kg Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Bolsa 1 kg Rey del centro',precio: 0.00},
			{presentacion: 'Galleta de agua Display 5x 950 Rey del centro',precio: 0.00},
			{presentacion: 'Galleta de agua Display 5x 950 Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Display 5x 700 Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Display 10x 18 Marie de 0.17kg',precio: 0.00},
			{presentacion: 'Galleta de letras Display 10x 140 Marie',precio: 0.00},
			{presentacion: 'Galleta de agua Display 10x 22 Rey del centro',precio: 0.00},
			{presentacion: 'Pan de molde blanco Marie',precio: 0.00},
			{presentacion: 'Pan de molde integral Marie',precio: 0.00},
			{presentacion: 'Keke domo Marie',precio: 0.00},
			{presentacion: 'Keke pirotín Rey del centro',precio: 0.00},
			{presentacion: 'Galleta de agua Marie Bolsa 1.2kg',precio: 0.00},
			{presentacion: 'Pre mezcla x Saco',precio: 0.00},
			{presentacion: 'Galleta de agua Display 10x 18 Marie de 0.16kg',precio: 0.00}
			],
			
		listaComprobantes: JSON.parse({!! json_encode($comprobantes) !!}),
		listaDestinos: JSON.parse({!! json_encode($destinos) !!}),
	},
	methods:{
		agregarGasto(){
			this.gasTipoComprobante = $('#sltGrupoComprobantes option[value="'+$('#sltGrupoComprobantes').val()+'"]').text();
			this.gasDestino = $('#sltDestinos option[value="'+$('#sltDestinos').val()+'"]').text();
			this.listaGastos.push({ monto: this.gasMonto, descripcion: this.gasDescripcion, idComprobante: this.gasidComprobante, comprobante: this.gasComprobante, tipoComprobante: this.gasTipoComprobante, idDestino:this.gasidDestino, destino: this.gasDestino });
			this.gasTotal+=parseFloat(this.gasMonto);
		},
		gastosBorrarFila(index){
			this.gasTotal-= parseFloat(this.listaGastos[index].monto);
			this.listaGastos.splice(index,1);
		},
		gastosEditar(index){
			this.gasDescripcion = this.listaGastos[index].descripcion;
			this.gasMonto = this.listaGastos[index].monto;
			this.gasidComprobante = this.listaGastos[index].idComprobante;
			this.gasComprobante = this.listaGastos[index].comprobante;
			this.gasComprobante = this.listaGastos[index].comprobante;
			this.gasidDestino = this.listaGastos[index].idDestino;
			this.idEditar = index;
		},
		actualizarGasto(){
			this.gasTipoComprobante = $('#sltGrupoComprobantes option[value="'+$('#sltGrupoComprobantes').val()+'"]').text();
			this.gasDestino = $('#sltDestinos option[value="'+$('#sltDestinos').val()+'"]').text();
			this.listaGastos[this.idEditar].descripcion = this.gasDescripcion;
			this.gasTotal-= parseFloat(this.listaGastos[this.idEditar].monto);
			this.listaGastos[this.idEditar].monto = this.gasMonto;
			this.listaGastos[this.idEditar].comprobante = this.gasComprobante;
			this.listaGastos[this.idEditar].idComprobante = this.gasidComprobante;
			this.listaGastos[this.idEditar].tipoComprobante = this.gasTipoComprobante;
			this.listaGastos[this.idEditar].idDestino = this.gasidDestino;
			this.listaGastos[this.idEditar].destino = this.gasDestino;
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
			pentapeaks: this.stockPenta, fabrica: this.stockFabrica, oficina: this.stockOficina, subTotal: sub, retorno: this.stockRetorno, vencido: this.stockVencido, observacion: this.stockObservacion  });
			this.stockTotal+= sub;
			this.stockTotalEntrega += parseFloat(this.stockRetorno);
		},
		stockEditar(index){
			this.stockIdPresentacion = this.listaStockFinal[index].idPresentacion;
			this.stockPenta = this.listaStockFinal[index].pentapeaks;
			this.stockFabrica = this.listaStockFinal[index].fabrica;
			this.stockOficina = this.listaStockFinal[index].oficina;
			this.stockVencido = this.listaStockFinal[index].vencido;
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
			this.listaStockFinal[ this.idEditar ].vencido = this.stockVencido;

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
			let presentAdela = $('#sltPresentacionAdela option[value="'+$('#sltPresentacionAdela').val()+'"]').text();
			this.listaAdelantos.push({cliente: this.adelaCliente, monto: this.adelaMonto, cantidad: this.adelaCantidad, bonificacion: this.adelaBonificacion,idPresentacion: this.adelaIdPresentacion, presentacion: presentAdela  });
			this.sumAdelanto+= parseFloat(this.adelaMonto);
		},
		adelantoEditar(index){
			this.adelaCliente = this.listaAdelantos[index].cliente;
			this.adelaMonto = this.listaAdelantos[index].monto
			this.adelaCantidad = this.listaAdelantos[index].cantidad;
			this.adelaPresentacion = this.listaAdelantos[index].presentacion;
			this.idPresentacion = this.listaAdelantos[index].idPresentacion;
			this.adelaBonificacion = this.listaAdelantos[index].bonificacion;
			this.idEditar = index;
		},
		adelaActualizar(){
			let presentAdela = $('#sltPresentacionAdela option[value="'+$('#sltPresentacionAdela').val()+'"]').text();
			this.sumAdelanto-=parseFloat(this.listaAdelantos[this.idEditar].monto);

			this.listaAdelantos[this.idEditar].cliente = this.adelaCliente;
			this.listaAdelantos[this.idEditar].monto = this.adelaMonto;
			this.listaAdelantos[this.idEditar].cantidad = this.adelaCantidad;
			this.listaAdelantos[this.idEditar].bonificacion = this.adelaBonificacion;
			this.listaAdelantos[this.idEditar].idPresentacion = this.idPresentacion;
			this.listaAdelantos[this.idEditar].presentacion = presentAdela;
			this.sumAdelanto+= parseFloat(this.adelaMonto);
		},
		adelantoBorrarFila(index){
			this.sumAdelanto-= parseFloat(this.listaAdelantos[index].monto);
			this.listaAdelantos.splice(index,1);
		},
		fechaFormateada(fecha){
			return moment(fecha).format('DD/MM/YYYY');
		},
		agregarBonificacion(){
			this.bonDescripcion = $('#sltPresentacionBonif option[value="'+$('#sltPresentacionBonif').val()+'"]').text();
			this.listaBonificaciones.push({ cantidad: this.bonCantidad, presentacion: this.bonDescripcion, idPresentacion: $('#sltPresentacionBonif').val(), observacion: this.bonObservacion, bonificacion: this.bonBonificacion, cliente: this.bonCliente, direccion: this.bonDireccion, esBono: this.bonQuees });
			this.bonifTotal+=parseFloat(this.bonBonificacion);
		},
		bonifEditar(index){
			this.bonIdPresentacion = this.listaBonificaciones[index].idPresentacion;
			this.bonDescripcion = this.listaBonificaciones[index].presentacion;
			this.bonCantidad = this.listaBonificaciones[index].cantidad;
			this.bonBonificacion= this.listaBonificaciones[index].bonificacion;
			this.bonCliente= this.listaBonificaciones[index].cliente;
			this.bonDireccion= this.listaBonificaciones[index].direccion;
			this.bonQuees= this.listaBonificaciones[index].esBono;
			this.idEditar = index;
		},
		bonifActualizar(){
			this.bonifTotal-=parseFloat(this.listaBonificaciones[this.idEditar].cantidad);

			this.listaBonificaciones[this.idEditar].idPresentacion= $('#sltPresentacionBonif').val()
			this.listaBonificaciones[this.idEditar].presentacion = this.bonDescripcion;
			this.listaBonificaciones[this.idEditar].cantidad = this.bonCantidad;

			this.listaBonificaciones[this.idEditar].bonificacion = this.bonBonificacion;
			this.listaBonificaciones[this.idEditar].cliente = this.bonCliente;
			this.listaBonificaciones[this.idEditar].direccion = this.bonDireccion;
			this.listaBonificaciones[this.idEditar].observacion = this.bonObservacion;
			this.listaBonificaciones[this.idEditar].esBono = this.bonQuees;
			this.bonifTotal+= parseFloat(this.bonBonificacion);
		},
		bonifBorrarFila(index){
			this.bonifTotal-= parseFloat(this.listaBonificaciones[index].bonificacion);
			this.listaBonificaciones.splice(index,1);
		},
		guardarFicha(){
			axios.post('{{route("liquidacion.insertar")}}', {
				fecha: this.fichFecha, vendedor: this.fichVendedor, placa: this.fichPlaca, lugar: this.fichLugar, conductor: this.fichConductor,
				sumaContado: this.ventcTotal, sumaCobranza: this.sumCobranza, sumaCredito: this.ventcTotal, sumaGasto: this.gasTotal, sumaAdelanto: this.sumAdelanto, sumaEntregar: this.sumaTotales, sumaEntregado: this.entregado,
				alContado: this.listaVentasContado, stockFinal: this.listaStockFinal, alCredito: this.listaVentasCredito, vCobranza: this.listaCobranza, adelantos: this.listaAdelantos, listaGastos: this.listaGastos, listaBonificacion: this.listaBonificaciones
			}).then(function(response){
				console.log(response.data);
				this.guardado=true;
				if(!isNaN(parseInt(response.data))){ //alert('Ficha guardada');
					alertify.alert('','<strong class="text-muted">Ficha guardada:</strong> <h3 class="text-secondary">' + moment( this.fichFecha ).format('YYMM') + "-" + response.data+"</h3>" ).set({transition:'fade', 'onok': function(){ window.location.href = "{{route('ventas.index')}}"+"/"+ app.fichFecha;}});
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
$('.esMoneda').change(function(){
	var campo = $(this);
	var valor =parseFloat(campo.val());
	if(valor<0){
		$(this).val('0.00')
	}else{
		$(this).val(parseFloat(valor).toFixed(2));
	}
});
$('#sltGrupoComprobantes').click(function() {
	if( $('#sltGrupoComprobantes').val()==1 ){
		app.gasComprobante ='';
	}
	app.gasidComprobante=$('#sltGrupoComprobantes').val();
});
$('#sltDestinos').click(function() {
	app.gasDestino=$('#sltDestinos').val();
});
var optionesLugar = {
	data:  JSON.parse({!! json_encode($lugares) !!}),
	getValue: "lugar",
	list: {
		match: { enabled: true,
			method:  function(element, phrase) { //Hace que coincida el término inicial en la búsqueda
				if(element.indexOf(phrase) === 0) { return true; } else { return false; }
			}
		}
	}
};
var optionesVendedor = {
	data:  JSON.parse({!! json_encode($vendedores) !!}),
	getValue: "vendedor",
	list: {
		match: { enabled: true }
	}
};
var optionesPlaca = {
	data:  JSON.parse({!! json_encode($placas) !!}),
	getValue: "placa",
	list: {
		match: { enabled: true }
	}
};

$("#provLugar").easyAutocomplete(optionesLugar);
$("#provVendedores").easyAutocomplete(optionesVendedor);
$("#provPlacas").easyAutocomplete(optionesPlaca);

</script>

@endsection
