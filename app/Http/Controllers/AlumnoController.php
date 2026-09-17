<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
//use App\Models\Expediente;
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
		
		$validated = $request->validate([
			'nombre' => ['required'],
			'apellido1' => ['required'],
			/*'nia' => ['required','unique:alumnos,id,'.$request->id_alumno]*/
		]);
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
		$alumno->curso = strtoupper($request->curso);
		$alumno->grupo = strtoupper($request->grupo);
		$alumno->genero = $request->genero;
		$alumno->nia = (empty($request->nia))?" " : $request->nia;

		
		$alumno->save();
		return redirect('alumno/ver/'.$alumno->id);
		
		
	}
	
	public function form_importar(){
		return view('alumno.import');
	}
	public function is_utf8($path){
		$output = array();
		exec('file -i ' . $path, $output);
		if (isset($output[0])){
			$ex = explode('charset=', $output[0]);
			return isset($ex[1]) ? $ex[1] : null;
		}
	}
	public function importar(Request $request)   {
		$campos= ['Genero','Curso','Grupo','Primer apellido','Segundo apellido','Nombre','NIA','Fnac' ];
		if(isset($request->import_csv)){
			$file = $request->file('import_csv');

			$row = 0;
			//$headerValues=['','Genero','Curso','Grupo','Primer apellido','Segundo apellido','Nombre','NIA','Fnac',''];
			
			if (($handle = fopen($file->path(), "r")) !== FALSE) {
				$this->is_utf8($file->path());
				while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {		
					$data = ($this->is_utf8($file->path()) !="utf-8") ? array_map("utf8_encode", $data):$data;

					if($row == 0){
						$headerValues = $data;
					}
					if($row>0){
						$num = count($data);
						foreach($data as $campo=>$valor){
							$datos[$headerValues[$campo]] = $valor;

						}
						if(strlen($datos['Nombre'])>2){
							$this->guardar_alumno($datos);
						}
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
	   //$data = array_map("utf8_encode", $data);

		//$id = $this->check_alumno($data);
		
		$alumno = 	Alumno::where('nombre','=',$data['Nombre'])
							->where('apellido1','=',$data['Primer apellido'])
							->where('apellido2','=',$data['Segundo apellido'])->first();
		if(!$alumno){
			$alumno = new Alumno;
		}
		
       
		$alumno->nia = $data['NIA'];
		$alumno->nombre = $data['Nombre'];
		$alumno->apellido1 = $data['Primer apellido'];
		$alumno->apellido2 = $data['Segundo apellido'];
		$alumno->fecha_nacimiento = (!empty($data['fnac']) AND count(explode($data['fnac'],'/'))	>1) ? DateTime::createFromFormat('d/m/Y',$data['fnac'])->format('Y-m-d'):'1970-01-01';
		$alumno->curso = (isset($data['Curso']))?$data['Curso']:'';
		$alumno->grupo =  (isset($data['Grupo']))?$data['Grupo']:'';
		$alumno->genero = (isset($data['Genero']) AND in_array($data['Genero'],['O','A','E']))? $data[1]: 'N';
		$alumno->active = 1;

		$alumno->save();
    }
    //public function check_alumno($datos){
		//$alumno = new Alumno;

		//$alumno = $alumno->where('nombre','=',$datos['Nombre'])
							//->where('apellido1','=',$datos['Primer apellido'])
							//->where('apellido2','=',$datos['Segundo apellido'])->first();
							

		//if($alumno){
			//return $alumno->id;
		//}
		//return false;
		
	//}
   public function get($id){
      return json_encode(Alumno::find($id));
    }
    public function delete($alumno){
		try {
			$alumno = Alumno::find($alumno);
			$alumno->delete();
		}catch(\Illuminate\Database\QueryException $e){
				return  back()->with('message', 'No se puede eliminar este alumno. Tienes ');
		}
        
        return redirect()->route('alumnos');
    }
    
}
