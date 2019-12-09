@extends('plantillas.panel')


@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('clientes')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Historial</li>
  </ol>
</nav>
<h2><i class="icofont-users-alt-1"></i> Editar datos del cliente</h2>
@endsection


@section('cuerpo')

<div class="card-deck">
  <div class="card ">
    <div class="card-body row-col-2">
      <h2 class='card-title'>Datos</h2>
      <div class="col"><label for="">R.U.C.</label></div>
      <div class="col"><p>20602337147</p></div>
      <div class="col"><label for="">Razon social</label></div>
      <div class="col"><p>Infocat Soluciones SAC</p></div>
      <div class="col"><label for="">Dirección</label></div>
      <div class="col"><p>Av. Huancavelica 435 - El Tambo</p></div>
      <div class="col"><label for="">Celular</label></div>
      <div class="col"><p>977692108</p></div>
      <div class="col"><label for="">Contacto</label></div>
      <div class="col"><p>Carlos Pariona Valencia</p></div>
    </div>
  </div>
  <div class=" card ">
    <div class="card-body">
      <h2 class='card-title'>Cambios</h2>
      <ul>
        <li><p>Rosmery: Crea el cliente el 14/12/2019</p></li>
        <li><p>Rosmery: Actualiza la razón social: <em>2060234751</em> el 22/12/2019</p></li>
        <li><p>Antonio: Actualiza la celular: <em>9655592502</em> el 25/12/2019</p></li>
        <li><p>Carlos: Actualiza el contacto: <em>Paolo Matias Salcedo</em> el 30/12/2019</p></li>
      </ul>
    </div>
  </div>
</div>
@endsection