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
	public static  function total_mensuales(){
		$anio = (date('%m')<9 ) ? date('Y'): date('Y')-1;
		$mensuales= self::selectRaw(' month(created_at) as mes, count(*) total')
				->whereBetween('created_at', [$anio.'-09-01',($anio+1).'-08-31'])
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
