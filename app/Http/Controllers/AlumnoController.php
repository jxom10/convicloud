<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alumno;
use DateTime;

class AlumnoController extends Controller
{
   public function index($orden = 'nia',$direccion = 'asc'){
	   
		$campos = ['nia','nombre','apellido1','apellido2'];
		$sort = (in_array($orden,$campos))? $orden: 'nia';
		$alumnos = alumno::OrderBy($sort,$direccion)->paginate(50);


		return view('alumno.lista',['alumnos'=>$alumnos]);
	
	}
	public function listar(){		
		$alumnos = alumno::All();
		return json_encode($alumnos);
	
	}
	public function ver ( $id = null){
		if($id){
			$alumno = alumno::find($id);
			$titulo = "Modificar ficha";
			if(!$alumno){
				$alumno = new alumno;
				$titulo = "Alta ficha alumno";
				session()->flash('message', 'El datos solicitado no existe. Se crearáun registro nuevo');
			}
			
		}
		else{
			$alumno = new alumno;
			$titulo = "Alta ficha alumno";
		}
		return view('alumno.anadir',['alumno'=>$alumno,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		if(!empty($request->id)){
			$alumno = alumno::find($request->id);
		}
		else{
			$alumno = new  alumno;
		}
		$alumno->nombre = $request->nombre;
		$alumno->apellido1 = $request->apellido1;
		$alumno->apellido2 = $request->apellido2;
		$alumno->email = $request->email;
		if(!empty($request->contrasena)){
			$alumno->contrasena = $request->contrasena;
		}
		
		$alumno->save();
		return redirect('alumno/ver/'.$alumno->id);
		
		
	}
	
	public function form_importar(){
		return view('alumno.import');
	}
	public function importar(Request $request)
    {
        //~ $request->validate([
            //~ 'import_csv' => 'required|mimes:csv',
        //~ ]);

        $file = $request->file('import_csv');

		$row = 1;
		if (($handle = fopen($file->path(), "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				if($row>1){
					$data = array_map("utf8_encode", $data);
					$num = count($data);
					$this->guardar_alumno($data);
	
				}
				$row++;
			}
			fclose($handle);
		}
    }

    public function guardar_alumno($data){

		$alumno = new alumno;
       
		$alumno->nia = $data[8];
		$alumno->nombre = $data[7];
		$alumno->apellido1 = $data[5];
		$alumno->apellido2 = $data[6];
		$alumno->fecha_nacimiento = (!empty($data[9]) AND count(explode($data[9],'/'))	>1) ? DateTime::createFromFormat('d/m/Y',$data[9])->format('Y-m-d'):'1970-01-01';
		$alumno->curso = $data[2];
		$alumno->grupo = $data[3];
		$alumno->genero = $data[8];
		$alumno->save();
           
       
    }
}
