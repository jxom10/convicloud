<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\Tipologia;

class ExpedienteController extends Controller
{
     public function index(){
		$expedientes = new Expediente;
		$expedientes= $expedientes->paginate(50);
		
		return view ('expediente.lista',['expedientes' => $expedientes]);
	}
	
	public function ver($id = null){
		$expediente = new Expediente;
		$tipologias = Tipologia::All();
		$titulo = "Alta Expediente";
		if($id){
			$expediente =$expediente->where('id',$id)->first();
			$titulo = "Modificar";
		}
		//dd($expediente->profesor->nombre);
		return view('expediente.ver',['expediente'=>$expediente,'tipologias'=>$tipologias,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		$validated = $request->validate([
			'id_alumno' => ['required'],
			'id_profesor' => ['required'],
			'fecha_apertura' => ['required'],
			'id_tipologia' => ['required'],
			'descripcion' =>  ['required'],
		]);
		
		$datos = $request->all();
		unset($datos['_token']);
		
		$expediente = new Expediente;
		if(!empty($request->id)){
			$expediente = $expediente->where('id',$request->id)->first();
		}
		$expediente->id_alumno = $datos['id_alumno'] ;
		$expediente->id_profesor =$datos['id_profesor'] ;
		$expediente->fecha_apertura =$datos['fecha_apertura'] ;
		$expediente->id_tipologia =$datos['id_tipologia'] ;
		$expediente->descripcion =$datos['descripcion'] ;
		$expediente->fecha_solucion =$datos['fecha_solucion'] ;
		$expediente->solucion =$datos['solucion'] ;

		if($expediente->save()){
			dd($expediente);
		}
		
		
		
	}
}
