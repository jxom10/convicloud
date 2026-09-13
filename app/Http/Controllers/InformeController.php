<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB	;
use App\Models\Parte;
use App\Models\Expediente;
use App\Models\Caso;
use App\Models\Tipologia;
use App\Models\Origen;

class InformeController extends Controller
{
    public function index(Request $request ){
		$desde = (isset($request->desde))? $request->desde :  date( "Y-m-01",strtotime("-3 Months"));
		$hasta =(isset($request->hasta))? $request->hasta : date("Y-m-d");
		$tipo = (isset($request->tipo))? $request->tipo :null;
		$partes = array();
		$partes_data = Parte::total_mensuales('fecha');
		$expedientes_data = Expediente::total_mensuales('fecha_apertura');
		$casos_data = Caso::total_mensuales('created_at');
		$tipologias=[];
		foreach(Tipologia::all() as $tipologia){ $tipologias[$tipologia->nombre]=0;	}
		$origenes = [];
		foreach(Origen::all() as $origen){ $origenes[$origen->nombre]=0;	}
		$datos['partes']=array('nivel'=>['leve'=>0,'grave'=>0],
								'curso'=>['1ESO'=>0,'2ESO'=>0,'3ESO'=>0,'4ESO'=>0,'1BACH'=>0,'2BACH'=>0],
								'genero'=> ['O'=>0,'A'=>0,'N'=>0],
								'tipologia'=>$tipologias,);
		
		$datos['expedientes']=array(
								'tipo'=>['conciliados'=>0,'expedientes'=>0],
								'curso_conc'=>['1ESO'=>0,'2ESO'=>0,'3ESO'=>0,'4ESO'=>0,'1BACH'=>0,'2BACH'=>0],
								'curso_exp'=>['1ESO'=>0,'2ESO'=>0,'3ESO'=>0,'4ESO'=>0,'1BACH'=>0,'2BACH'=>0]
								);
								
				
		$datos['casos']=array('estudiantes'=>['total'=>0,'O'=>0,'A'=>0,'N'=>0],	
								'curso'=>['1ESO'=>0,'2ESO'=>0,'3ESO'=>0,'4ESO'=>0,'1BACH'=>0,'2BACH'=>0],
								'origen'=>$origenes,
								'tipologia'=>$tipologias,
								'reincidentes'=>[]);
		if($tipo=='Parte'){

			$partes = Parte::whereBetween('fecha',[$desde,$hasta])->get();
			foreach($partes as $parte){
				$datos['partes']['nivel'][$parte->nivel] +=1;
				$datos['partes']['curso'][$parte->alumno->curso] +=1;
				$datos['partes']['genero'][$parte->alumno->genero] +=1;
				$datos['partes']['tipologia'][$parte->tipologia->nombre] +=1;
				
				
			}
		}
		if($tipo=='Expediente'){
			$expedientes = Expediente::whereBetween('fecha_apertura',[$desde,$hasta])->	get();
			
			foreach($expedientes as $expediente){
				if( $expediente->fecha_solucion > '2000-01-01'){
						$datos['expedientes']['tipo']['conciliados'] +=1;
						$datos['expedientes']['curso_conc'][$expediente->alumno->curso] +=1;
				}
				else{
					$datos['expedientes']['tipo']['expedientes'] +=1;
					$datos['expedientes']['curso_exp'][$expediente->alumno->curso] +=1;
				}
			}
		}
		if($tipo=='Caso'){
			$casos = Caso::whereBetween('created_at',[$desde,$hasta])->get();
			
			foreach($casos as $caso){
				$datos['casos']['estudiantes']['total'] += count($caso->lista_implicados);
				$datos['casos']['origen'][$caso->origen->nombre] +=1;
				$datos['casos']['tipologia'][$caso->tipologia->nombre] +=1;
				foreach($caso->lista_implicados as $alumno_caso){
					if($alumno_caso->alumno->genero == 'O'){$datos['casos']['estudiantes']['O'] +=1;}
					if($alumno_caso->alumno->genero == 'A'){ $datos['casos']['estudiantes']['A'] +=1;}
					if($alumno_caso->alumno->genero == 'N'){ $datos['casos']['estudiantes']['N'] +=1;}
					$datos['casos']['curso'][$alumno_caso->alumno->curso] +=1;
					if(count($alumno_caso->alumno->casos)> 5){
						array_push($datos['casos']['reincidentes'],[$alumno_caso->id_alumno."-". $alumno_caso->alumno->nombre_completo()=>count($alumno_caso->alumno->casos)]);					
					}
				}
			}	
		}
		//~ dd($datos['casos']);
		return view('listado.index',compact('tipo','desde','hasta','partes_data','expedientes_data','casos_data','partes','datos','tipologias'));
	}
	
}
