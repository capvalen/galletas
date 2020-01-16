@extends('plantillas.panel')

@section('css')
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Buscar";
}
#cardFormulario label{
margin-top: 10px;
}
</style>
@endsection

@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{route('galeria.mostrar')}}">Galerías</a></li>
    <li class="breadcrumb-item active" aria-current="page">Subida foto</li>
  </ol>
</nav>
<h2><i class="icofont-camera"></i> Subir a una galería</h2>
@endsection

@section('cuerpo')
<form action="{{route('galeria.subir')}}" method="POST" enctype="multipart/form-data" >
@csrf
<div class="card col-md-6" id="cardFormulario">

	<div class="card-body">
		<label for="">Grupo</label>
		<select name="grupo" id="" class="form-control">
			@foreach ( $grupos as $grupo )
				<option value="{{$grupo->id}}">{{$grupo->grupo}}</option>
			@endforeach
		</select>
		<label for="">Tipo de Reporte</label>
		<select name="tipo" id="" class="form-control">
			@foreach ( $tipos as $tipo )
				<option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
			@endforeach
		</select>
		<label class="mb-0" for="">Archivo</label>
		<div class="input-group mb-2">
			<div class="custom-file">
				<input type="file" class="custom-file-input m-0" name="archivo" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="image/*, .pdf">
				<label class="custom-file-label" for="inputGroupFile04">Seleccione el archivo</label>
			</div>
		</div>
		<label for="">Observaciones:</label>
		<input type="text" name="observacion" class="form-control" id="">
		@if (session('mensaje'))
			<div class="alert alert-warning my-2"><i class="icofont-check-circled"></i> {{session('mensaje')}}</div>
		@endif

		<button class="btn btn-outline-success btn-block my-3" type="submit"><i class="icofont-upload-alt"></i> Subir archivo</button>
	</div>

</div>
</form>
@endsection

@section('script')
<script>
$('#inputGroupFile04').on('change',function(e){
	//get the file name
	var fileName = $(this).val();
	//replace the "Choose a file" label
	//$(this).next('.custom-file-label').html(fileName);
	$(this).next('.custom-file-label').html(e.target.files[0].name);
})
</script>
@endsection