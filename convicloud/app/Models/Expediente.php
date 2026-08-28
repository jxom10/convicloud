<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Expediente extends Model
{
    public $table = 'expedientes';
	
	
	public function alumno(){
		return $this->hasOne(Alumno::class, 'id','id_alumno');
	}
	public function profesor(){
		return $this->hasOne(Profesor::class, 'id','id_profesor');
	}

}
