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
	public function tipologia(){
		return $this->hasOne(Tipologia::class, 'id','id_tipologia');
	}
	public static  function total_mensuales(){
		$anio = (date('%m')<9 ) ? date('Y'): date('Y')-1;
		$mensuales= self::selectRaw(' month(fecha) as mes, count(*) total')
				->whereBetween('fecha', [$anio.'-09-01',($anio+1).'-08-31'])
                ->groupBy( 'mes')
                ->get()
                ->toArray();        
		$datos= array('9'=>'','10'=>'','11'=>'','12'=>'','1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'','7'=>'','8'=>'');
		foreach($mensuales as $data){
			$datos[$data['mes']] = $data['total'];
		}
		return $datos;
	}
}
