<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use DateTime;

class AlumnoController extends Controller
{

   public function index(Request $request,$orden = 'nia',$direccion = 'asc'){
		//dd($request->all());
		$campos = ['nia','nombre','apellido1','apellido2'];
		$sort = (in_array($orden,$campos))? $orden: 'nia';
		$buscar = null;
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->buscar)){
			$buscar = $request->buscar;
			$alumnos = Alumno::where('nombre','LIKE', '%'.$buscar.'%')
									->orwhere('apellido1','LIKE', '%'.$buscar.'%')
									->orwhere('apellido2','LIKE', '%'.$buscar.'%')
									->paginate(50);
		}
		else{
			$alumnos = Alumno::OrderBy($sort,$direccion)->paginate(50);
		}
		


		return view('alumno.lista',['alumnos'=>$alumnos,'titulo'=>'Alumnos','buscar'=>$buscar]);
	
	}
	public function listar($busqueda){		
		$alumnos = new Alumno;
      $alumnos = $alumnos->where('nia','LIKE',$busqueda)
                        ->orWhere('nombre','LIKE',$busqueda.'%')
                        ->orWhere('apellido1','LIKE',$busqueda.'%')->limit(10)->get();
      
		return json_encode($alumnos);
	
	}
	public function ver ( $id = null){
		if($id){
			$alumno = Alumno::find($id);
			$titulo = "Modificar ficha de ";
			if(!$alumno){
				$alumno = new Alumno;
				$titulo = "Crear ficha de";
				session()->flash('message', 'El datos solicitado no existe. Se crearáun registro nuevo');
			}
			
		}
		else{
			$alumno = new Alumno;
			$titulo = "Crear ficha de ";
		}
		return view('alumno.ver',['alumno'=>$alumno,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		if(!empty($request->id)){
			$alumno = Alumno::find($request->id);
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
	public function importar(Request $request)   {
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
      return redirect()->route('alumnos_lista');
    }

   public function guardar_alumno($data){

		$alumno = new Alumno;
       
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
   public function get($id){
      return json_encode(Alumno::find($id));
    }
        public function delete($id){
        $alumno = Alumno::find($id);    
        if($alumno){
            $alumno->delete();
        }
        return redirect()->route('alumnos');
    }
    
}
