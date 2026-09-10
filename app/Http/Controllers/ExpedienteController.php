<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\Tipologia;

class ExpedienteController extends Controller
{
     public function index(Request $request){
		
		$tipologias	= Tipologia::all();
		$buscar = null;
		$busqueda = ['id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null,'id_alumno'=>null]; 
		if(isset($request->clean)){
			$request->buscar = null;
		}
		$expedientes = new Expediente;
		if(isset($request->id_tipologia) and $request->id_tipologia){
			$busqueda['id_tipologia'] = $request->id_tipologia;
			$expedientes = $expedientes->where('id_tipologia',$request->id_tipologia);
		}
		if(isset($request->id_alumno) and $request->id_alumno){
			$busqueda['id_alumno'] = $request->id_alumno;
			$expedientes = $expedientes->where('id_alumno',$request->id_alumno);
		}
	
		$expedientes= $expedientes->paginate(50);
		
		return view ('expediente.lista',['expedientes' => $expedientes,'buscar'=>$buscar,'tipologias'=>$tipologias,'busqueda'=>$busqueda]);
	}
	
	public function ver($id = null){
		$expediente = new Expediente;
		$tipologias = Tipologia::All();
		$titulo = "Nuevo ";
		
		if($id){
			$expediente =$expediente->where('id',$id)->first();
			$titulo = "Modificar ";
		}
		else{
			$expediente->fecha_apertura=date('Y-m-d');
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
		$expediente->id_alumno = $datos['id_alumno'];
		$expediente->id_profesor =$datos['id_profesor'];
		$expediente->fecha_apertura =$datos['fecha_apertura'];
		$expediente->id_tipologia =$datos['id_tipologia'];
		$expediente->descripcion =$datos['descripcion'];
		$expediente->fecha_solucion =$datos['fecha_solucion'] ;
		$expediente->solucion =$datos['solucion'] ;

		if($expediente->save()){
			return redirect('expediente/ver/'.$expediente->id);
			//dd($expediente);
		}
		return redirect()->route('expediente_nuevo')->withInput();
	}
    public function delete($id){
        $expediente = Expediente::find($id);    
        if($expediente){
            $expediente->delete();
        }
        return redirect()->route('expedientes');
    }
}
