<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;


class ToolsController extends Controller
{
   public function actualizar(Request $request){

		if(isset($request->password)) {
			
			
			if($request->password=='Iesmh4ever'){	
				$pasos = array("crear carpeta temporal"=>"mkdir .convicloud_temp",
						"crear carpeta temporal"=>"cd .convicloud_temp",
						"descargar actualizacion"=>"wget https://github.com/jxom10/convicloud/archive/refs/heads/main.zip",
						"descomprimir fichero"=>"unzip -q main.zip",
						"cambiar permisos public"=>"chmod 777 -R convicloud-main/public",
						"cambiar permisos storage"=>"chmod 777 -R convicloud-main/storage",
						"actualizar ficheros"=>"rsync -av convicloud-main/. ../../",
						"borrar carpeta temporal"=>"rm -R .convicloud_temp");
						
				foreach($pasos as $desc=>$script){
					if(!$result = Process::run($script)){
						echo "error en ".$desc."<br>";
						print_r($result);
					}
				}
			
			session()->flash('message', ['texto'=>'Actualizacion correcta','color'=>'success']);
			return view('inicio');

			}
			else{
				session()->flash('message', ['texto'=>'La contraseña no es válida','color'=>'warning']);
			}
		}
		return view('tools.update');	
	}

}
