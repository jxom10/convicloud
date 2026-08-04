<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profesor;
use App\Models\User;
class ProfesorController extends Controller
{
    public function index(){
		$usuarioes = new profesor;
		$usuarioes= $usuarioes->paginate(50);;
		return view('profesor.lista',['profesores'=>$usuarioes]);
	
	}
	public function listar($text = null){	
			
		$usuarioes = new profesor;
		$usuarioes = $usuarioes->where('nombre','like','%'.$text.'%')->get();

		return $usuarioes;
	
	}
	public function ver ( $id = null){
		if($id){
			$usuario = profesor::find($id);
            $titulo = "Modificar ficha";
        }
		else{	
				$usuario = new profesor;
				$titulo = "Alta ficha profesor";
				session()->flash('message', 'Registro nuevo');
			
			
		}
		return view('profesor.anadir',['profesor'=>$usuario,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
         $mensaje = "";
		if(!empty($request->id)){
			$profesor = profesor::find($request->id);
		}
		else{
			$profesor = new  profesor;
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
    
        $profe = profesor::find($id);    
        if($profe){
            $profe->delete();
        }
        return redirect()->route('profesores');
    }
}
