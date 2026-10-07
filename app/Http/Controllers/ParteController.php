<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Parte;
use App\Models\Alumno;
use App\Models\Tipologia;

class ParteController extends Controller
{
      public function index(Request $request){

		$filtrar = false;
		$tipologias = Tipologia::All();
		$partes = new Parte;
		$busqueda = ['id_tipologia'=>null,'id_alumno'=>null,'id_profesor'=>null,'desde'=>null,'hasta'=>null,'titulo'=>null];
		if(isset($request->_token)){
			$busqueda = $request->all();
			$filtrar = true;
		}		

		if(isset($request->clean)){
				$busqueda = ['id_tipologia'=>null,'id_alumno'=>null,'id_profesor'=>null,'desde'=>null,'hasta'=>null,'titulo'=>null];
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
					elseif($campo == 'titulo'){
						$partes = $partes->where($campo, 'LIKE', '%'.$valor.'%' );
					}
					else{
						$partes = $partes->where($campo, '=', $valor );
					}
				}
			}
		}
		$total = $partes->count();
		$partes =  $partes->paginate(session('config.porpagina'));
		$this->aviso_partes_alumnos();
		return view ('parte.lista',['partes' => $partes,'busqueda'=>$busqueda,'tipologias'=>$tipologias,'total'=>$total]);
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
		$parte->titulo = $request->titulo;
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
	public function aviso_partes_alumnos(){
		$partes = new Parte;
		$desde = session('config.fecha_inicio');
		$hasta = session('config.fecha_fin');

		$partes = $partes->whereBetween('created_at',[$desde,$hasta])->get();
		$salida = array();
		$retornar = array();
		foreach($partes as $parte){
			if(array_key_exists($parte['id_alumno'],$salida)){ 
				$salida[$parte['id_alumno']] += 1;
			}else{
				$salida[$parte['id_alumno']] = 1;
			}
			if($salida[$parte['id_alumno']] > session('config.aviso_partes') ){
				$retornar[$parte['id_alumno']]	= $salida[$parte['id_alumno']];
			}
		}
		if(count($retornar)>1){
			$text = "";
			foreach($retornar as $id_alumno=>$cantidad){
				$alumno = alumno::find($id_alumno);
				$text  .= "<a href='alumno/ver/$alumno->id'>" . $alumno->nombre_completo() ."</a>:".$cantidad." partes</br>";
			}
			session()->now('message', ['texto'=>$text,'color'=>'warning']);
		} 
	}
}
