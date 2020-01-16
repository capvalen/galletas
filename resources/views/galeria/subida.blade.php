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
		<label for="">Fecha</label>
		<input type="date" name="dia" class="form-control" id="" value="<?= date('Y-m-d');?>">
		<label for="">Grupo</label>
		<select name="grupo" class="form-control" id="sltGrupo">
			@foreach ( $grupos as $grupo )
				<option value="{{$grupo->id}}">{{$grupo->grupo}}</option>
			@endforeach
		</select>
		<label for="">Tipo de Reporte</label>
		<select name="tipo" class="form-control" id="sltTipos">
		
		</select>
		<label class="mb-0" for="">Archivo</label>
		<div class="input-group mb-2">
			<div class="custom-file">
				<input type="file" class="custom-file-input m-0" name="archivo" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="image/*, .pdf, .doc, .docx, .xls, .xlsx">
				<label class="custom-file-label" for="inputGroupFile04">Seleccione el archivo</label>
			</div>
		</div>
		<label for="">Observaciones:</label>
		<input type="text" name="observacion" class="form-control" id="">
		@if (session('mensaje'))
			<div class="alert alert-warning my-2"><i class="icofont-check-circled"></i> {{session('mensaje')}} puede verlo haciendo <a class="text-decoration-none" href="{{route('galeria.mostrar', session('fechaGuardada'))}}">click acá</a></div>
		@endif

		<button class="btn btn-outline-success btn-block my-3" type="submit"><i class="icofont-upload-alt"></i> Subir archivo</button>
		
	</div>

</div>
</form>
@endsection

@section('script')
<script>
	var grupos = JSON.parse('@php echo json_encode($tipos) @endphp');
	rellenarSelect(1);
$('#inputGroupFile04').on('change',function(e){
	//get the file name
	var fileName = $(this).val();
	//replace the "Choose a file" label
	//$(this).next('.custom-file-label').html(fileName);
	$(this).next('.custom-file-label').html(e.target.files[0].name);
});
$('#sltGrupo').change(function() {
	//console.log($('#sltGrupo').val())
	rellenarSelect($('#sltGrupo').val())
});

function rellenarSelect(id){
	$('#sltTipos').html('');
	for(let i=0; i<grupos.length; i++){
		if( grupos[i].grupo_id == id ){
			$('#sltTipos').append(`
			<option value="${grupos[i].grupo_id}">${grupos[i].descripcion}</option>
			`)
		}
	}
}
</script>
@endsection