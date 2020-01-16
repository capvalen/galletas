<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galerias extends Model
{
		//
		public function grupo(){
			return $this->belongsTo(Grupos::class);
		}
}
