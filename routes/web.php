<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TriajeController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\UserController;


Route::get('/login', [UserController::class,'login'])->name('login');
Route::get('/recuperar', function () { return view('layouts.recuperar'); })->name('recuperar');
Route::post('/validar',[UserController::class,'validar'])->name('validar_usuarios');
Route::post('/recuperar',[UserController::class,'recuperar_password'])->name('recuperar_password');

Route::group(['middleware'=> ['auth']], function () {
	
	Route::get('/', function () { return view('inicio'); });
	
	Route::controller(UserController::class)->group(function (){
		Route::get('/usuarios','listar')->name('usuarios');
		Route::get('/logout','logout')->name('logout');
		Route::get('/usuario/new', 'ver')->name('usuario_nuevo');
		Route::get('/ususario/ver/{id}', 'ver')->name('usuario_ver');
		Route::post('/ususario/grabar','grabar')->name('usuario_grabar');
		Route::get('/usuario/eliminar/{id}', 'delete')->name('usuario_delete');
	});

	Route::controller(ProfesorController::class)->group(function (){
		Route::get('/profesores','index')->name('profesores');
		Route::get('/profesores/new', 'ver')->name('profes_nuevo');
		Route::get('/profesores/ver/{id}', 'ver')->name('profes_ver');
		Route::post('/profesores/grabar','grabar');
		Route::get('/profesores/lista/{text}','listar');
		Route::get('/profesor/eliminar/{id}', 'delete')->name('profes_delete');
	});
	Route::controller(AlumnoController::class)->group(function (){
		Route::get('/alumnos/','index')->name('alumnos');
		Route::get('/alumnos/ordenar/{orden?}/{direccion?}','index')->name('alumnos_lista');
		Route::get('/alumnos/new', 'ver')->name('alumnos_nuevo');
		Route::get('/alumnos/ver/{id}', 'ver')->name('alumnos_ver');
		Route::post('/alumnos/grabar','grabar');
		Route::get('alumnos/importar','form_importar');
		Route::post('alumnos/importar','importar')->name('import');
	});
	Route::controller(TriajeController::class)->group(function (){
		Route::get('/triaje','index')->name('triajes');
		Route::get('/triaje/new', 'ver')->name('triaje_nuevo');
		Route::get('/triaje/ver/{id}', 'ver')->name('triaje_ver');
		Route::post('/triaje/grabar','grabar');
	});
	Route::controller(CasoController::class)->group(function (){
		Route::get('/casos/','index')->name('casos');
		Route::get('/caso/new', 'ver')->name('caso_nuevo');
		Route::get('/caso/ver/{id}', 'ver')->name('caso_ver');
		Route::post('/caso/grabar','grabar');
	});
	Route::controller(ConfigController::class)->group(function (){
		Route::get('/maestros','index')->name('config');
		Route::post('/maestros','grabar');
	});


});

