<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triaje;

class TriajeController extends Controller
{
      public function index(){
		$triajes = new Triaje;
		$triajes= $triajes->paginate(50);
		
		return view ('triaje.lista',['triajes' => $triajes]);
	}
	
	public function ver($id = null){

		if($id){
			$triaje = Triaje::find($id);
			$titulo = "Alterar Triaje";
		}
		else{
			$triaje = new Triaje;
			$titulo = "Nuevo Triaje";
		}
		return view('triaje.ver',['triaje'=>$triaje,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){

		$validated = $request->validate([
			'nombre' => ['required']
		]);
		if(!empty($request->id)){
			$triaje = Triaje::find($request->id);
		}
		else{
			$triaje = new Triaje;
		}
		$triaje->nombre = $request->nombre;


		if($triaje->save()){
			return redirect()->route('triajes');
		}
	}
    public function delete($id){
        $triaje = Triaje::find($id);    
        if($triaje){
            $triaje->delete();
        }
        return redirect()->route('triajes');
    }
}
