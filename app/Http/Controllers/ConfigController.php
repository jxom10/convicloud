<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{	
	public $claves =  array(
						'anio_lectivo'=>'año lectivo',
						'fecha_inicio'=> 'inicio de curso',
						'fecha_fin' => 'fin de curso',
						'porpagina' => 'registros por pagina',
						'email' => 'email',
						'email_pass'=> 'contraseña',
						'email_smtp' => 'servidor de correo',
						'email_port' => 'puerto',
						'aviso_partes'=> 'notificar si partes >',
						);
						
    public function index(){
		$configs = new Config;
		$configs = $configs->select('nombre','valor')->get()->toArray();
		$claves = $this->claves;

		foreach($configs as  $config){
			$datos[$config['nombre']]=$config['valor'];
			unset($claves[$config['nombre']]);
		}
		foreach($claves as $clave=>$valor){
			$datos[$clave]='';
		}
		return view('configuracion.listar',['config'=>$datos,'claves'=>$this->claves]);
	}
	public function grabar(Request $request){
		$datos = $request->all();
		unset($datos['_token']);

		foreach($this->claves as $clave=>$literal){
			if(!array_key_exists($clave,$datos)){
				$datos[$clave]='';
			}
			elseif(!$datos[$clave]){
				$datos[$clave]='';
			}
			
			$config = config::updateOrCreate(
				['nombre'=> $clave],
				['valor'=>$datos[$clave]]);

		}
		session()->put('config',$datos);
		return redirect()->route('config');
	
	}

}
