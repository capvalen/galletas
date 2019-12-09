@extends('plantillas.panel')

@section('titulo')
<h2><i class="icofont-users-alt-1"></i> Clientes</h2>
@endsection

@section('cuerpo')
<div class="card">
  
  <div class="card-body col-6">
    <p class="card-text mb-0"><small class="text-muted"><i class="icofont-filter"></i> Acciones</small></p>
    <div class="form-row">
      <div class="col">
        <label for="">Buscar:</label>
        <input id="my-input" class="form-control inputIcon" type="text" name="" placeholder="&#xed11; Buscar Cliente">
      </div>
      <div class="col">
        <label for="">RUC o Razón social</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">20602337147 - Infocat Soluciones SAC</option>
          <option value="2">20526744720 - BI GRAND CONFECCIONES S.A.C.</option>
          <option value="3">20364845567 - SANDRA & ABIGAIL GENERAL SERVICE S.A.C.	</option>
          <option value="3">10203508848 - SERVICIOS TECNICOS EL CHALANCITO EIRL</option>
        </select>
      </div>
        
      <div class="col d-flex align-items-end">
        <a href="{{route('clientes.nuevo')}}" class="btn btn-outline-primary" role='button'>Cliente nuevo</a>
      </div>
    </div>
  </div>
</div>

  <table class="table table-hover mt-3">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>RUC</th>
        <th>Razón social</th>
        <th>Dirección</th>
        <th>Celular</th>
        <th>@</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>20602337147</td>
        <td><a href="{{route('clientes.historial')}}">Infocat Soluciones SAC</a></td>
        <td>Av. Huancavelica 435 El Tambo</td>
        <td>96477362108</td>
        <td><a role="button" href="{{route('clientes.editar')}}" class="btn btn-outline-primary"><i class="icofont-edit"></i></button></td>
      </tr>
      <tr>
        <td>2</td>
        <td>20602337147</td>
        <td><a href="{{route('clientes.historial')}}">BI GRAND CONFECCIONES S.A.C</a></td>
        <td>Jr. La ribera 559 - Las retamas</td>
        <td>064-256358</td>
        <td><a role="button" href="{{route('clientes.editar')}}" class="btn btn-outline-primary"><i class="icofont-edit"></i></button></td>
      </tr>
    </tbody>
  </table>


@endsection