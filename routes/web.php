<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TriajeController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\ParteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\TipologiaController;
use App\Http\Controllers\OrigenController;

Route::get('/forms',  function () { return view('forms'); });
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
		Route::post('/profesores/grabar','grabar')->name('profesor_grabar');
		Route::get('/profesores/lista/{text}','listar');
		Route::get('/profesor/eliminar/{id}', 'delete')->name('profes_delete');
		Route::get('/profesor/get/{id}', 'get');
	});
	Route::controller(AlumnoController::class)->group(function (){
		Route::get('/alumnos/','index')->name('alumnos');
		Route::get('/alumnos/ordenar/{orden?}/{direccion?}','index')->name('alumnos_lista');
		Route::get('/alumnos/new', 'ver')->name('alumnos_nuevo');
		Route::get('/alumnos/ver/{id}', 'ver')->name('alumnos_ver');
		Route::post('/alumnos/grabar','grabar')->name('alumno_grabar');
		Route::get('alumnos/importar','form_importar');
		Route::get('/alumnos/lista/{text}','listar');
		Route::get('/alumno/get/{id}', 'get');
		Route::post('alumnos/importar','importar')->name('import');
	});
	Route::controller(TriajeController::class)->group(function (){
		Route::get('/triaje','index')->name('triajes');
		Route::get('/triaje/new', 'ver')->name('triaje_nuevo');
		Route::get('/triaje/ver/{id}', 'ver')->name('triaje_ver');
		Route::post('/triaje/grabar','grabar')->name('triaje_grabar');
	});
	Route::controller(CasoController::class)->group(function (){
		Route::get('/casos/','index')->name('casos');
		Route::get('/caso/new', 'ver')->name('caso_nuevo');
		Route::get('/caso/ver/{id}', 'ver')->name('caso_ver');
		Route::post('/caso/grabar','grabar')->name('caso_grabar');
	});
	Route::controller(ExpedienteController::class)->group(function (){
		Route::get('/expedientes/','index')->name('expedientes');
		Route::get('/expediente/new', 'ver')->name('expediente_nuevo');
		Route::get('/expediente/ver/{id}', 'ver')->name('expediente_ver');
		Route::post('/expediente/grabar','grabar')->name('expediente_grabar');
		Route::get('/expediente/{id}','delete')->name('expediente_eliminar');;
	});
	Route::controller(TipologiaController::class)->group(function (){
		Route::get('/tipologias/','index')->name('tipologias');
		Route::get('/tipologia/new', 'ver')->name('tipologia_nuevo');
		Route::get('/tipologia/ver/{id}', 'ver')->name('tipologia_ver');
		Route::post('/tipologia/grabar','grabar')->name('tipologia_grabar');;
	});
	Route::controller(OrigenController::class)->group(function (){
		Route::get('/origenes/','index')->name('origenes');
		Route::get('/origen/new', 'ver')->name('origen_nuevo');
		Route::get('/origen/ver/{id}', 'ver')->name('origen_ver');
		Route::post('/origen/grabar','grabar')->name('origen_grabar');;
	});
	Route::controller(EstadoController::class)->group(function (){
		Route::get('/estados/','index')->name('estados');
		Route::get('/estado/new', 'ver')->name('estado_nuevo');
		Route::get('/estado/ver/{id}', 'ver')->name('estado_ver');
		Route::post('/estado/grabar','grabar')->name('estado_grabar');;
	});
	Route::controller(ParteController::class)->group(function (){
		Route::get('/partes/','index')->name('partes');
		Route::get('/parte/new', 'ver')->name('parte_nuevo');
		Route::get('/parte/ver/{id}', 'ver')->name('parte_ver');
		Route::post('/parte/grabar','grabar')->name('parte_grabar');
	});

});

