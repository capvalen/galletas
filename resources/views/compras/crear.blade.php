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
<form action="{{route('compra.insertar')}}" method="post">
@csrf
<div class="card-deck">
  <div class="card col-md-4">
    <div class="card-body">
      <h2 class='card-title'>Datos de la compra</h2>
        <label for="">RUC o Razón social</label>
        <select name="idProveedor" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
					@foreach ($proveedores as $proveedor )
          <option value="{{$proveedor->id}}"> {{$proveedor->ruc}} - {{$proveedor->razonSocial}}</option>
          @endforeach
        </select>
        <label for="">Categoría</label>
        <select name="idCategoriaCompras" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          @foreach ($categorias as $categoria )
          <option value="{{$categoria->id}}"> {{$categoria->descripcion}}</option>
          @endforeach
        </select>
        <label for="">Moneda</label>
        <select name="idMoneda" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
					@foreach ($monedas as $moneda )
          <option value="{{$moneda->id}}"> {{$moneda->descripcion}}</option>
          @endforeach
        </select>
        <label for="">Comprobante</label>
        <select name="idComprobante" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
					@foreach ($comprobantes as $comprobante )
          <option value="{{$comprobante->id}}"> {{$comprobante->descripcion}}</option>
          @endforeach
        </select>
        <label for="">Serie y Correlativo</label>
        <input class="form-control" type="text" name="serieCorrelativo">
        <label for="">¿A crédito?</label>
        <select name="esCredito" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Si</option>
          <option value="2">No</option>
        </select>
        <label for="">¿Contiene IGV?</label>
        <select name="tieneIGV" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
          <option value="1">Si</option>
          <option value="2">No</option>
        </select>
        <label for="">Fecha de compra</label>
        <input class="form-control" type="date" name="fecha" value="<?= date('Y-m-d'); ?>">
        <label for="">Importe final</label>
        <input class="form-control" type="number" name="total" value="0.00">
        <label for="">Observaciones</label>
        <input class="form-control" type="text" name="detalle" value="">
      <button class="btn btn-outline-success mt-2 btn-block" type="submit"><i class="icofont-save"></i> Crear compra</button>
    </div>
  </div>
  <div class="card col">
    <div class="card-body">
      <h2 class='card-title'>Detalle</h2>
			<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#exampleModal">Agregar detalle</button>
		
			
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
          <label for="">Producto</label>
          <select id="sltPProducto" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
						@foreach ($insumos as $insumo )
						<option value="{{$insumo->id}}"> {{$insumo->descripcion}}</option>
						@endforeach
					</select>
					<label for="">Marca</label>
					<input type="text" name="" id="txtMarcas" class="form-control">
          {{-- <select id="sltPUnidad" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
						@foreach ($marcas as $marca )
						<option value="{{$marca->id}}"> {{$marca->descripcion}}</option>
						@endforeach
					</select> --}}
          <label for="">Unidad</label>
          <select id="sltPUnidad" class="selectpicker" id="sltRUCCliente" data-live-search="true" data-width="100%">
						@foreach ($unidades as $unidad )
						<option value="{{$unidad->id}}" data-abreviatura="{{$unidad->abreviatura}}"> {{$unidad->descripcion}}</option>
						@endforeach
					</select>
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
</form>
@endsection

@section('script')
<script>
	var options = {
	data: [
		{"name": "Afghanistan", "code": "AF"},
		{"name": "Aland Islands", "code": "AX"},
		{"name": "Albania", "code": "AL"},
		{"name": "Algeria", "code": "DZ"},
		{"name": "American Samoa", "code": "AS"},
	],
	getValue: "name",
	list: {
		match: {
			enabled: true
		},
		showAnimation: {
			type: "fade", //normal|slide|fade
			time: 400,
			callback: function() {}
		},

		hideAnimation: {
			type: "slide", //normal|slide|fade
			time: 400,
			callback: function() {}
		},
		sort: {
			enabled: true
		}
	}
};
	
	$("#txtMarcas").easyAutocomplete(options);
	$('#btnPrueba').click(function() {
		$('#divPrueba').append(`
			<div class="row">
					<input class="hidden" type="text" name="producto[]" id="">
					<input class="hidden" type="text" name="cantidad[]" id="">
				</div>
				`);
	});
</script>
@endsection