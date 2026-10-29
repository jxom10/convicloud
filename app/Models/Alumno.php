<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profesor;

class alumno extends Model
{
    public function nombre_completo(){
        return $this->nombre . " " . $this->apellido1. " " . $this->apellido2;
    }
    public function expedientes()
    {
		 return $this->hasMany(Expediente::class,'id_alumno','id');
	}
	public function partes()
    {
		 return $this->hasMany(Parte::class,'id_alumno','id');
	}
	public function casos()
    {
		 return $this->hasMany(Actor_casos::class,'id_alumno','id');
	}
	public function tutor()
    {
		$profesor = Profesor::where('curso',$this->curso)
								->where('grupo',$this->grupo)
								->first();
		 return $profesor;
	}
}
