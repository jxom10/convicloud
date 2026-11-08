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
				if(PHP_OS != 'WINNT'){
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
					$result = Process::path(base_path())->run("php artisan storage:link");
					$mensaje .=  "\r\n".$result->output();
				}
				else{
					$result = Process::run("rmdir /s /q c:\\xampp\\htdocs\\convicloud\\public\\storage");
					$mensaje .=  "\r\n".$result->output();
					$result = Process::run("rmdir /s /q c:\\xampp\\htdocs\\convicloud\\public\\images");
					$mensaje .=  "\r\n".$result->output();
					$result = Process::run('c:\\xampp\\htdocs\\convicloud_import.exe');
					$mensaje .=  "\r\n".$result->output();
					$result = Process::path(base_path())->run("c:\\xampp\\php\\php.exe artisan migrate");
					$mensaje .=  "\r\n".$result->output();
					$result = Process::path(base_path())->run("c:\\xampp\\php\\php.exe artisan view:clear");
					$mensaje .=  "\r\n".$result->output();
					$result = Process::path(base_path())->run("c:\\xampp\\php\\php.exe artisan storage:link");
					$mensaje .=  "\r\n".$result->output();
				}
				session()->now('message', ['texto'=>$mensaje,'color'=>'success']);
				
				return view('tools.update');

			}
			else{
				session()->now('message', ['texto'=>'La contraseña no es válida','color'=>'warning']);
			}
		}

		return view('tools.update');	
	}
	/*exportar base de datos*/
	public function export(){

		$dbname = config('database.connections.mariadb.database');
		$username = config('database.connections.mariadb.username');
		$password = config('database.connections.mariadb.password');
		$file =  "backups/backup".date('Ymd').".sql";
		$os = PHP_OS;
		$rutaExe = ($os=='WINNT') ? "c:\\xampp\\mysql\\bin\\mysqldump.exe " : "mariadb-dump ";
		$pass = (strlen($password)>1) ? " -p" . $password ." " :"" ;
		$txt = $rutaExe." -u".$username." ".$pass." ". $dbname." > ".$file ;
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
		$os = PHP_OS;
		$rutaExe = ($os=='WINNT') ? "c:\\xampp\\mysql\\bin\\mysql.exe " : "mariadb ";
		$pass = (strlen($password)>1) ? " -p" . $password ." " :"" ;
		$txt = $rutaExe." -u " . $username . $pass ." ". $dbname . " <  backups/backup.sql";
		
		if($request->hasFile('file')){
			$file = $request->file('file');
			$file->move(public_path('backups'),'backup.sql');
			$this->remove_line('backups/backup.sql','/*M!999999\- enable the sandbox mode */ ');
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
	function remove_line($file, $remove) {
		$lines = file($file, FILE_IGNORE_NEW_LINES);
		foreach($lines as $key => $line) {
			if($line === $remove) unset($lines[$key]);
		}
		$data = implode(PHP_EOL, $lines);
		file_put_contents($file, $data);
	}
}
