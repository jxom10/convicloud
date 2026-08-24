<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class parte extends Model
{
    public function alumno(){
		return $this->hasOne(Alumno::class, 'id','id_alumno');
	}
	public function profesor(){
		return $this->hasOne(Profesor::class, 'id','id_profesor');
	}
}
