<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;


class ToolsController extends Controller
{
   public function actualizar(Request $request){
		if(isset($request->password)) {
			
			
			if($request->password=='Iesmh4ever'){	

				$result = Process::run('mkdir .convicloud_temp');
				$result = Process::path('.convicloud_temp')->run("wget https://github.com/jxom10/convicloud/archive/refs/heads/main.zip");
				$result = Process::path('.convicloud_temp')->run("unzip -q main.zip");
				$result = Process::path('.convicloud_temp')->run("chmod 777 -R .convicloud_temp/convicloud-main/public");
				$result = Process::path('.convicloud_temp')->run("chmod 777 -R .convicloud_temp/convicloud-main/storage");
				$result = Process::path('.convicloud_temp')->run("rsync -avi convicloud-main/. ../../");
				//echo "<pre>";
				//print_r($result->output());
				//echo "</pre>";
				$result = Process::run('rm -R .convicloud_temp');
				
				$result = Process::path(base_path())->run("php artisan migrate");
				
				session()->now('message', ['texto'=>'Actualizacion correcta','color'=>'success']);
				die();
				//return view('inicio');

			}
			else{
				session()->now('message', ['texto'=>'La contraseña no es válida','color'=>'warning']);
			}
		}

		return view('tools.update');	
	}

}
