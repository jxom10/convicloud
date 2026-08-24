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
    public function index(Request $request){
        
		$buscar = null;
		$casos = new Caso;
		if(isset($request->clean)){
			$request->buscar = null;
		}
		if(isset($request->buscar)){
			$buscar = $request->buscar;
			$casos = Caso::paginate(50);
		}
		else{
		
			$casos= $casos->paginate(50);
		}
		return view ('caso.lista',['casos' => $casos,'buscar'=>$buscar]);
	}
	
	public function ver($id = null){
        $estados = Estado::all();
        $triaje  = Triaje::all();
        $tipologias = Tipologia::all();
        $origenes = Origen::all();
		if($id){
			$caso = Caso::find($id);
			$titulo = "Modificar";
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
                  'triajes' => $triaje
                  
                  ];
		return view('caso.ver',$datos);
	}
	public function grabar(Request $request){
        $validated = $request->validate([
			'estado_id' => ['required'],
			'triaje_id' => ['required'],
			'origen_id' => ['required'],
			'tipologia_id' => ['required'],
			'descripcion' =>  ['required'],
            'implicados' =>  ['required'],
		]);

        if($request->id){
            $caso = Caso::find($request->id);
        }
        else{
            $caso = new Caso;
        }
        $caso->id_estado = $request->estado_id;
        $caso->id_triaje = $request->triaje_id;
        $caso->id_origen = $request->origen_id;
        $caso->id_tipologia = $request->tipologia_id;
        $caso->descripcion = $request->descripcion;
        $caso->implicados = $request->implicados;
        
        if($caso->save()){
            return redirect()->route('caso_ver',$caso->id);
        }
	}
    public function delete($id){
        $caso = Caso::find($id);    
        if($caso){
            $caso->delete();
        }
        return redirect()->route('casos');
    }
}
