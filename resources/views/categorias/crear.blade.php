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
    <li class="breadcrumb-item " aria-current="page">Categorías</li>
    <li class="breadcrumb-item active" aria-current="page">Nueva</li>
  </ol>
</nav>

@endsection

@section('cuerpo')
<div class="card-deck">
	<div class="card " id="cardFormulario">
		<form action="{{route('tproceso.crear')}}" method="POST" enctype="multipart/form-data" >
		@csrf
		<div class="card-body">
			<h3><i class="icofont-envelope"></i> Crear categoría</h3>
			<label for="">Grupo principal</label>
			<select name="sltGrupo" id="" class="form-control">
				@foreach ($grupos as $grupo)
					<option value="{{$grupo->id}}">{{$grupo->grupo}}</option>
				@endforeach
			</select>
			<label for="">Nombre de nuevo reporte:</label>
			<input type="text" name="descripcion" id="" class="form-control">
			
			
			@if (session('mensaje'))
				<div class="alert alert-warning my-2"><i class="icofont-check-circled"></i> {{session('mensaje')}}</div>
			@endif
	
			<button class="btn btn-outline-success mx-auto my-3" type="submit"><i class="icofont-envelope"></i> Guardar categoría</button>
			
		</div>
	
	</form>
	</div>
	<div class="card ">
		<div class="card-body">
			<h3><i class="icofont-envelope"></i> Categorías guardadas</h3>
			@if (session('borrado'))
				<div class="alert alert-danger my-2"><i class="icofont-check-circled"></i> {{session('borrado')}}</div>
			@endif
			<table class="table table-hover">
				<thead>
					<tr>
						<th>N°</th>
						<th>Reporte</th>
						<th>Grupo</th>
						<th>@</th>
					</tr>
				</thead>
			
			<tbody>
				@foreach ($procesos as $proceso)
				<tr>
					<td>{{$loop->iteration}}.</td>
					<td>{{$proceso->descripcion}}</td>
					<td>{{$proceso->grupo}}</td>
					<form method="post" action="{{route('tproceso.eliminar', $proceso->id)}}"> @csrf
					<td> <button class="btn btn-outline-danger border-0 btn-sm"><i class="icofont-close"></i></button> </td>
					</form>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
		<div class="card-footer">
			Footer
		</div>
	</div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection