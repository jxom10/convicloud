<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;


class ToolsController extends Controller
{
   public function actualizar(Request $request){
		if(isset($request->password)) {
			if($request->password=='Iesmh4ever'){	
				$mensaje = "";
				$result = Process::run('mkdir .convicloud_temp');
				$result = Process::path('.convicloud_temp')->run("wget https://github.com/jxom10/convicloud/archive/refs/heads/main.zip");
				$result = Process::path('.convicloud_temp')->run("unzip -q main.zip");
				$result = Process::path('.convicloud_temp')->run("chmod 777 -R .convicloud_temp/convicloud-main/public");
				$result = Process::path('.convicloud_temp')->run("chmod 777 -R .convicloud_temp/convicloud-main/storage");
				$result = Process::path('.convicloud_temp')->run("rsync -avi convicloud-main/. ../../");
				$result = Process::run('rm -R .convicloud_temp');
				
				$result = Process::path(base_path())->run("php artisan migrate");
				$mensaje .= $result->output();
				$result = Process::path(base_path())->run("php artisan view:clear");
				$mensaje .= $result->output();
				session()->now('message', ['texto'=>$mensaje,'color'=>'success']);
				
				return view('tools.update');

			}
			else{
				session()->now('message', ['texto'=>'La contraseña no es válida','color'=>'warning']);
			}
		}

		return view('tools.update');	
	}
	/*exporatar base de datos*/
	public function export(){

		$dbname = config('database.connections.mariadb.database');
		$username = config('database.connections.mariadb.username');
		$password = config('database.connections.mariadb.password');
		$file =  "backups/backup".date('Ymd').".sql";
		$txt = "mariadb-dump -u".$username." -p".$password." ". $dbname." > ".$file ;
		if($result = Process::run($txt)){
			session()->now('message', ["texto"=>"Fichero exportado correctamente","color"=>"success"]);
		}
		else{
			session()->now('message', ["texto"=>"Error al exportar fichero","color"=>"danger"]);
		}
		
	  	return response()->download($file);

	}
	/*importar base de datos*/
	public function importar(Request $request){
		$dbname = config('database.connections.mariadb.database');
		$username = config('database.connections.mariadb.username');
		$password = config('database.connections.mariadb.password');
		$txt = "mariadb -u".$username." -p".$password." ". $dbname." <  backups/backup.sql";
		if($request->hasFile('file')){
			$file = $request->file('file');
			$file->move(public_path('backups'),'backup.sql');

			if($result = Process::run($txt)){
				session()->now('message', ["texto"=>"Datos importada correctamente","color"=>"success"]);
			}
			else{
				session()->now('message', ["texto"=>"Error al importar los datos","color"=>"danger"]);
			}
		}
		return view('tools.databaseimport');
		
	}
}
