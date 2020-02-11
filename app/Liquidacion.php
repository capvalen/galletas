<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
		//
		public function usuarios(){
			return $this->hasMany('App\User', 'id', 'idUser');
		}
}
