<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caso;
use App\Models\Estado;
use App\Models\Triaje;
use App\Models\Tipologia;
use App\Models\Origen;
use App\Models\Actor_casos;
use App\Models\Alumno;

class CasoController extends Controller
{
    public function index(Request $request){
		$tipologias	= Tipologia::all();
		$origenes 	= Origen::all();
		$triajes 	= Triaje::all();
		$estados 	= Estado::all();
		$filtrar = false;
		$casos  = new Caso;
		
		//dd($request->all());
		if(isset($request->filtrar)){
			$busqueda = $request->all();
			unset($busqueda['filtrar']);
			$filtrar = true;
		}
		else{
			$busqueda = ['titulo'=>null,'id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null,'id_alumno'=>null,'desde'=>null,'hasta'=>null]; 
		}
		if(isset($busqueda['clean'])){
			$busqueda = ['titulo'=>null,'id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null,'id_alumno'=>null,'desde'=>null,'hasta'=>null];
			
		}
		if(isset($request->pendientes)){
			$casos = $casos->whereNotNull('pendiente')->orWhere('pendiente','<>','');
		}
		if($filtrar){	

			$id_alumno =(isset($busqueda['id_alumno']))?$busqueda['id_alumno']:null;
		
			
			$casos = new Caso;
			unset($busqueda['clean']);
			if($id_alumno){
				$casos = $casos->select('casos.*')->leftjoin('actor_casos','casos.id','=','actor_casos.id_caso')
								->where('actor_casos.id_alumno','=',$id_alumno);
			}
			
			foreach($busqueda as $campo=>$valor){
				if($campo!='id_alumno'){
					if($valor AND $campo!='_token'){
						if(in_array($campo,['desde','hasta'])){
							$busqueda['desde'] = (isset($request->desde) AND !empty($request->desde)) ?date($request->desde):"";
							$busqueda['hasta'] = (isset($request->hasta) AND !empty($request->hasta)) ?date($request->hasta):date("Y-m-d");
							$casos =$casos->whereBetween('updated_at',[$busqueda['desde'],$busqueda['hasta'] ]);
						}
						elseif($campo == 'titulo'){
							$casos = $casos->where($campo, 'LIKE', '%'.$valor.'%' );
						}
						else{
							$casos = $casos->where($campo, '=', $valor );
						}
					}
				}
			}
		}

		//echo $casos->toRawSql();
		$casos = $casos->paginate(50);
		$nombre_alu = ($busqueda['id_alumno'])?Alumno::find($busqueda['id_alumno'])->nombre_completo():null;

		$datos = ['casos' => $casos,'triajes'=>$triajes,'tipologias'=>$tipologias,'origenes'=>$origenes,'estados'=>$estados,'busqueda'=>$busqueda,'nombre_alu'=>$nombre_alu]; 
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
			$titulo = "Alta";
		}
		$implicados ="";
		$campo_implicados ="";
		foreach($caso->lista_implicados as $actor){
			$implicados .=  $actor->rol."(NIA:".$actor->alumno->nia.")".$actor->alumno->nombre_completo()."\n";
			$campo_implicados .= $actor->id_alumno.":".$actor->rol.";";
		}
		$caso->implicados = $campo_implicados;
        $datos = ['caso'=>$caso,
                  'titulo'=>$titulo,
                  'estados'=>$estados,
                  'tipologias' => $tipologias,
                  'origenes' => $origenes,
                  'triajes' => $triaje,
                  'implicados' => $implicados
                  
                  ];
		return view('caso.ver',$datos);
	}
	public function grabar(Request $request){
		
		
		$cambio_implicados = false;
        $validated = $request->validate([
			'id_estado' => ['required'],
			'id_triaje' => ['required'],
			'id_origen' => ['required'],
			'id_tipologia' => ['required'],
			'descripcion' =>  ['required'],

		]);

        if($request->id){
            $caso = Caso::find($request->id);

        }
        else{
            $caso = new Caso;
        }
        //$descripcion = str_replace($caso->descripcion,date('d-m-Y H:i'),$request->descripcion);
		$caso->titulo = $request->titulo;
        $caso->id_estado = $request->id_estado;
        $caso->id_triaje = $request->id_triaje;
        $caso->id_origen = $request->id_origen;
        $caso->id_tipologia = $request->id_tipologia;
        $caso->descripcion = $request->descripcion;
        $caso->pendiente = $request->pendiente;
        $caso->implicados = ($request->implicados) ? $request->implicados: "";

        if($caso->save()){
			
			$this->guardar_alumnos($caso->id,$request->implicados);
		}
		else{
				session()->flash('mensaje',['success','Error grabando cambios']);
		}
		return redirect()->route('caso_ver',$caso->id);
        
	}
	public function guardar_alumnos($caso,$datos){
		$lista = explode(';',$datos);
		foreach($lista as $entrada){
			$arr = explode(':',$entrada);
			if(count($arr)==2){
				$actor = Actor_casos::where('id_caso','=',$caso)->where('id_alumno','=',$arr[0])->first();
				if(!$actor){
					$actor = new Actor_casos;
				}
				$actor->id_caso = $caso;
				$actor->id_alumno = $arr[0];
				$actor->rol = $arr[1];
				if(!$actor->save()){
					return false;
				}
			}
		}
	}	
    public function delete($id){
        $caso = Caso::find($id);    
        if($caso){
			$ids =  Actor_casos::where('id_caso','=',$caso->id)->pluck('id')->toArray();
			
			Actor_casos::destroy($ids);

            $caso->delete();
        }
        return redirect()->route('casos');
    }

}
