@extends('plantillas.panel')


@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('compras')}}">Compras</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
  </ol>
</nav>
<h2><i class="icofont-users-alt-1"></i> Nueva compra</h2>
@endsection

@section('cuerpo')

<div class="card-deck">
  <div class="card col-4">
    <div class="card-body">
      <h2 class='card-title'>Datos de la compra</h2>
        <label for="">RUC o Razón social</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">20312701031 - EL CRISTAL S.C.R.L.</option>
          <option value="2">20602337147 - BI GRAND CONFECCIONES S.A.C.</option>
          <option value="3">20364845567 - SANDRA & ABIGAIL GENERAL SERVICE S.A.C.	</option>
          <option value="3">10203508848 - SERVICIOS TECNICOS EL CHALANCITO EIRL</option>
        </select>
        <label for="">Categoría</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Compras generales</option>
          <option value="2">Insumos</option>
          <option value="3">Materiales</option>
          <option value="3">Combustible</option>
          <option value="4">Servicios</option>
          <option value="4">Gastos gerenciales</option>
          <option value="4">Caja chica</option>
        </select>
        <label for="">Moneda</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Soles</option>
          <option value="2">Dólares</option>
          <option value="3">Gratis</option>
        </select>
        <label for="">Comprobante</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Ticket</option>
          <option value="2">Recibo</option>
          <option value="3">Factura</option>
          <option value="3">Boleta de venta</option>
          <option value="3">Recibo por honorarios</option>
          <option value="3">Sin comprobante</option>
        </select>
        <label for="">Serie-Correlativo</label>
        <input class="form-control" type="text" name="">
        <label for="">¿A crédito?</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Si</option>
          <option value="2">No</option>
        </select>
        <label for="">¿Contiene IGV?</label>
        <select name="" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Si</option>
          <option value="2">No</option>
        </select>
        <label for="">Fecha de compra</label>
        <input class="form-control" type="date" name="" value="2019-12-09">
        <label for="">Importe final</label>
        <input class="form-control" type="number" name="" value="0.00">
      <button class="btn btn-outline-success mt-2 btn-block">Crear compra</button>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h2 class='card-title'>Detalle</h2>
      <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">Agregar detalle</button>
      <table class="table table-hover">
        <thead class="">
          <tr>
            <th>Cant</th>
            <th>Descripción</th>
            <th>P. Unit</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>19</td>
            <td>Costal Harina Blanca Flor</td>
            <td>S/ 5.80</td>
            <td>S/ 110.20</td>
          </tr>
          <tr>
            <td>100</td>
            <td>Kilos Mantequilla a granel</td>
            <td>S/ 6.50</td>
            <td>S/ 650.00</td>
          </tr>
          <tr>
            <td>60</td>
            <td>Bolsas impresas x 100 Unds.</td>
            <td>S/ 8.00</td>
            <td>S/ 480.00</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-right" colspan="3">P. Venta</th>
            <th>S/ 1051.02</th>
          </tr>
          <tr>
            <th class="text-right" colspan="3">I.G.V.</th>
            <th>S/ 189.18</th>
          </tr>
          <tr>
            <th class="text-right" colspan="3">Total</th>
            <th>S/ 1240.20</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Item </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="">Cantidad</label>
          <input class="form-control" type="number" name="" value="0.00">
          <label for="">Descripción</label>
          <input class="form-control" type="number" name="" value="">
          <label for="">Precio</label>
          <input class="form-control" type="number" name="" value="0.00">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Agregar Descripción</button>
        </div>
      </div>
    </div>
  </div>

@endsection