<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
