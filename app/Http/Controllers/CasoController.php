<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caso;
use App\Models\Estado;
use App\Models\Triaje;
use App\Models\Tipologia;
use App\Models\Origen;

class CasoController extends Controller
{
    public function index(){
        
        
		$casos = new Caso;
		$casos= $casos->paginate(50);
		
		return view ('caso.lista',['casos' => $casos]);
	}
	
	public function ver($id = null){
        $estados = Estado::all();
        $triaje  = Triaje::all();
        $tipologias = Tipologia::all();
        $origenes = Origen::all();
		if($id){
			$caso = Caso::find($id);
			$titulo = "Modificar";
			if(!$profesor){
				$caso = new Caso;
				$titulo = "Alta Caso";
				session()->flash('message', 'El datos solicitado no existe. Se crearáun registro nuevo');
			}
			
		}
		else{
			$caso = new Caso;
			$titulo = "Alta Caso";
		}
        $datos = ['caso'=>$caso,
                  'titulo'=>$titulo,
                  'estados'=>$estados,
                  'tipologias' => $tipologias,
                  'origenes' => $origenes,
                  'triaje' => $triaje
                  
                  ];
		return view('caso.ver',$datos);
	}
	public function grabar(Request $request){
		
	}
}
