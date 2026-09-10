<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipologia;

class TipologiaController extends Controller
{
    public function index(Request $request){
       $buscar = null;
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->buscar)){
			$buscar = $request->buscar;
			$tipologias = tipologia::where('nombre','LIKE', '%'.$buscar.'%')
									->paginate(50);
		}
		else{
			$tipologias = tipologia::paginate(50);
		}
		return view('tipologia.lista',['tipologias'=>$tipologias,'buscar'=>$buscar]);
	}
	public function ver($id = null){
        if(!$id){
            $tipologia = new tipologia;
            $titulo = "Nuevo tipologia";
        }
        else{
            $tipologia = Tipologia::find($id);
            $titulo = "Modificar tipologia";
        }
        
		return view('tipologia.ver',['tipologia'=>$tipologia,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		
		$validated = $request->validate([
			'nombre' => ['required'],
		]);
        $tipologia = new  Tipologia;
         $mensaje = 'Algo ha salido mal...';
		if(!empty($request->id)){
            $tipologia = $tipologia->where('id', $request->id)->first();
        
        }
        $tipologia->nombre = $request->nombre;

        if($tipologia->save()){
             $mensaje = 'tipologia Grabado con éxito';
        }
        session()->flash('mensaje',['success',$mensaje]);
        return redirect()->route('tipologias');
            
    }
}
