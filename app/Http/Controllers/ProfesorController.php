<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\User;
class ProfesorController extends Controller
{
    public function index(){
		$profesores = new Profesor;
		$profesores= $profesores->paginate(50);;
		return view('profesor.lista',['profesores'=>$profesores]);
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
            $titulo = "Modificar ficha";
        }
		else{	
				$profesor = new Profesor;
				$titulo = "Alta ficha profesor";

		}
		return view('profesor.ver',['profesor'=>$profesor,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
         $mensaje = "";
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
		return redirect('profesores/ver/'.$profesor->id);
	}
    public function delete($id){
        $profe = Profesor::find($id);    
        if($profe){
            $profe->delete();
        }
        return redirect()->route('profesores');
    }
}
