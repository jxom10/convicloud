<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor_casos;

class ActorCasosController extends Controller
{
        public function eliminar(Request $request){
			//return $request->all();
		if($request->id_caso){
			$actor = new Actor_casos;
			$actor = $actor->where('id_caso','=',$request->id_caso)
							->where('id_alumno','=',$request->id_alumno)
							->delete();    	

		}
		return json_encode(['status'=>200,'message'=>' registro numero '.$request->id .' eliminado correctamente']);
	}
}
