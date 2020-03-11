<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
		//
		
		public function displays(){
			return $this->belongsTo('App\TipoDisplay', 'tipo_displays_id');
		}
		public function tipos(){
			return $this->belongsTo('App\TipoProducto', 'tipo_productos_id');
		}
		public function marcas(){
			return $this->belongsTo('App\MarcaDisplay', 'marca_displays_id');
		}
		public function unidades(){
			return $this->belongsTo('App\unidades', 'unidades_id');
		}
}
