<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Profesor;
use App\Models\User;
class ProfesorController extends Controller
{
	public function index(Request $request,$orden = 'nombre',$direccion = 'asc'){

		$profesores= new Profesor;	
		if($_POST){
			$busqueda= $_POST;
			session()->put('filtro_profesores',$_POST);
		}
		elseif(session()->get('filtro_profesores')){
			$busqueda= session()->get('filtro_profesores');
		}
		else{
			$busqueda  = array("nombre"=>"","curso"=>"","grupo"=>""); 
			session()->put('filtro_profesores',$busqueda);
		} 
		
		if(isset($busqueda['clean'])){
			$busqueda  = array("profesores"=>"","curso"=>"","active"=>null);
		}
		if(isset($busqueda['_token'])){
			
			if(isset($busqueda['active']) AND $busqueda['active']==1){
				$profesores= $profesores->where('active',1);
			}
			if($busqueda['profesores'] != null){
				$profesores = $profesores->where(
								function($query) use ($busqueda){
									$query->where('nombre','LIKE', '%'.	$busqueda['profesores'] . '%')
										->orwhere('apellido1','LIKE', '%'.	$busqueda['profesores'] . '%')
										->orwhere('apellido2','LIKE', '%'. 	$busqueda['profesores'] . '%');
									}
								);													

				
			}
			if($busqueda['curso']!= null){
				$profesores = $profesores->where('curso','LIKE','%'.$busqueda['curso'].'%'); 
			}
			
		}
		else{
			$profesores= $profesores->where('active',1);
		}
		
		$total = $profesores->count();
		$profesores= $profesores->OrderBy($orden,$direccion)->paginate(session('config.porpagina'));
		session()->put('filtro_profesores',$busqueda);
		
		return view('profesor.lista',['profesores'=>$profesores,'buscar'=>$busqueda,'total'=>$total]);
	}
	public function listar($text = null){	
		$profesores = new Profesor;
		$profesores = $profesores->where('nombre','like','%'.$text.'%')->get();
		return json_encode($profesores);
	}
    public function get($id){	
		return json_encode( Profesor::find($id));
    }
	public function ver ( $id = null){
		if($id){
			$profesor = Profesor::find($id);
            $titulo = "Modificar ficha de";
        }
		else{	
				$profesor = new Profesor;
				$titulo = "Crear ficha de ";

		}
		
		return view('profesor.ver',['profesor'=>$profesor,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){

         $mensaje = "";
         $validated = $request->validate([
				'nombre' => ['required'],
				'apellido1' => ['required'],
				'email' => ['required','unique:profesores,id,'.$request->id],
			]);
		if(!empty($request->id)){
			$profesor = Profesor::find($request->id);
		}
		else{
			$profesor =  new profesor;
            $mensaje .= "Ficha profesor creada.";
			$color ="success";
		}
		$profesor->nombre = $request->nombre;
		$profesor->apellido1 = $request->apellido1;
		$profesor->apellido2 = $request->apellido2;
		$profesor->email = $request->email;
		$profesor->curso = $request->curso;
		$profesor->grupo = $request->grupo;
		$profesor->active = (isset($request->active))? 1 :0;
		if(!empty($request->password)){
            $usuario = new User;
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            if($usuario->save()){
                $mensaje .= 'tambien se ha creado el usuario '.$usuario->email;
                $color ="success";
            }
		}
		if($profesor->save()){
            session()->now('message', ["texto"=>$mensaje,"color"=>$color]);
        }
		return redirect('profesor/ver/'.$profesor->id);
	}
    public function delete($id){
		
        $profe = Profesor::find($id);    
        if($profe){
            $profe->delete();
        }
        return redirect()->route('profesores');
    }
	public function form_importar(){
		return view('profesor.import');
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

		if(isset($request->import_csv)){
			$file = $request->file('import_csv');

			$row = 0;
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
							$this->guardar_profesor($datos);
						}
						
					}
					$row++;
				}
				
				fclose($handle);
			}
		}
		else{
			session()->now('message', ["texto"=>"No se ha cargado ningún fichero..","color"=>"danger"]);
		}
		
		return redirect()->route('profesores');
    }
	public function guardar_profesor($data){

		$profesor = Profesor::where('email','=',$data['Email'])->first()	;
		if(!$profesor){
			$profesor = new Profesor;
		}
		$profesor->nombre = $data['Nombre'];
		$profesor->apellido1 = $data['Primer apellido'];
		$profesor->apellido2 = $data['Segundo apellido'];
		$profesor->curso = $data['Curso'];
		$profesor->grupo = $data['Grupo'];
		$profesor->email = $data['Email'];
		$profesor->active = (isset($data['activo']))? $data['activo']: 1;
		$profesor->save();

        
       
    }
}
