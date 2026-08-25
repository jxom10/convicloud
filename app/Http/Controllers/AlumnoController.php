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
		//dd($alumno);
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
		$alumno->fecha_nacimiento = $request->fecha_nacimiento;
		$alumno->curso = $request->curso;
		$alumno->grupo = $request->grupo;
		$alumno->genero = $request->genero;
		$alumno->nia = $request->nia;

		
		$alumno->save();
		return redirect('alumno/ver/'.$alumno->id);
		
		
	}
	
	public function form_importar(){
		return view('alumno.import');
	}
	public function importar(Request $request)   {

		if(isset($request->import_csv)){
			$file = $request->file('import_csv');

			$row = 0;
			//$headerValues=['','Genero','Curso','Grupo','Primer apellido','Segundo apellido','Nombre','NIA','Fnac',''];

			if (($handle = fopen($file->path(), "r")) !== FALSE) {
		
				while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {		
					$data = array_map("utf8_encode", $data);
					echo "<br>".$data[0];
					if($row == 0){
						$headerValues = $data;
					}
					if($row>0){
						$num = count($data);
						foreach($data as $campo=>$valor){
							if($campo < 10)
								$datos[$headerValues[$campo]] = $valor;
						}
						$this->guardar_alumno($datos);
						
					}
					$row++;
				}
				
				fclose($handle);
			}
		}
		else{
			$request->session()->flash('message', 'No se ha cargado ningún fichero..');
		}
		
		return redirect()->route('alumnos_lista');
    }

   public function guardar_alumno($data){
		$alumno = new Alumno;
       
		$alumno->nia = $data['NIA'];
		$alumno->nombre = $data['Nombre'];
		$alumno->apellido1 = $data['Primer apellido'];
		$alumno->apellido2 = $data['Segundo apellido'];
		$alumno->fecha_nacimiento = (!empty($data['fnac']) AND count(explode($data['fnac'],'/'))	>1) ? DateTime::createFromFormat('d/m/Y',$data['fnac'])->format('Y-m-d'):'1970-01-01';
		$alumno->curso = $data['Curso'];
		$alumno->grupo = $data['Grupo'];
		$alumno->genero = (in_array($data['Genero'],['O','A','E']))? $data[1]: 'N';

		
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
