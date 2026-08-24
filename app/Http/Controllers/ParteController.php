<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parte;
use App\Models\Alumno;
use App\Models\Tipologia;

class ParteController extends Controller
{
      public function index(Request $request){
		  
		$buscar = null;
		
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->buscar)){
			$buscar = $request->buscar;
			$alumnos = alumno::where('nombre','like','%'.$buscar.'%')
								->orwhere('apellido1','like','%'.$buscar.'%')
								->orwhere('apellido2','like','%'.$buscar.'%')->pluck('id');
			$ids = [];		
			foreach($alumnos as $id){
				array_push($ids,$id);
			}
			$partes = Parte::wherein('id_alumno',$ids)->paginate(50);
			
		}
		else{ 

			$partes=  parte::paginate(50);
		}
		return view ('parte.lista',['partes' => $partes,'buscar'=>$buscar]);
	}
	
	public function ver($id = null){
		$tipologias = Tipologia::All();
		if($id){
			$parte = Parte::find($id);
			$titulo = "Alterar Parte";
		}
		else{
			$parte = new Parte;
			$titulo = "Nuevo Parte";
		}
		return view('parte.ver',['parte'=>$parte,'titulo'=>$titulo,'tipologias'=>$tipologias]);
	}
	public function grabar(Request $request){

		$validated = $request->validate([
			'id_alumno' => ['required'],
			'id_profesor' => ['required'],
			'fecha' => ['required'],
			'nivel' => ['required'],
			'descripcion' =>  ['required'],
            'acciones' =>  ['required'],
            'comunicacion' =>  ['required'],
		]);
		if(!empty($request->id)){
			$parte = Parte::find($request->id);
		}
		else{
			$parte = new Parte;
		}
		$parte->fecha = $request->fecha;
		$parte->nivel = $request->nivel;
		$parte->descripcion     = $request->descripcion;
		$parte->acciones      = $request->acciones;
		$parte->hora      = $request->hora;
		$parte->id_profesor      = $request->id_profesor;
		$parte->id_tipologia      = $request->id_tipologia;
		$parte->id_alumno      = $request->id_alumno;
        $parte->comunicacion      = $request->comunicacion;
		$parte->firmado = $request->firma;

		if($parte->save()){
			return redirect()->route('partes');
		}
	}
}
