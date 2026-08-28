<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alumno extends Model
{
    public function nombre_completo(){
        return $this->nombre . " " . $this->apellido1. " " . $this->apellido2;
    }
}
