<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parte;
use App\Models\Alumno;
use App\Models\Tipologia;

class ParteController extends Controller
{
      public function index(Request $request){
		  	  
		$filtrar = false;
		$tipologias = Tipologia::All();
		$partes = new Parte;
		
		if(isset($request->_token)){
			$busqueda = $request->all();
			$filtrar = true;
		}		
		else{	
			$busqueda = ['id_tipologia'=>null,'id_alumno'=>null,'id_profesor'=>null,'desde'=>null,'hasta'=>null];
		}	
		if(isset($request->clean)){
			$busqueda = ['id_tipologia'=>null,'id_alumno'=>null,'id_profesor'=>null,'desde'=>null,'hasta'=>null];
		}
		if($filtrar){	
			$id_alumno =(isset($busqueda['id_alumno']))?$busqueda['id_alumno']:null;
			
			
			unset($busqueda['clean']);
			foreach($busqueda as $campo=>$valor){
				if($valor AND $campo!='_token'){
					if(in_array($campo,['desde','hasta'])){
						$busqueda['desde'] = (isset($request->desde) AND !empty($request->desde)) ?date($request->desde):"";
						$busqueda['hasta'] = (isset($request->hasta) AND !empty($request->hasta)) ?date($request->hasta):date("Y-m-d");
						$partes =$partes->whereBetween('updated_at',[$busqueda['desde'],$busqueda['hasta'] ]);
					}
					else{
						$partes = $partes->where($campo, '=', $valor );
					}
				}
			}
		}

		$partes =  $partes->paginate(50);
		
		return view ('parte.lista',['partes' => $partes,'busqueda'=>$busqueda,'tipologias'=>$tipologias]);
	}
	
	public function ver($id = null){
		$tipologias = Tipologia::All();
		if($id){
			$parte = Parte::find($id);
			$titulo = "Modificar Parte ";
		}
		else{
			$parte = new Parte;
			$titulo = "Nuevo Parte";
		}
		return view('parte.ver',['parte'=>$parte,'titulo'=>$titulo,'tipologias'=>$tipologias]);
	}
	public function grabar(Request $request){
		//dd($request->all());
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
		$parte->firmado = (isset($request->firmado))?$request->firmado:null;

		if($parte->save()){
			return redirect()->route('partes');
		}
	}
}
