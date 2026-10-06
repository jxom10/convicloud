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
				$mensaje .= "\r\n".$result->output();
				$result = Process::path('.convicloud_temp')->run("wget  https://github.com/jxom10/convicloud/archive/refs/heads/main.zip -O main.zip");
				$mensaje .= "\r\n".$result->output();
				$result = Process::path('.convicloud_temp')->run("unzip -q main.zip");
				$mensaje .= "\r\n".$result->output();
				$result = Process::path('.convicloud_temp')->run("chmod 777 -R convicloud-main/public");
				$mensaje .= "\r\n".$result->output();
				$result = Process::path('.convicloud_temp')->run("chmod 777 -R convicloud-main/storage");
				$mensaje .= "\r\n".$result->output();
				$result = Process::path('.convicloud_temp')->run("rsync -a convicloud-main/. ../../");
				$mensaje .= "\r\n".$result->output();
				$result = Process::run('rm -R .convicloud_temp');
				
				$result = Process::path(base_path())->run("php artisan migrate");
				$mensaje .=  "\r\n".$result->output();
				$result = Process::path(base_path())->run("php artisan view:clear");
				$mensaje .=  "\r\n".$result->output();
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
		$txt = "mariadb-dump --insert-ignore --no-create-info -u".$username." -p".$password." ". $dbname." > ".$file ;
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
		
		$txt = "mariadb --init-command='SET SESSION FOREIGN_KEY_CHECKS=0;' -u" . $username . " -p" . $password . " " . $dbname . " <  backups/backup.sql";
		if($request->hasFile('file')){
			$file = $request->file('file');
			$file->move(public_path('backups'),'backup.sql');
			
			if($result = Process::run($txt)){
				$res =  $result->output();
				session()->now('message', ["texto"=>"Datos importada correctamente\n\r".$res,"color"=>"success"]);
			}
			else{
				session()->now('message', ["texto"=>"Error al importar los datos".$res,"color"=>"danger"]);
			}
		}
		
		return view('tools.databaseimport');
		
	}
}
