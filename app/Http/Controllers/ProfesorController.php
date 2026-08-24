<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\User;
class ProfesorController extends Controller
{
    public function index(Request $request){
		
		$profesores = new Profesor;
		$buscar = null;
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->buscar)){
			$buscar =$request->buscar;
			$profesores= $profesores->where('nombre','LIKE', '%'.$buscar.'%')
									->orwhere('apellido1','LIKE', '%'.$buscar.'%')
									->orwhere('apellido2','LIKE', '%'.$buscar.'%')
						->paginate(50);
		}
		else{
			$profesores= $profesores->paginate(50);
		}
		//dd($profesores);
		return view('profesor.lista',['profesores'=>$profesores,'buscar'=>$buscar]);
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
				'email' => ['required'],
			]);
		if(!empty($request->id)){
			$profesor = Profesor::find($request->id);
		}
		else{
			$profesor =  new profesor;
            $mensaje .= "Ficha profesor creada.";
		}
		$profesor->nombre = $request->nombre;
		$profesor->apellido1 = $request->apellido1;
		$profesor->apellido2 = $request->apellido2;
		$profesor->email = $request->email;
		if(!empty($request->password)){
            $usuario = new User;
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            if($usuario->save()){
                $mensaje .= 'tamnbien se ha creado el usuario '.$usuario->email;
            }
		}
		if($profesor->save()){
            session()->flash('mensaje',['success',$mensaje]);
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
}
