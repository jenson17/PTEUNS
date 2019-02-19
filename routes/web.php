<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('/user','UserController');

	Route::get('/pdfuser', 'UserController@pdfuser');
	
	Route::get('/cambiarPassword', 'UserController@cambiarPassword');

	Route::resource('/mensajes','MensajesController');

	Route::resource('/respuestasmensaje','RespuestasMensajeController');

	Route::resource('/publicacion','PublicacionesController');

	Route::resource('/comentarios','ComentariosController');

	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){

		Route::get('/','AdminController@dashboard');

		Route::resource('/contenidos','ContendsController');
		Route::get('/contenidos/{id}/destroy',[
			'uses' => 'ContendsController@destroy',
			'as'   => 'contenidos.destroy'
		]);

		Route::resource('/clases','ClassController');
		Route::get('/clases/{id}/destroy',[
			'uses' => 'ClassController@destroy',
			'as'   => 'clases.destroy'
		]);

		Route::resource('/clases/{clas_id}/fotos','ImagesController');

		Route::resource('/evaluaciones','EvaluacionesController');

		Route::resource('/practicas','PracticasController');

	});

	Route::group(['prefix' => 'student', 'middleware' => 'student'], function(){

		Route::get('/','StudentController@dashboard');

		Route::resource('/clase','ClassController');

		Route::resource('/practica', 'PracticasUserController');

		Route::resource('/evaluacion', 'EvaluacionesUserController');





	});
	
});








