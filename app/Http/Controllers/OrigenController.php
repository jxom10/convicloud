<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Origen;

class OrigenController extends Controller
{
    public function index(){
        $origenes = Origen::paginate(50);
		return view('origen.lista',['origenes'=>$origenes]);
	}
	public function ver($id = null){
        if(!$id){
            $origen = new Origen;
            $titulo = "Nuevo origen";
        }
        else{
            $origen = origen::find($id);
            $titulo = "Modificar origen";
        }
        
		return view('origen.ver',['origen'=>$origen,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
        $origen = new  Origen;
         $mensaje = 'Algo ha salido mal...';
		if(!empty($request->id)){
            $origen = $origen->where('id', $request->id)->first();
        
        }
        $origen->nombre = $request->nombre;

        if($origen->save()){
             $mensaje = 'origen Grabado con éxito';
        }
        session()->flash('mensaje',['success',$mensaje]);
        return redirect()->route('origens');
            
    }
}
