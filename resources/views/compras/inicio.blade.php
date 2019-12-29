@extends('plantillas.panel')

@section('titulo')
<h2><i class="icofont-cart-alt"></i> Compras</h2>
@endsection

@section('cuerpo')
<div class="card">
  
  <div class="card-body ">
    <p class="card-text mb-0"><small class="text-muted"><i class="icofont-filter"></i> Acciones</small></p>
    <div class="form-row">
      <div class="col">
        <label for="">Buscar:</label>
        <input id="my-input" class="form-control inputIcon" type="text" name="" placeholder="&#xed11; Buscar Proveedor">
      </div>
      <div class="col">
        <label for="">RUC o Razón social</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          @foreach ($proveedores as $proveedor )
          <option value="{{$proveedor->id}}"> {{$proveedor->ruc}} - {{$proveedor->razonSocial}}</option>
          @endforeach
         
        </select>
      </div>
        
      <div class="col d-flex align-items-end">
        <a href="{{route('compras.nuevo')}}" class="btn btn-outline-primary" role='button'><i class="icofont-ticket"></i> Nueva compra </a>
        <a href="{{route('proveedores.crear')}}" class="btn btn-outline-primary mx-2" role='button'><i class="icofont-ticket"></i> Nuevo proveedor</a>
      </div>
    </div>
  </div>
</div>

  <table class="table table-hover mt-3">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Serie</th>
        <th>RUC</th>
        <th>Razón social</th>
        <th>Tipo</th>
        <th>Categoría</th>
        <th>Importe</th>
        <th>@</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>04/12/2019</td>
        <td><a href="{{route('compras.historial')}}">F002-05251</a></td>
        <td>20312701031</td>
        <td><a href="{{route('clientes.historial')}}">EL CRISTAL S.C.R.L.</a></td>
        <td>Factura</td>
        <td>Insumos</td>
        <td>S/ 5614.60</td>
        <td><a role="button" href="{{route('compras.editar')}}" class="btn btn-outline-primary"><i class="icofont-edit"></i></button></td>
      </tr>
      <tr>
        <td>2</td>
        <td>01/12/2019</td>
        <td><a href="{{route('compras.historial')}}">FB014-00250</a></td>
        <td>20602337147</td>
        <td><a href="{{route('clientes.historial')}}">BI GRAND CONFECCIONES S.A.C</a></td>
        <td>Factura</td>
        <td>Repuestos</td>
        <td>$ 36.02</td>
        <td><a role="button" href="{{route('clientes.editar')}}" class="btn btn-outline-primary"><i class="icofont-edit"></i></button></td>
      </tr>
      <tr>
        <td>3</td>
        <td>01/11/2019</td>
        <td><a href="{{route('compras.historial')}}">BE 005-000035</a></td>
        <td>20101128777</td>
        <td><a href="{{route('clientes.historial')}}">DHL EXPRESS PERU S.A.C.</a></td>
        <td>Boleta</td>
        <td>Servicios</td>
        <td>S/ 348.00</td>
        <td><a role="button" href="{{route('clientes.editar')}}" class="btn btn-outline-primary"><i class="icofont-edit"></i></button></td>
      </tr>
    </tbody>
  </table>


@endsection