@extends('plantillas.panel')

@section('titulo')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
		<li class="breadcrumb-item active" aria-current="page">Caja</li>
		
	</ol>
</nav>
<h2><i class="icofont-cart-alt"></i> Caja</h2>
@endsection

@section('css')
<style>
	.card-header{
		background-color: rgb(62, 64, 149);
		color: white;
	}
</style>
@endsection

@section('cuerpo')
<div class="col-md-6">
	<div class="card ">
		<div class="card-header">
			Filtros
		</div>
		<div class="card-body">
			<div class="row row-cols-1 row-cols-md-2">
				<div class="col">
					<label for="">Fecha de sessión</label>
					<input type="date" name="fechaCaja" id="fechaCaja" class="form-control" value="<?= date('Y-m-d')?>"></div>
				<div class="col">
					<label for="">Historial de sesiones</label>
					<select name="usuariosCuadres" id="usuariosCuadres" class="form-control">
						<option value="1">Carlos Pariona</option>
						<option value="2">Ronald Quispe</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-12 mt-3">
	<div class="card">
		<div class="card-header">
			Detalles de cuadre de caja
		</div>
	</div>
</div>

<div class="col-12 mt-3" id="divCuadreCol">
	<div class="row ">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header d-inline-flex">
					<div class="dropdown">
						<a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icofont-plus-circle"></i> Ingreso de dinero</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<h6 class="dropdown-header">Procesos de entrada</h6>
							<a class="dropdown-item" href="#">Inyección</a>
							<a class="dropdown-item" href="#">Otros</a>
						</div>
					</div> 
				</div>
				<div class="card-body table-responsive">
					<table class="table-hover table">
						<thead>
							<tr>
								<th>N°</th>
								<th>Movimiento</th>
								<th>Cantidad</th>
								<th>Responsable</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td><p>Venta de productos</p>
									<p><small>Adelanto del Sr. Perez Mercado</small></p>
								</td>
								<td>S/ 250.00</td>
								<td>Carlos Pariona</td>
								<td data-toggle="tooltip" data-placement="top" title="Depósito bancario"><i class="icofont-bank-alt"></i></td>
							</tr>
							<tr>
								<td>2</td>
								<td><p>Inyección de dinero</p>
									<p><small>Por encargo de la administración para hacer compras por internet</small></p>
								</td>
								<td>S/ 550.00</td>
								<td>Carlos Pariona</td>
								<td data-toggle="tooltip" data-placement="top" title="Efectivo"><i class="icofont-database"></i></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="2">Total</th>
								<th>S/ 800.00</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header d-inline-flex">
					<div class="dropdown">
						<a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icofont-plus-circle"></i> Salidas de dinero</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<h6 class="dropdown-header">Procesos de salida</h6>
							<a class="dropdown-item" href="#">Adelanto de personal</a>
							<a class="dropdown-item" href="#">Gastos</a>
							<a class="dropdown-item" href="#">Pago de proveedores</a>
							<a class="dropdown-item" href="#">Pago de servicios</a>
							<a class="dropdown-item" href="#">Otros</a>
							<a class="dropdown-item" href="#">Retiro de socios</a>
						</div>
					</div> 
				</div>
				<div class="card-body table-responsive">
					<table class="table-hover table">
						<thead>
							<tr>
								<th>N°</th>
								<th>Movimiento</th>
								<th>Cantidad</th>
								<th>Responsable</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td><p>Compra de utencilios de aseo</p>
									<p><small>Lejía, trapos, escobas</small></p>
								</td>
								<td>S/ 60.00</td>
								<td>Carlos Pariona</td>
								<td data-toggle="tooltip" data-placement="top" title="Efectivo"><i class="icofont-database"></i></td>
							</tr>
							<tr>
								<td>2</td>
								<td><p>Adelanto a personal</p>
									<p><small>Para: Leonor Yarasca</small></p>
								</td>
								<td>S/ 120.00</td>
								<td>Carlos Pariona</td>
								<td data-toggle="tooltip" data-placement="top" title="Efectivo"><i class="icofont-database"></i></td>
							</tr>
							<tr>
								<td>2</td>
								<td><p>Pago a proveedores</p>
									<p><small>Para: Gloria Company S.A.C.</small></p>
									<p><small>Factura N° FB061-252030</small></p>
								</td>
								<td>S/ 470.00</td>
								<td>Carlos Pariona</td>
								<td data-toggle="tooltip" data-placement="top" title="Depósito bancario"><i class="icofont-bank-alt"></i></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="2">Total</th>
								<th>S/ 650.00</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

	</div>
	
</div>
<div id="modalEntradasDinero" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Entrada de dinero</h5>
				<label for="">Método:</label>
				<p><strong>Inyección</strong></p>
				<label for="">Monto:</label>
				<input type="number" name="" id="txtDinero" class="form-control text-center esMoneda" value="0.00">
				<label for="">Tipo de moneda:</label>
				<select name="" id="sltMonedaIngreso" class="form-control">
					<option value="1">Moneda</option>
					<option value="2">Depósito bancario</option>
					<option value="3">Tarjeta VISA</option>
					<option value="4">Tarjeta Mastercard</option>
					<option value="5">Gratis</option>
				</select>
				<label for="">Descripción:</label>
				<input type="text" name="" id="txtObs" class="form-control text-capitalize">
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-primary"><i class="icofont-save"></i> Guardar</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
$('.dropdown-item').click(function(){
	$('#modalEntradasDinero').modal('show');
});
</script>
@endsection