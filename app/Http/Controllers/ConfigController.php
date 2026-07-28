<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\config;

class ConfigController extends Controller
{
    public function index(){
		$configs = new config;

		$configs = $configs->get();
		
		return view('config.listar',['configs'=>$configs]);
	}
	public function grabar(Request $request){
		print_r($request->all());
	
	}
}
