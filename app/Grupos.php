<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
		//
		public function grupo(){
			return $this->hasMany(Galerias::class, 'galerias');
		}
}
