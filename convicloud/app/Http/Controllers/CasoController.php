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
		$tipologias	= Tipologia::all();
		$origenes 	= Origen::all();
		$triajes 	= Triaje::all();
		$estados 	= Estado::all();
		$filtrar = false;

		if(isset($request->_token)){
			$busqueda = $request->all();
			$filtrar = true;
		}
		else{
			$busqueda = ['id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null]; 
		}
		if(isset($busqueda['clean'])){
			$busqueda = ['id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null];
			
		}
		if($filtrar){
			$casos = new Caso;
			unset($busqueda['clean']);
			foreach($busqueda as $campo=>$valor){
				if($valor AND $campo!='_token'){
					$casos = $casos->where($campo, '=', $valor );
				}
			}
			$casos = $casos->paginate(50);

		}
		else{
			$casos= Caso::paginate(50);
		}

		$datos = ['casos' => $casos,'triajes'=>$triajes,'tipologias'=>$tipologias,'origenes'=>$origenes,'estados'=>$estados,'busqueda'=>$busqueda]; 
		return view ('caso.lista',$datos);
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
