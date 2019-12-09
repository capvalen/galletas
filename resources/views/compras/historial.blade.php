@extends('plantillas.panel')


@section('titulo')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('clientes')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Historial</li>
  </ol>
</nav>
<h2><i class="icofont-users-alt-1"></i> Historial de compra</h2>
@endsection


@section('cuerpo')

<div class="card-deck">
  <div class="card ">
    <div class="card-body row-col-2">
      <h2 class='card-title'>Datos de la compra</h2>
      <div class="col"><label for="">R.U.C.</label></div>
      <div class="col"><p>20602337147</p></div>
      <div class="col"><label for="">Razon social</label></div>
      <div class="col"><p>Infocat Soluciones SAC</p></div>
      <div class="col"><label for="">Dirección</label></div>
      <div class="col"><p>Av. Huancavelica 435 - El Tambo</p></div>
      <hr>
      <div class="container-fluid row row-cols-2">
        <div class="col"><label for="">Fecha de Compra</label></div>
        <div class="col"><p>08/12/2019</p></div>
        <div class="col"><label for="">Categoría</label></div>
        <div class="col"><p>Materiales</p></div>
        <div class="col"><label for="">Moneda</label></div>
        <div class="col"><p>Soles</p></div>
        <div class="col"><label for="">Comprobante</label></div>
        <div class="col"><p>Factura</p></div>
        <div class="col"><label for="">Serie y correlativo</label></div>
        <div class="col"><p>FB15-0002147</p></div>
        <div class="col"><label for="">A crédito</label></div>
        <div class="col"><p>No</p></div>
        <div class="col"><label for="">Inc. IGV</label></div>
        <div class="col"><p>Si</p></div>
        <div class="col"><label for="">Importe</label></div>
        <div class="col"><p>S/ 1290.20</p></div>
        <div class="col"><label for="">Observación</label></div>
        <div class="col"><p class="text-danger">El comprobante se excede por S/ 50.00</p></div>
      </div>

    </div>
  </div>
  <div class=" card ">
    <div class="card-body">
      <h2 class='card-title'>Detalle de la compra</h2>
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
  <div class="card col-md-3 mt-2">
    <div class="card-body">
      <ul>
        <li><p>Rosmery: Crea la compra el 14/12/2019</p></li>
        <li><p>Antonio: Agrega item: <em>60 bolsas impresas x 100 Unds.</em> el 15/12/2019</p></li>
        <li><p>Carlos: Elimina item: <em>60 cajas de cereal x 60 Unds.</em> el 16/12/2019</p></li>
      </ul>
    </div>
  </div>
</div>
@endsection