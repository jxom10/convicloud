<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;


class EstadoController extends Controller
{
    public function index(Request $request){
		$buscar = null;
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->buscar)){
			$buscar = $request->buscar;
			$estados = Estado::where('nombre','LIKE', '%'.$buscar.'%')
									->paginate(50);
		}
		else{
			$estados = Estado::paginate(50);
		}
		return view('estado.lista',['estados'=>$estados,'buscar'=>$buscar]);
	}
	public function ver($id = null){
        if(!$id){
            $estado = new Estado;
            $titulo = "Nuevo estado";
        }
        else{
            $estado = Estado::find($id);
            $titulo = "Modificar estado";
        }
        
		return view('estado.ver',['estado'=>$estado,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
        $estado = new  Estado;
         $mensaje = 'Algo ha salido mal...';
		if(!empty($request->id)){
            $estado = $estado->where('id', $request->id)->first();
        
        }
        $estado->nombre = $request->nombre;
        $estado->color = $request->color;
        if($estado->save()){
             $mensaje = 'Estado Grabado con éxito';
        }
        session()->flash('mensaje',['success',$mensaje]);
        return redirect()->route('estados');
            
    }
}
