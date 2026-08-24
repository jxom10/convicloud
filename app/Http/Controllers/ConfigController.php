<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function index(){
		$configs = new Config;

		$configs = $configs->get();
		
		return view('config.listar',['configs'=>$configs]);
	}
	public function grabar(Request $request){
		print_r($request->all());
	
	}
}
