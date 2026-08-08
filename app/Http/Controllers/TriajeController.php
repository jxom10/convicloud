<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triaje;

class TriajeController extends Controller
{
    public function index(){
        $triajes = Triaje::paginate(50);
		return view('triaje.lista',['triajes'=>$triajes]);
	}
	public function ver($id = null){
        if(!$id){
            $triaje = new triaje;
            $titulo = "Nuevo triaje";
        }
        else{
            $triaje = Triaje::find($id);
            $titulo = "Modificar triaje";
        }
        
		return view('triaje.ver',['triaje'=>$triaje,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
        $triaje = new  Triaje;
         $mensaje = 'Algo ha salido mal...';
		if(!empty($request->id)){
            $triaje = $triaje->where('id', $request->id)->first();
        
        }
        $triaje->nombre = $request->nombre;

        if($triaje->save()){
             $mensaje = 'triaje Grabado con éxito';
        }
        session()->flash('mensaje',['success',$mensaje]);
        return redirect()->route('triajes');
            
    }
}
