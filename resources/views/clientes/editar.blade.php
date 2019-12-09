@extends('plantillas.panel')


@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('clientes')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
  </ol>
</nav>
<h2><i class="icofont-users-alt-1"></i> Editar datos del cliente</h2>
@endsection

@section('cuerpo')

<div class="card col-6">
  <div class="card-body">
    <label for="">R.U.C.</label>
    <input class="form-control" type="text" name="" value="20602337147">
    <label for="">Razon social</label>
    <input class="form-control" type="text" name="" value="Infocat Soluciones SAC">
    <label for="">Dirección</label>
    <input class="form-control" type="text" name="" value="Av. Huancavelica 435 - El Tambo">
    <label for="">Celular</label>
    <input class="form-control" type="text" name="" value="977692108">
    <label for="">Contacto</label>
    <input class="form-control" type="text" name="" value="Carlos Pariona Valencia">
    <button class="btn btn-outline-warning mt-2 btn-block">Actualizar Cliente</button>
  </div>
</div>
@endsection