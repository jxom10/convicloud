<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TriajeController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AlumnoController;


Route::get('/', function () { return view('welcome'); });


//Route::group(['middleware'=> ['auth']], function () {
	Route::controller(ProfesorController::class)->group(function (){
		Route::get('/profesores','index')->name('profes_lista');
		Route::get('/profesores/new', 'ver')->name('profes_nuevo');
		Route::get('/profesores/ver/{id}', 'ver')->name('profes_ver');
		Route::post('/profesores/grabar','grabar');
		Route::get('/profesores/lista/{text}','listar');
	});
	Route::controller(AlumnoController::class)->group(function (){
		Route::get('/alumnos/ordenar/{orden?}/{direccion?}','index')->name('alumnos_lista');
		Route::get('/alumnos/new', 'ver')->name('alumnos_nuevo');
		Route::get('/alumnos/ver/{id}', 'ver')->name('alumnos_ver');
		Route::post('/alumnos/grabar','grabar');
		Route::get('alumnos/importar','form_importar');
		Route::post('alumnos/importar','importar')->name('import');
	});
	Route::controller(TriajeController::class)->group(function (){
		Route::get('/triaje','index')->name('triaje_lista');
		Route::get('/triaje/new', 'ver')->name('triaje_nuevo');
		Route::get('/triaje/ver/{id}', 'ver')->name('triaje_ver');
		Route::post('/triaje/grabar','grabar');
	});

