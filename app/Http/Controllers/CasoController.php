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
		$busqueda  = array('titulo'=>null,'id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null,'id_alumno'=>null,'desde'=>null,'hasta'=>null); 
		$casos  = new Caso;
		if($_POST){
			$busqueda= $_POST;
			session()->put('filtro_casos',$busqueda);
		}
		elseif(session()->get('filtro_casos')){
			$busqueda= session()->get('filtro_casos');

		}
		else{
			$busqueda  = array('titulo'=>null,'id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null,'id_alumno'=>null,'desde'=>null,'hasta'=>null); 
			session()->put('filtro_casos',$busqueda);
		} 
		if(isset($busqueda['clean'])){
			$busqueda = ['titulo'=>null,'id_triaje'=>null,'id_estado'=>null,'id_origen'=>null,'id_tipologia'=>null,'id_alumno'=>null,'desde'=>null,'hasta'=>null];
			
		}
		if(isset($busqueda['pendientes'])){
			$casos = $casos->whereNotNull('pendiente')->orWhere('pendiente','<>','');
		}
		if(isset($busqueda['buscar'])){	

			$id_alumno =(isset($busqueda['id_alumno']))?$busqueda['id_alumno']:null;
			unset($busqueda['clean']);
			
			if($id_alumno){
				$casos = $casos->select('casos.*')->leftjoin('actor_casos','casos.id','=','actor_casos.id_caso')
								->where('actor_casos.id_alumno','=',$id_alumno);
			}
			
			foreach($busqueda as $campo=>$valor){
				if($campo!='id_alumno' AND $campo!='buscar'  ){
					if($valor AND $campo!='_token'){
						if(in_array($campo,['desde','hasta'])){
							$busqueda['desde'] = (isset($busqueda['desde']) AND !empty($busqueda['desde'] )) ?date($busqueda['desde']):"";
							$busqueda['hasta'] = (isset($busqueda['hasta']) AND !empty($busqueda['hasta'])) ?date($busqueda['hasta']):date("Y-m-d");
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
		session()->put('filtro_casos',$busqueda);
		$total = $casos->count();
		$casos = $casos->paginate(session('config.porpagina'));
		$nombre_alu = ($busqueda['id_alumno'])?Alumno::find($busqueda['id_alumno'])->nombre_completo():null;

		$datos = ['casos' => $casos,'triajes'=>$triajes,'tipologias'=>$tipologias,'origenes'=>$origenes,'estados'=>$estados,'busqueda'=>$busqueda,'nombre_alu'=>$nombre_alu,'total'=>$total]; 
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
