<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('personals', 'PersonalController');
Route::get('niveles', 'NivelController@ListarNiveles');
Route::get('listar_notas/{cur_cod}/{gra_cod}/{sec_cod}', 'NotaController@ListarNotasporCurso');
Route::get('grados/{niv_cod}', 'GradoController@ListarGrado');
Route::get('secciones/{gra_cod}', 'SeccionController@ListarSeccion');
Route::get('ubi_deps', 'UbigeoController@ListarUbidep');
Route::get('ubi_provs/{id}', 'UbigeoController@ListarUbiprov');
Route::get('ubi_dists/{id}', 'UbigeoController@ListarUbidist');
Route::get('cursobygrado/{id}', 'CursoController@GetCursoByGrado');
Route::get('login/{usu_login}/{usu_contra}', 'LoginController@UsuLogin');
Route::get('verify/{id}', 'LoginController@verifySession');
Route::get('listar_asigs/{id}', 'AsignacionController@ListarAsignacion');
Route::resource('cursos', 'CursoController');
Route::resource('alumnos', 'AlumnoController');
Route::resource('domicilio', 'DomicilioController');
Route::resource('matriculas', 'MatriculaController');
Route::post('act_notas', 'NotaController@InsertarNotas');
Route::post('ins_asigs', 'AsignacionController@InsertarAsignacion');
Route::delete('elim_asigs/{id}', 'AsignacionController@EliminarAsignacion');
Route::resource('login','LoginController'); 