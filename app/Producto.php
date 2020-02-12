<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
		//
		
		public function tipo_Displays(){
			return $this->hasMany('App\TipoDisplay');
			
		}
}
