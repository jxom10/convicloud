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
        $triajes  = Triaje::all();
        $tipologias = Tipologia::all();
        $origenes = Origen::all();
		if($id){
			$caso = Caso::find($id);
			$titulo = "Modificar";
			if(!$caso){
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
                  'triajes' => $triajes,
                  'id_implicados' => unserialize($caso->id_implicados)
                  
                  ];
		return view('caso.ver',$datos);
	}
	public function grabar(Request $request){
		
		$validated = $request->validate([

			'id_estado' => ['required'],
			'id_triaje' => ['required'],
			'id_tipologia' => ['required'],
			'descripcion' =>  ['required'],

		]);
		
		$datos = $request->all();
		unset($datos['_token']);

		$caso = new Caso;
		if(!empty($request->id)){
			$caso = $caso->where('id',$request->id)->first();
		}

		$caso->id_estado =$datos['id_estado'] ;
		$caso->id_triaje =$datos['id_triaje'] ;
		$caso->id_tipologia =$datos['id_tipologia'] ;
		$caso->descripcion =$datos['descripcion'] ;
		$caso->id_implicados =serialize($datos['id_implicados']) ;


		if($caso->save()){
			return redirect()->route('caso_ver',['id'=>$caso->id]);
		}		
	}
	public function delete($id){
		if(Caso::where('id',$id)->delete()){
			return redirect()->route('expedientes');
		}
	}
}
