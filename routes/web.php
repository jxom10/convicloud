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
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ActorCasosController;
use App\Http\Controllers\ToolsController;

Route::get('/forms',  function () { return view('forms'); });
Route::get('/login', [UserController::class,'login'])->name('login');
Route::get('/recuperar', function () { return view('layouts.recuperar'); })->name('recuperar');
Route::post('/validar',[UserController::class,'validar'])->name('validar_usuarios');
Route::post('/recuperar',[UserController::class,'recuperar_password'])->name('recuperar_password');

Route::group(['middleware'=> ['auth']], function () {
	
	Route::get('/', function () { return view('inicio'); });
	
	Route::controller(UserController::class)->group(function (){
		Route::get('/usuarios','index')->name('usuarios');
		Route::post('/usuarios','index')->name('usuarios_buscar');
		Route::get('/logout','logout')->name('logout');
		Route::get('/usuario/new', 'ver')->name('usuario_nuevo');
		Route::get('/ususario/ver/{id}', 'ver')->name('usuario_ver');
		Route::post('/ususario/grabar','grabar')->name('usuario_grabar');
		Route::delete('/usuario/', 'delete')->name('usuario_eliminar');
	});
	Route::controller(ActorCasosController::class)->group(function (){
		Route::delete('/actorcaso/delete','eliminar');
	});
	Route::controller(ProfesorController::class)->group(function (){
		Route::get('/profesores/importar','form_importar');
		Route::post('/profesores/importar','importar')->name('profesores_import');
		Route::get('/profesores/{buscar?}','index')->name('profesores');
		Route::post('/profesores/','index')->name('profesores_buscar');
		Route::get('/profesor/new', 'ver')->name('profesor_nuevo');
		Route::get('/profesor/ver/{id}', 'ver')->name('profesor_ver');
		Route::post('/profesor/grabar','grabar')->name('profesor_grabar');
		Route::get('/profesores/lista/{text}','listar');
		Route::get('/profesor/eliminar/{id}', 'delete')->name('profesor_eliminar');
		Route::get('/profesor/get/{id}', 'get');
		
		Route::get('/profesores/ordenar/{orden?}/{direccion?}','index')->name('profesores_lista');
		
	});
	Route::controller(AlumnoController::class)->group(function (){
		Route::get('/alumnos/','index')->name('alumnos');
		Route::post('/alumnos/','index')->name('alumnos_buscar');
		Route::get('/alumnos/ordenar/{orden?}/{direccion?}','index')->name('alumnos_lista');
		Route::get('/alumnos/new', 'ver')->name('alumno_nuevo');
		Route::get('/alumno/ver/{id}', 'ver')->name('alumno_ver');
		Route::post('/alumnos/grabar','grabar')->name('alumno_grabar');
		Route::get('/alumnos/importar','form_importar');
		Route::get('/alumnos/lista/{text}','listar');
		Route::get('/alumno/get/{id}', 'get');
        Route::get('/alumno/eliminar/{id}', 'delete')->name('alumno_eliminar');
		Route::post('/alumnos/importar','importar')->name('alumnos_import');
	});
	Route::controller(TriajeController::class)->group(function (){
		Route::get('/triaje','index')->name('triajes');
		Route::post('/triaje','index')->name('triajes_buscar');
		Route::get('/triaje/new', 'ver')->name('triaje_nuevo');
		Route::get('/triaje/ver/{id}', 'ver')->name('triaje_ver');
		Route::post('/triaje/grabar','grabar')->name('triaje_grabar');
        Route::get('/triaje/eliminar/{id}', 'delete')->name('triaje_eliminar');
	});
	Route::controller(CasoController::class)->group(function (){
		Route::get('/casos/','index')->name('casos');
		Route::post('/casos/','index')->name('casos_buscar');
		Route::get('/caso/new', 'ver')->name('caso_nuevo');
		Route::get('/caso/ver/{id}', 'ver')->name('caso_ver');
		Route::post('/caso/grabar','grabar')->name('caso_grabar');
        Route::get('/caso/eliminar/{id}', 'delete')->name('caso_eliminar');
	});
	Route::controller(ExpedienteController::class)->group(function (){
		Route::get('/expedientes/','index')->name('expedientes');
		Route::post('/expedientes/','index')->name('expedientes_buscar');
		Route::get('/expediente/new', 'ver')->name('expediente_nuevo');
		Route::get('/expediente/ver/{id}', 'ver')->name('expediente_ver');
		Route::post('/expediente/grabar','grabar')->name('expediente_grabar');
		Route::get('/expediente/eliminar/{id}', 'delete')->name('expediente_eliminar');
	});
	Route::controller(TipologiaController::class)->group(function (){
		Route::get('/tipologias/','index')->name('tipologias');
		Route::post('/tipologias/','index')->name('tipologias_buscar');
		Route::get('/tipologia/new', 'ver')->name('tipologia_nuevo');
		Route::get('/tipologia/ver/{id}', 'ver')->name('tipologia_ver');
		Route::post('/tipologia/grabar','grabar')->name('tipologia_grabar');;
		Route::get('/tipologia/eliminar/{id}', 'delete')->name('tipologia_eliminar');
	});
	Route::controller(OrigenController::class)->group(function (){
		Route::get('/origenes/','index')->name('origenes');
		Route::post('/origenes/','index')->name('origenes_buscar');
		Route::get('/origen/new', 'ver')->name('origen_nuevo');
		Route::get('/origen/ver/{id}', 'ver')->name('origen_ver');
		Route::post('/origen/grabar','grabar')->name('origen_grabar');
		Route::get('/origen/eliminar/{id}', 'delete')->name('origen_eliminar');
	});
	Route::controller(EstadoController::class)->group(function (){
		Route::get('/estados/','index')->name('estados');
		Route::post('/estados/','index')->name('estados_buscar');
		Route::get('/estado/new', 'ver')->name('estado_nuevo');
		Route::get('/estado/ver/{id}', 'ver')->name('estado_ver');
		Route::post('/estado/grabar','grabar')->name('estado_grabar');
		Route::get('/estado/eliminar/{id}', 'delete')->name('estado_eliminar');
	});
	Route::controller(ParteController::class)->group(function (){
		Route::get('/partes/','index')->name('partes');
		Route::post('/partes/','index')->name('partes_buscar');
		Route::get('/parte/new', 'ver')->name('parte_nuevo');
		Route::get('/parte/ver/{id}', 'ver')->name('parte_ver');
		Route::post('/parte/grabar','grabar')->name('parte_grabar');
		Route::get('/parte/eliminar/{id}', 'delete')->name('parte_eliminar');
	});
	Route::controller(InformeController::class)->group(function (){
			Route::get('/listados/','index')->name('listados');
			Route::post('/listados/','index')->name('listados');
			Route::get('/export/','export')->name('export_database');
			Route::get('/import','importar');
			Route::post('/import','importar')->name('import_database');
	});
	Route::controller(ToolsController::class)->group(function (){
		Route::get('/herramientas/','actualizar')->name('herramientas');
	});
});

