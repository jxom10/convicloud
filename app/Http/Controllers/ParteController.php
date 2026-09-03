<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parte;
use App\Models\Alumno;
use App\Models\Tipologia;

class ParteController extends Controller
{
      public function index(Request $request){
		  	  
		$busqueda=array('id_tipologia'=>null,'id_alumno'=>null,'id_profesor'=>null);
		$buscar = null;
		$tipologias = Tipologia::All();
		$partes = new Parte;
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->id_tipologia) and $request->id_tipologia){
			$busqueda['id_tipologia'] = $request->id_tipologia;
			$partes = $partes->where('id_tipologia',$request->id_tipologia);
		}
		if(isset($request->id_alumno) and $request->id_alumno){
			$busqueda['id_alumno'] = $request->id_alumno;
			$partes = $partes->where('id_alumno',$request->id_alumno);
			
		}
		if(isset($request->id_profesor) and $request->id_profesor){
			$busqueda['id_alumno'] = $request->id_alumno;
			$partes = $partes->where('id_profesor',$request->id_profesor);
			
		}


		$partes =  $partes->paginate(50);
		
		return view ('parte.lista',['partes' => $partes,'busqueda'=>$busqueda,'tipologias'=>$tipologias]);
	}
	
	public function ver($id = null){
		$tipologias = Tipologia::All();
		if($id){
			$parte = Parte::find($id);
			$titulo = "Alterar ";
		}
		else{
			$parte = new Parte;
			$titulo = "Nuevo ";
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
