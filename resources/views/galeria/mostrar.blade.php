@extends('plantillas.panel')
namespace App;

@section('css')
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Buscar";
}
#cardFormulario label{
margin-top: 10px;
}
.card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
		object-position: top;
}

</style>
@endsection

@section('titulo')
<nav aria-label="breadcrumb" class="d-print-none">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Galerías</li>
  </ol>
</nav>
<h2 class="d-print-none"><i class="icofont-camera"></i> Galerías</h2>
@endsection

@section('cuerpo')
<div class="card col-md-6 d-print-none">
	
	<div class="card-body">
		<h5 class="card-title">Filtros</h5>
		<div class="row ">
			<div class="col col-md-6">
				<label class="d-block" for="">Fecha</label>
				<input type="date" name="fecha" class="form-control d-inline-block col-9" id="txtFecha" value="{{$fecha}}">
				<button class="btn btn-outline-primary" id="btnBuscar"><i class="icofont-search-1"></i> </button>
			</div>
			<div class="col col-md-6 d-flex align-items-end">
				<a class="btn btn-outline-primary" type="button" href="{{route('galeria.subida')}}"><i class="icofont-folder-open"></i> Subir nuevo reporte</a>
			</div>
		</div>
		
	</div>

</div>

@isset($contador)
@if(count($contador)>0)
<div class="card mt-2 col-md-6 d-print-none">
	<div class="card-body">
		<p>Resumen:</p>
		<ul class="list-group">
			@foreach ($contador as $conta )
			<li class="list-group-item  d-flex justify-content-between align-items-center"><a href="{{route('galeria.mostrar.grupo', [$fecha, $conta->grupo_id] )}}"> {{$conta->grupo}}</a> <span class="badge badge-primary badge-pill">{{$conta->cantidad}}</span> </li>
			@endforeach
		</ul>
	</div>
	
</div>
@else
<p class="mt-4">No se encontraron archivos en: <strong>{{\Carbon\Carbon::parse($fecha)->format('d/m/Y')}}</strong></p>
@endif
@endisset

@isset($categorias)
<div class=" mt-3" id="divPadreCards d-print-none">
	<div class="row row-cols-5">
		@foreach ($categorias as $categoria )
		<div class="col">
			<div class="card">
				<img src="@if( substr($categoria->foto, -4) =='.pdf') {{url('subidas/iconopdf.png')}} @else  {{url('subidas/' . $categoria->foto )}}  @endif" class="card-img-top" alt="..."data-archivo="{{$categoria->foto}}">
				<div class="card-body">
					<small class="text-muted">Creado el {{\Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y h:m a')}}</small>
					<h5 class="card-title">{{$categoria->descripcion}}</h5>
					<p class="card-text">{{$categoria->observacion}}</p>
					<a href="{{url('subidas/' . $categoria->foto )}}" class="btn btn-outline-success" download><i class="icofont-download"></i> Descargar</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

<div id="modalPreview" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="my-modal-title">Vista previa</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="relleno">

				</div>
			</div>
		</div>
	</div>
</div>
@endisset


<?php $dominio =  preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);?>

@endsection

@section('script')
<script>

$('#txtFecha').keypress(function (e) { 
	if(e.keyCode == 13){ 
		$('#btnBuscar').click();
	}
});
$('#btnBuscar').click(function() {
	if( $('#txtFecha').val()!='' ){
		window.location = "/galeria/mostrar/" + $('#txtFecha').val();
	}
});

$('.card-img-top').click(function() {
	$('#relleno').html('');
	var archivo = $(this).attr('data-archivo');
	var tipo = archivo.substr(-4).toLowerCase();
	if(tipo == '.pdf'){
		$('.modal-body').css('height', '90vh');
		$('#relleno').html( `<embed src="//<?= $dominio; ?>/subidas/${archivo}" width="100%" height="100%" type="application/pdf">` )
	}else{
		$('.modal-body').css('height', '');
		$('#relleno').html(`<center><img class="img-fluid mx-auto" src="//<?= $dominio; ?>/subidas/${archivo}"></center>`);
	}
	
	$('#modalPreview').modal('show');
});
</script>
@endsection