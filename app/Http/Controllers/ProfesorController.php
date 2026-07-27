<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profesor;

class ProfesorController extends Controller
{
    public function index(){
		$profesores = new profesor;
		$profesores= $profesores->paginate(50);;
		return view('profesor.lista',['profesores'=>$profesores]);
	
	}
	public function listar($text = null){	
			
		$profesores = new profesor;
		$profesores = $profesores->where('nombre','like','%'.$text.'%')->get();

		return $profesores;
	
	}
	public function ver ( $id = null){
		if($id){
			$profesor = profesor::find($id);
			$titulo = "Modificar ficha";
			if(!$profesor){
				$profesor = new profesor;
				$titulo = "Alta ficha profesor";
				session()->flash('message', 'El datos solicitado no existe. Se crearáun registro nuevo');
			}
			
		}
		else{
			$profesor = new profesor;
			$titulo = "Alta ficha profesor";
		}
		return view('profesor.anadir',['profesor'=>$profesor,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		if(!empty($request->id)){
			$profesor = profesor::find($request->id);
		}
		else{
			$profesor = new  profesor;
		}
		$profesor->nombre = $request->nombre;
		$profesor->apellido1 = $request->apellido1;
		$profesor->apellido2 = $request->apellido2;
		$profesor->email = $request->email;
		if(!empty($request->contrasena)){
			$profesor->contrasena = $request->contrasena;
		}
		
		$profesor->save();
		return redirect('profesores/ver/'.$profesor->id);
		
		
	}
}
