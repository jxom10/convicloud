<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parte;

class ParteController extends Controller
{
      public function index(){
		$partes = new Parte;
		$partes= $partes->paginate(50);
		
		return view ('parte.lista',['partes' => $partes]);
	}
	
	public function ver($id = null){
		if($id){
			$parte = Parte::find($id);
			$titulo = "Alterar Parte";
		}
		else{
			$parte = new Parte;
			$titulo = "Nuevo Parte";
		}
		return view('parte.ver',['parte'=>$parte,'titulo'=>$titulo]);
	}
	public function grabar(Request $request){
		
	}
}
