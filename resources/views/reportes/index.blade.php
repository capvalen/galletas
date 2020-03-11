@extends('plantillas.panel')
@php
	use Carbon\Carbon;
	$desdee = Carbon::createFromFormat('Y-m-d', $desde);
	$hastaa = Carbon::createFromFormat('Y-m-d', $hasta);
@endphp
@section('css')
<style>
	.input-daterange .input-group-addon{
		padding: 4px 19px!important;
		background-color: #e2e2e2;
    border: 1px solid #ced4da;
	}
	.text-morado{color: #9400e0!important;}
</style>
@endsection


@section('titulo')
<link rel="stylesheet" href="{{url('css/bootstrap-datepicker3.css')}}">

	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{route('reportes.index')}}">Reportes</a></li>
	  </ol>
	</nav>
	<h2><i class="icofont-paper"></i> Reportes </h2>
@endsection

@section('cuerpo')
<form method="post" action="{{route('reportes.busqueda')}}">
@csrf
<section class="container-fluid">
	<div class="row">
		<div class="col card w-100">
			<div class="card-body row">
				<div class="col">
					<label for="">Tipo de reporte </label>
					<select name="tipoReporte" id="sltTipoReporte" class="form-control ml-2" >
						<option value="R0">Tipo de reportes</option>
						<option value="R1">Ventas por kilos</option>
						<option value="R4">Cuadres de caja</option>
						<option value="R2">Gastos y devoluciones</option>
						<option value="R3">Ventas mayoristas</option>
					</select>
				</div>
				<div class="col d-none">
					<label for="">Zonas</label>
					<select name="lugares" id="sltLugares" class="form-control ml-2">
						<option value="0">Todos</option>
						@foreach ($lugares as $lugar)
						<option class="text-capitalize" value="{{$lugar->lugar}}">{{$lugar->lugar}}</option>
						@endforeach
					</select>
				</div>
				<div class="col d-none" id="divVendedores">
					<label for="">Vendedores</label>
					<select name="vendedor" id="sltVendedor" class="form-control ml-2">
						<option value="0">Todos</option>
						@foreach ($sellers as $vendedor)
						<option class="text-capitalize" value="{{$vendedor->vendedor}}">{{$vendedor->vendedor}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label for="">Rango de fechas</label>
					<div class="input-daterange input-group px-2" id="datepicker">
						<input type="text" class="input-sm form-control" id="primeraFecha" name="start" />
						<span class="input-group-addon">hasta</span>
						<input type="text" class="input-sm form-control" id="segundaFecha" name="end" />
					</div>
				</div>
				<div class="col d-flex align-items-end">
					<button class="btn btn-outline-primary"><i class="icofont-search-2"></i> Buscar reporte</button>
				</div>
			</div>
		</div>
	</div>
</section>
</form>
<section class="container-fluid mt-3">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				@if (session('mensaje'))
				<div class="alert alert-warning"><strong>Notificación:</strong> {{session('mensaje')}} </div>
				@endif
				<div class="row pb-2 d-none">
					<div class="col">
						<div class="btn-group">
							<button type="button" class="btn btn-secondary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="icofont-filter"></i> Filtros
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Separated link</a>
							</div>
						</div>
					</div>
				</div>

				


				<div id="app">
					<p>Resultados</p>
					@isset($gastos)
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th>N°</th>
								<th>Empresa</th>
								<th>Fecha</th>
								<th>Tipo</th>
								<th>Descripción</th>
								<th>Monto</th>
								<th>Cod. Liq.</th>
								<th>Lugar.</th>
								<th>Vendedor</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($gastos as $gasto)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$gasto->destino}}</td>
								<td>{{Carbon::parse($gasto->created_at)->format('d/m/Y')}}</td>
								<td class="{{$gasto->tipo==1 ? 'text-danger' : 'text-primary'}}">@if($gasto->tipo==1) {{'Gasto'}} @else {{'Devolución'}} @endif </td>
								<td class="text-capitalize">{{$gasto->descripcion}}</td>
								<td>{{$gasto->monto}}</td>
								<td class="{{$gasto->tipo==1 ? 'text-danger' : 'text-primary'}}">{{Carbon::parse($gasto->vendedores->fecha)->isoFormat('YYMM-')}}{{$gasto->vendedores->codInterno}}</td>
								<td class="text-capitalize">{{$gasto->vendedores->lugar}}</td>
								<td class="text-capitalize">{{$gasto->vendedores->vendedor}}</td>
			
							
			
								<td></td>
							</tr>
							@endforeach
							@endisset
							@isset($liquidaciones)
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th>N°</th>
										<th>Fecha</th>
										<th>Liq. Por Sistema</th>
										<th>Monto entregado</th>
										<th>Resumen</th>
										<th>Cod. Liq.</th>
										<th>Lugar.</th>
										<th>Vendedor</th>
									</tr>
								</thead>
							<tbody>
							@foreach ($liquidaciones as $liquidacion)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{Carbon::parse($liquidacion->fecha)->format('d/m/Y')}}</td>
								<td>{{number_format(abs($liquidacion->sumaEntregar),2)}}</td>
								<td>{{number_format($liquidacion->sumaEntregado,2)}}</td>
								<td>@if($liquidacion->sumaEntregado == $liquidacion->sumaEntregar ) <span class="text-morado">Cuadre exacto</span>
									@elseif($liquidacion->sumaEntregar<0) <span class="text-warning">{{'Exceso de gasto S/ '. number_format(abs($liquidacion->sumaEntregar)- $liquidacion->sumaEntregado,2) }}</span>
									@elseif($liquidacion->sumaEntregar> $liquidacion->sumaEntregado) <span class="text-danger">{{'Falta entregar S/ '. number_format($liquidacion->sumaEntregar - $liquidacion->sumaEntregado,2) }}</span>
									@elseif($liquidacion->sumaEntregar< $liquidacion->sumaEntregado) <span class="text-success">{{'Por demás S/ '. number_format($liquidacion->sumaEntregado - $liquidacion->sumaEntregar ,2) }}</span>
									@endif
								</td>
								<td class="text-primary">{{Carbon::parse($liquidacion->fecha)->isoFormat('YYMM-')}}{{$liquidacion->codInterno}}</td>
								<td class="text-capitalize">{{$liquidacion->lugar}}</td>
								<td class="text-capitalize">{{$liquidacion->vendedor}}</td>
			
								<td></td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
					@endisset
				</div>

			</div>
		</div>
	</div>
	
</section>
@endsection

@section('script')
<script src="{{url('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('js/bootstrap-datepicker.es.min.js')}}"></script>
<script>
var app = new Vue({
  el: '#app',
  data: {
    
  }
})

$('.input-daterange').datepicker({
	format: "dd/mm/yyyy",
	weekStart: 1,
	todayBtn: "linked",
	language: "es",
	autoclose: true,
	todayHighlight: true
});
@isset($tipo)
$('#sltTipoReporte').val('{{$tipo}}').change();
@endisset
$('#primeraFecha').datepicker('update', '{{$desdee->isoFormat('DD/MM/YYYY')}}');
$('#segundaFecha').datepicker('update', '{{$hastaa->isoFormat('DD/MM/YYYY')}}');

$('#sltTipoReporte').change(function() {
	switch( $('#sltTipoReporte').val()){
		case "R4": $('#divVendedores').removeClass('d-none'); break;
		default:
		$('#divVendedores').addClass('d-none');
		break;
	}
});


</script>	
@endsection