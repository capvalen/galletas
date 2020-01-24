@extends('plantillas.panel')

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
.btn:focus, .close {
  outline: none!important;
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
				<a class="btn btn-outline-primary ml-2" type="button" href="{{route('tproceso.nuevo')}}"><i class="icofont-drag2"></i> Nuevo categoría</a>
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
<h5 class=" mt-3">Galería de archivos</h5>
<div id="divPadreCards d-print-none">
	<div class="row row-cols-5">
		@foreach ($categorias as $categoria )
		<div class="col">
			<div class="card">
					<button class="text-right close pr-2" onclick="botonEliminar({{$categoria->id}})" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				@php
				$extension = substr($categoria->foto, -4);
				@endphp
				<img src="@if( $extension =='.pdf'){{url('subidas/iconopdf.png')}}@elseif( $extension =='.doc' or $extension =='docx' ){{url('subidas/iconoword.png')}}@elseif( $extension =='.xls' or $extension =='xlsx' ){{url('subidas/iconoexcel.png')}}@else{{url('subidas/' . $categoria->foto )}}@endif" class="card-img-top" alt="..."data-archivo="{{$categoria->foto}}">
				<div class="card-body">
					<small class="text-muted">Creado el {{\Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y h:m a')}}</small>
					<h5 class="card-title">{{$categoria->descripcion}}</h5>
					<p class="card-text">{{$categoria->observacion}}</p>
					<a href="{{route('galeria.editar', $categoria->id )}}" class="btn btn-outline-primary" ><i class="icofont-edit"></i> Editar</a>
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
<div id="modalBorrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="my-modal-title">Eliminar</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Está seguro que desea borrar el item?</p>
				<form action="{{route('galeria.borrar')}}" method="post">
					@csrf
					<input type="number" class="d-none" name="idBorrar" id="txtIdBorrar">
					<div class="d-flex align-items-end flex-column">
						<button type="submit" class="btn btn-outline-danger" id="btnConfirmarBorrado"><i class="icofont-trash"></i> Sí, borrar</button>
					</div>
				</form>
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

function botonEliminar(id){
	//$.idEliminar = id;
	$('#txtIdBorrar').val(id);
	$('#modalBorrar').modal('show');
}
@if(session('borrado'))
alertify.error('<i class="icofont-magic"></i> {{session('borrado')}}');
@endif
@if(session('actualizado'))
alertify.success('<i class="icofont-magic"></i> {{session('actualizado')}}');
@endif
</script>
@endsection