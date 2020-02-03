@extends('plantillas.panel')

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
		<div class="col-md-5 card">
			<div class="card-body form-inline">
				<label for="">Fecha de reporte</label>
				<input type="date" name="fecha" id="" class="form-control mx-2" value="<?= date('Y-m-d')?>">
				<button class="btn btn-outline-primary"><i class="icofont-search-2"></i> Buscar</button>
				<a class="btn btn-outline-primary mx-2" href="{{route('liquidacion.nueva')}}"><i class="icofont-license"></i> Ingresar liquidación</a>
			</div>
		</div>
	</div>
</div>


@endsection