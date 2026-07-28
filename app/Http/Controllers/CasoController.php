<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\caso;
class CasoController extends Controller
{
    public function index(){
		$casos = new caso;
		$casos= $casos->paginate(50);
		
		return view ('caso.lista',['casos' => $casos]);
	}
	
	public function ver($id = null){
		if($id){
			$caso = caso::find($id);
			$titulo = "Modificar";
			if(!$profesor){
				$caso = new caso;
				$titulo = "Alta Caso";
				session()->flash('message', 'El datos solicitado no existe. Se crearáun registro nuevo');
			}
			
		}
		else{
			$caso = new caso;
			$titulo = "Alta Caso";
		}
		return view('caso.anadir',['caso'=>$caso,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		
	}
}
