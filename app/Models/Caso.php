<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Actor_caso;
use App\Models\Estado;
class caso extends Model{
	
	public $table = 'casos';
	

	
	public function estado(){
		return $this->hasOne(Estado::class, 'id','id_estado');
	}
	public function triaje(){
		return $this->hasOne(Triaje::class, 'id','id_triaje');
	}
    public function origen(){
		return $this->hasOne(Origen::class, 'id','id_origen');
	}
    public function tipologia(){
		return $this->hasOne(Tipologia::class, 'id', 'id_tipologia');
	}
	public function lista_implicados(){
		return $this->hasMany(Actor_casos::class, 'id_caso');
	}

}
