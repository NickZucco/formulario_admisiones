<?php

/*
  |---------------------------------------------------------------
  | Application routes
  |---------------------------------------------------------------
 */

// Ruta base de la aplicación (root): https://www.ingenieria.bogota.unal.edu.co/formulario_admisiones/
// Si el usuario es guest (invitado), es decir no está loggeado, entonces lo redirige a auth/login, el formulario 
// para hacer el login.
// Si el usuario está loggeado y tiene el rol de admin, entonces lo redirige a admin/candidatos.
// Si el usuario está loggeado y no tiene el rol de admin, entonces lo redirige a datos, el formulario para 
// completar los datos personales.
Route::get('/', function() {
    if (Auth::guest()) {
        return Redirect::to('auth/login');
    } else {
		if (Auth::user()->isAdmin()) {
			return Redirect::to('admin/candidatos');
		}
		else {
			return Redirect::to('datos');
		}
    }
});

// Rutas de acceso público para hacer login de un usuario registrado
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

// Rutas de acceso público para hacer el registro de un nuevo usuario
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
// Rutas de solicitud de reset de password
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Rutas de reset de password
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser');
//Formulario de referencias academicas
Route::get('referencia_academica/{token}', 'ReferenciasController@show_referencia_academica');
Route::post('referencia_academica', 'ReferenciasController@save_referencia_academica');

//Formulario de referencias academicas
Route::get('referencia_profesional/{token}', 'ReferenciasController@show_referencia_profesional');
Route::post('referencia_profesional', 'ReferenciasController@save_referencia_profesional');

Route::get('formulario_completado', 'ReferenciasController@que_gracias');
Route::get('formulario_no_disponible', 'ReferenciasController@no_disponible');

// Grupo de rutas para aspirante
Route::group(['middleware' => 'auth'], function(){
	//Formulario de datos personales
	Route::get('datos', 'AspiranteController@show_info');
	Route::post('datos', 'AspiranteController@insert');
	//Formulario de seleccion de programa de posgrado
	Route::get('programas', 'AspiranteController@showPrograms');
	Route::post('programas', 'AspiranteController@saveProgram');
	//Formulario de documentos específicos según programa de posgrado
	Route::get('especificos', 'AspiranteController@showDocuments');
	Route::post('especificos', 'AspiranteController@insertDocument');
	//Formulario de información de estudios académicos
	Route::get('estudios', 'EstudioController@show_info');
	Route::post('estudios', 'EstudioController@insert');
	Route::post('estudios/delete', 'EstudioController@delete');
	//Formulario de distinciones académicas
	Route::get('distinciones', 'DistincionController@show_info');
	Route::post('distinciones', 'DistincionController@insert');
	Route::post('distinciones/delete', 'DistincionController@delete');
	//Formulario de experiencia laboral
	Route::get('experiencia_laboral', 'ExperienciaLaboralController@show_info');
	Route::post('experiencia_laboral', 'ExperienciaLaboralController@insert');
	Route::post('experiencia_laboral/delete', 'ExperienciaLaboralController@delete');
	//Formulario de experiencia docente
	Route::get('experiencia_docente', 'ExperienciaDocenteController@show_info');
	Route::post('experiencia_docente', 'ExperienciaDocenteController@insert');
	Route::post('experiencia_docente/delete', 'ExperienciaDocenteController@delete');
	//Formulario de experiencia investigativa
	Route::get('experiencia_investigativa', 'ExperienciaInvestigativaController@show_info');
	Route::post('experiencia_investigativa', 'ExperienciaInvestigativaController@insert');
	Route::post('experiencia_investigativa/delete', 'ExperienciaInvestigativaController@delete');
	//Formulario de producción inteletual
	Route::get('produccion_intelectual', 'ProduccionIntelectualController@show_info');
	Route::post('produccion_intelectual', 'ProduccionIntelectualController@insert');
	Route::post('produccion_intelectual/delete', 'ProduccionIntelectualController@delete');
	//Formulario de certificación de idiomas
	Route::get('idiomas', 'IdiomaCertificadoController@show_info');
	Route::post('idiomas', 'IdiomaCertificadoController@insert');
	Route::post('idiomas/delete', 'IdiomaCertificadoController@delete');
	//Vista de resumen donde el aspirante puede descargar su hoja de vida y sus adjuntos
	Route::get('resumen', 'AspiranteController@summary');
	Route::post('resumen/hv', 'Admin\AdminController@getReport');
	Route::post('resumen/adjuntos', 'Admin\AdminController@getAttachments');
	//Formulario de referencias para aspirante
    Route::get('formulario_referencias', 'ReferenciasController@show_candidate_form');
    Route::post('formulario_referencias', 'ReferenciasController@save_references');
    //Formulario de referencias personales
    Route::get('referencias_personales', 'ReferenciasPersonalesController@show_info');
});

// Grupo de rutas para administrador
Route::group(['middleware' => 'admin'], function(){
	Route::get('admin/candidatos', 'Admin\AdminController@showCandidates');
	Route::get('admin/candidatos/adjuntos', 'Admin\AdminController@getAttachments');
	Route::get('admin/candidatos/reporte', 'Admin\AdminController@getReport');
	Route::get('admin/candidatos/excel', 'Admin\AdminController@excel');
});