<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
		//
		public function productos(){
			return $this->hasMany('App\Producto', 'tipo_productos_id' );
		}
}
