<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class galeria_tipo extends Model
{
		//
		public function grupos(){
			return $this->belongsTo(Grupos::class, 'grupo_id', 'grupos');
			//return $this->hasMany('App\Grupos');
		}
}
