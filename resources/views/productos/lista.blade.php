@extends('plantillas.panel')

@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
  </ol>
</nav>
<h2><i class="icofont-cart"></i> Productos</h2>
@endsection

@section('cuerpo')
@if ($errors->any())
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="alert-heading"><i class="icofont-eaten-fish"></i> Advertencias!</h4>
		<ul class="mb-2">
			@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<table class="table table-hover mt-3">
	<thead class="">
		<tr>
			<th>#</th>
			<th>Tipo</th>
			<th>Display</th>
			<th>Marca</th>
			<th>Nombre</th>
			<th>Contenido</th>
			<th>Peso Kg.</th>
			<th>Precio C/ Bonif.</th>
			<th>Precio por mayor</th>
			<th>Precio por menor</th>
		</tr>
	</thead>
	
	<tbody>
		@foreach ($productos as $producto)
		<form action="{{route('productos.precios.guardar', $producto->id)}}" method="post"> @csrf
		<tr>
			<td>{{$producto->id}}</td>
			<td>{{$producto->tipos->descripcion}}</td>
			<td>{{$producto->displays->descripcion}}</td>
			<td>{{$producto->marcas->descripcion}}</td>
			<td>{{$producto->descripcion}}</td>
			<td>
				@if ($producto->unidades_id==1)
					{{$producto->cantidad}} Und.
				@else
					@if($producto->cantidad==1 && $producto->cantidad_x_display==1)
					@else
						{{$producto->cantidad}} x {{$producto->cantidad_x_display}}
					@endif
				@endif
			</td>
			<td>
				@if ($producto->unidades_id==1)
				@else
					{{$producto->peso}} Kg.
				@endif
			</td>
			<td>
				<input type="number" class="form-control" name="precioBonificacion" value="{{$producto->precioBonificacion}}" previo="{{$producto->precioBonificacion}}">
			</td>
			<td><input type="number" class="form-control" name="precioMayor" value="{{$producto->precioMayor}}" previo="{{$producto->precioMayor}}"></td>
			<td><input type="number" class="form-control" name="precioMenor" value="{{$producto->precioMenor}}" previo="{{$producto->precioMenor}}"></td>
		</tr>
	</form>
		@endforeach
	</tbody>

</table>
@endsection

@section('script')
<script>
$('input').keypress(function(e){
	if (e.keyCode == 13){ $(this).parent().parent().prev().prev().submit(); }
});
@if(@session('actualizado'))
alertify.notify('<i class="icofont-check-circled"></i> Producto actualizado correctamente', 'success', 500 );
@endif
$("input").focus(function() {
   $(this).select();
});
</script>
		
@endsection