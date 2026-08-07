<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class caso extends Model{
	
	public $table = 'casos';
	

	
	public function estado(){
		return $this->hasOne(estado::class, 'id','id_estado');
	}
	public function triaje(){
		return $this->hasOne(triaje::class, 'id','id_triaje');
	}

}
