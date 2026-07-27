<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\triaje;

class TriajeController extends Controller
{
    public function index(){
		$triaje = new triaje();
		print_r($triaje);
	
	}
}
