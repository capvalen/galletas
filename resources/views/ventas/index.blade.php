@extends('plantillas.panel')
@php
use Carbon\Carbon;		
@endphp
@section('css')
<style>
	.text-warning{color: #9400e0!important;}
</style>		
@endsection

@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ventas</li>
  </ol>
</nav>
<h2><i class="icofont-cart"></i> Ventas</h2>
@endsection

@section('cuerpo')
<div class="container-fluid">
	<div class="row">
		<div class="col card w-100">
			<div class="card-body form-inline">
				<label for="">Fecha de reporte</label>
				<input type="date" name="fecha" id="dtpFechaLiquidaciones" class="form-control mx-2" value="<?= $fechaMaster;?>">
				<button class="btn btn-outline-primary"><i class="icofont-search-2"></i> Buscar</button>
				<a class="btn btn-outline-primary mx-2" href="{{route('liquidacion.nueva')}}"><i class="icofont-license"></i> Ingresar liquidación</a>
			</div>
		</div>
	</div>
	@if(count($liquidaciones)>0)
	<div class="row my-3">
		<div class="col card w-100">
			<div class="card-body table-responsive">
				
				<h5>Liquidaciones:</h5>
				<table class="table table-hover">
					<thead class="">
						<tr>
							<th>#</th>
							<th>Cod.</th>
							<th>Vendedor</th>
							<th>Fecha</th>
							<th>Contado</th>
							<th>Cobranza</th>
							<th>Crédito</th>
							<th>Gastos</th>
							<th>Adelantos</th>
							<th>Sistema</th>
							<th>Resumen</th>
							<th>Usuario</th>
							<th>Creado</th>
							<th>@</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($liquidaciones as $liquidacion)
						@php
							$fechita = new Carbon($liquidacion->fecha); $creado = new Carbon($liquidacion->created_at);
							$usuarios=App\Liquidacion::find($liquidacion->id)->usuarios;
						@endphp
						<tr>
							<th>{{$loop->index+1}}</th>
							<td><strong><a href="{{route('liquidacion.reporte', $liquidacion->id)}}">{{substr(str_replace('-', '', $fechita->format('y-m-d') ),0, 4)."-". str_pad ($liquidacion->codInterno, 2, "0", STR_PAD_LEFT)}}</a></strong></td>
							<td class="text-capitalize">{{$liquidacion->vendedor}}</td>
							<td>{{$fechita->format('d/m/Y')}}</td>
							<td>{{number_format($liquidacion->sumaContado,2)}}</td>
							<td>{{number_format($liquidacion->sumaCobranza,2)}}</td>
							<td>{{number_format($liquidacion->sumaCredito,2)}}</td>
							@if( $liquidacion->sumaGasto >=0 )
								<td class="text-danger">{{number_format(abs($liquidacion->sumaGasto),2)}}</td>
							@else
								<td class="text-primary">{{number_format(abs($liquidacion->sumaGasto),2)}}</td>
							@endif
							<td>{{number_format($liquidacion->sumaAdelanto,2)}}</td>
							<td>S/ {{number_format(abs($liquidacion->sumaEntregar),2)}}</td>
							@if($liquidacion->sumaEntregar<>$liquidacion->sumaEntregado)
								@if($liquidacion->sumaEntregar>$liquidacion->sumaEntregado)
								<td class="text-danger">Falta {{number_format( $liquidacion->sumaEntregar - $liquidacion->sumaEntregado ,2)}}</td>
								@else
								<td class="text-primary">Sobra {{number_format( $liquidacion->sumaEntregado - $liquidacion->sumaEntregar ,2)}}</td>
								@endif
							@else
								<td class="text-warning">Exacto</td>
							@endif
							
							<td>{{$usuarios[0]->name}}</td>
							<td>{{$creado->format('d/m/Y H:m a')}}</td>
							<td>
								<form action="{{route('liquidacion.borrar', $liquidacion->id )}}" method="post"> @csrf
									<button class="btn btn-outline-danger border-0 btn-sm"><i class="icofont-close"></i></button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@else
	<p class="mt-5">No se encontró datos en la fecha {{$fechaMaster}}</p>
	@endif
</div>


@endsection
@section('script')
<script>
	$('#dtpFechaLiquidaciones').change(function() {
		window.location.href = "{{route('ventas.index')}}"+"/"+$('#dtpFechaLiquidaciones').val();
	});
</script>
@endsection