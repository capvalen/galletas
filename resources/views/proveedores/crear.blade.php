@extends('plantillas.panel')

@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('clientes')}}">Proveedores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear proveedor</li>
  </ol>
</nav>
<h2><i class="icofont-users-alt-1"></i> Crear proveedor</h2>
@endsection

@section('cuerpo')
<div class="card-deck">
  <div class="card col-12 col-md-6">
    <div class="card-body">
			<h2 class='card-title'>Datos del proveedor</h2>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul class="mb-2">
					@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if (session('mensaje'))
			<div class="alert alert-success">{{session('mensaje')}} </div>
			@endif
			<form action="{{route('proveedor.insertar')}}" method="post">
				@csrf
        <label for="">R.U.C.</label>
        <input type="text" name="ruc" id="txtruc" class='form-control' autocomplete="nope" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('ruc')}}">
        <label for="">Razón social</label>
        <input type="text" name="razonsocial" id="txtrazonsocial" class='form-control' autocomplete="nope" value="{{old('razonSocial')}}">
        <label for="">Dirección</label>
        <input type="text" name="direccion" id="txtdireccion" class='form-control' autocomplete="nope" value="{{old('direccion')}}">
        <label for="">Celular</label>
        <input type="text" name="celular" id="txtcelular" class='form-control' autocomplete="nope" value="{{old('celular')}}">
        <label for="">Contacto</label>
        <input type="text" name="contacto" id="txtcontacto" class='form-control' autocomplete="nope" value="{{old('contacto')}}">
				<button class="btn btn-outline-success mt-2 btn-block"><i class="icofont-save"></i> Crear proveedor</button>
			</form>
    </div>
  </div>
  
</div>

@endsection