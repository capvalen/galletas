@extends('plantillas.panel')


@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('clientes')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
  </ol>
</nav>
<h2><i class="icofont-users-alt-1"></i> Cliente nuevo</h2>
@endsection

@section('cuerpo')

<div class="card col-6">
  <div class="card-body">
    <label for="">R.U.C.</label>
    <input class="form-control" type="text" name="">
    <label for="">Razon social</label>
    <input class="form-control" type="text" name="">
    <label for="">Dirección</label>
    <input class="form-control" type="text" name="">
    <label for="">Celular</label>
    <input class="form-control" type="text" name="">
    <label for="">Contacto</label>
    <input class="form-control" type="text" name="">
    <button class="btn btn-outline-success mt-2 btn-block">Crear Cliente</button>
  </div>
</div>
@endsection