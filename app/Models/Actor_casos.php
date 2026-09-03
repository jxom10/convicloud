<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor_casos extends Model
{
    public $table = 'actor_casos';
    
    public function alumno(){
		return $this->hasOne(Alumno::class,'id','id_alumno');
	}
	
    

}
