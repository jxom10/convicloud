<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triaje;

class TriajeController extends Controller
{
    public function index(){
		$triaje = new Triaje();
		print_r($triaje);
	
	}
}
