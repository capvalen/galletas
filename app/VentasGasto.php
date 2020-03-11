<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasGasto extends Model
{
	public function vendedores(){
		return $this->belongsTo('App\Liquidacion', 'liquidacion_id' );
	}
}
