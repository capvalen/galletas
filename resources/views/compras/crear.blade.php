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
<div id="app">
<form action="{{route('compra.insertar')}}" method="post" >
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
            <th>Unidad</th>
            <th>Descripción</th>
            <th>P. Unit</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
					<tr v-if='listaVacia'>
						<td colspan="5">No hay elementos en la lista</td>
					</tr>
					<tr v-for='(insumo, index) of insumos' :data-row="index">
						<td>@{{insumo.cantidad}}</td>
						<td>@{{insumo.und}}</td>
						<td>@{{insumo.insumo}} @{{insumo.marca}} @{{insumo.comentario}}</td>
						<td>@{{parseFloat(insumo.precio).toFixed(2)}}</td>
						<td>@{{parseFloat(insumo.subTotal).toFixed(2)}} <button class="btn btn-outline-danger border-0" type="button" v-on:click="eliminarFila(index)"><i class="icofont-close"></i> </button></td>
						<td class="d-none">
							<input type="number" min=0 step="any" class="d-none" name="cantidad[]" v-model.number='insumo.cantidad'>
							<input type="number" min=0 step="any" class="d-none" name="unidad[]" v-model.number='insumo.unidad'>
							<input type="text" class="d-none" name="insumo[]" v-model='insumo.insumo'>
							<input type="text" class="d-none" name="marca[]" v-model='insumo.marca'>
							<input type="text" class="d-none" name="comentario[]" v-model='insumo.comentario'>
							<input type="number" min=0 step="any" class="d-none" name="precio[]" v-model.number='insumo.precio'>
							<input type="number" min=0 step="any" class="d-none" name="subtotal[]" v-model.number='insumo.subTotal'>
						</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-right" colspan="4">P. Venta</th>
            <th>S/ <span>@{{parseFloat(vPventa).toFixed(2)}}</span></th>
          </tr>
          <tr>
            <th class="text-right" colspan="4">I.G.V.</th>
            <th>S/ <span>@{{parseFloat(vImpuesto).toFixed(2)}}</span></th>
          </tr>
          <tr>
            <th class="text-right" colspan="4">Total</th>
            <th>S/ <span>@{{parseFloat(vFinal).toFixed(2)}}</span></th>
          </tr>
        </tfoot>
			</table>
			<input type="number" min=0 step="any" class="d-none" name="subtotal" v-model="vPventa">
			<input type="number" min=0 step="any" class="d-none" name="igv" v-model="vImpuesto">
			<input type="number" min=0 step="any" class="d-none" name="total" v-model="vFinal">
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
          <label for="">Insumo</label>
					<input type="text" name="" id="txtInsumos" class="form-control" v-model="vInsumo">
					<label for="">Marca</label>
					<input type="text" name="" id="txtMarcas" class="form-control" v-model="vMarca">
					<label for="">Und.</label>
					<select name="" id="sltPUnidad" class="form-control selectpicker" v-model="vUnidad">
						@foreach ($unidades as $unidad )
						<option value="{{$unidad->id}}" data-abreviatura="{{$unidad->abreviatura}}"> {{$unidad->descripcion}}</option>
						@endforeach
					</select>
          <label for="">Descripción</label>
          <input class="form-control" type="text" name="" value="" v-model="vComentario">
          <label for="">Cantidad</label>
          <input class="form-control" type="number" name="" value="1" v-model="vCantidad">
          <label for="">Precio</label>
          <input class="form-control esMoneda" type="number" name="" value="0.00" v-model="vPrecio">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" v-on:click="agregarInsumos" data-dismiss="modal">Agregar Descripción</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
@endsection

@section('script')
<script>
	
	$('#btnPrueba').click(function() {
		$('#divPrueba').append(`
			<div class="row">
				<input class="hidden" type="text" name="producto[]" id="">
				<input class="hidden" type="text" name="cantidad[]" id="">
			</div>
			`);
	});
	function opcionesAuto(base, placeholder){
		var options = {
			url: function() {
				return urlBase(base);
			},
			getValue: "descripcion",
			placeholder: placeholder,
			list: {
				match: {
					enabled: true
				},
				showAnimation: {
					type: "fade", //normal|slide|fade
					time: 300,
					callback: function() {}
				},

				hideAnimation: {
					type: "slide", //normal|slide|fade
					time: 300,
					callback: function() {}
				},
				sort: {
					enabled: true
				},
				onChooseEvent: function() {
					if( base =='marcas/todos' ){app.cambiarMarca();}
					if( base =='insumos/todos' ){app.cambiarInsumo();}
				}
			}
		};
		return options;
	}
	Vue.component('date-picker', function() {
		template: '<input/>'
	});
	var app = new Vue({
		el: '#app',
		data: {
			insumos: [],
			vInsumo: '',
			vMarca: 'Sin marca', 
			vUnidad: 1,
			vUnd: 'Und',
			vComentario: '', 
			vCantidad: 1, 
			vPrecio: 0,
			vPventa: 0,
			vImpuesto: 0, vFinal:0,
			listaVacia: true
		},
		methods:{
			agregarInsumos(){
				//console.log('click');
				this.listaVacia = false;
				this.vPventa += this.vPrecio*this.vCantidad;
				app.calcularImpuesto();
				this.insumos.push({ unidad: this.vUnidad, und: this.vUnd,
				cantidad: this.vCantidad, marca: this.vMarca, insumo: this.vInsumo, comentario: this.vComentario, precio: parseFloat(this.vPrecio).toFixed(2), subTotal: this.vPrecio*this.vCantidad});
			},
			cambiarInsumo(){ this.vInsumo = $('#txtInsumos').val(); },
			cambiarMarca(){ this.vMarca = $('#txtMarcas').val(); },
			calcularImpuesto(){
				this.vImpuesto = this.vPventa * 0.18;
				this.vFinal = this.vImpuesto + this.vPventa;

			},
			eliminarFila( index ){ console.log(index)
				this.insumos.splice(index,1);
				$(this).parent().remove();
			}
		}, 
		mounted: function(){
			$("#txtMarcas").easyAutocomplete( opcionesAuto('marcas/todos', 'Busque o cree una marca') );
			$("#txtInsumos").easyAutocomplete( opcionesAuto('insumos/todos', 'Busque o cree un insumo') );
			$('#sltPUnidad').selectpicker('val', 1);
			$('#sltPUnidad').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) { //console.log( 'ant ' + app.vUnd );
				app.vUnd = $(`#sltPUnidad`).find(`option[value="${$(this).val()}"]`).attr('data-abreviatura');
				//console.log( 'desp ' + app.vUnd );
			});

		}
	})
</script>
@endsection