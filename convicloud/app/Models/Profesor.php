<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profesor extends Model
{
    public $table = 'profesores';
    
        public function nombre_completo(){
        return $this->nombre . " " . $this->apellido1. " " . $this->apellido2;
    }
}
