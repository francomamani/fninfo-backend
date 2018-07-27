<?php

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

/* index */

Route::get('categoria-ubicaciones', 'CategoriaUbicacionController@index');
Route::get('ubicaciones', 'UbicacionController@index');
Route::get('categorias', 'CategoriaController@index');
Route::get('notificaciones', 'NotificacionController@index');
Route::get('sliders', 'SliderController@index');
Route::get('users', 'UserController@index');
Route::get('tramites', 'TramiteController@index');
Route::get('pasos', 'PasoController@index');
Route::get('imagenes', 'ImagenController@index');
Route::get('imagen-notificaciones', 'ImagenNotificacionController@index');
Route::get('emergentes', 'EmergenteController@index');

/* show */

Route::get('categoria-ubicaciones/{id}', 'CategoriaUbicacionController@show');
Route::get('ubicaciones/{id}', 'UbicacionController@show');
Route::get('categorias/{id}', 'CategoriaController@show');
Route::get('notificaciones/{id}', 'NotificacionController@show');
Route::get('sliders/{id}', 'SliderController@show');
Route::get('users/{id}', 'UserController@show');
Route::get('tramites/{id}', 'TramiteController@show');
Route::get('pasos/{id}', 'PasoController@show');
Route::get('imagenes/{id}', 'ImagenController@show');
Route::get('imagen-notificaciones/{id}', 'ImagenNotificacionController@show');
Route::get('emergentes/{id}', 'EmergenteController@show');


Route::resource('categoria-ubicaciones.ubicaciones', 'CategoriaUbicacionUbicacionController', ['only' => ['index']]);
Route::resource('categorias.notificaciones', 'CategoriaNotificacionController', ['only' => ['index']]);
Route::resource('tramites.pasos', 'TramitePasoController', ['only' => ['index']]);
Route::get('menu', 'CategoriaController@menu');
Route::get('get-categoria-ubicacion-icono/{id}', 'CategoriaUbicacionController@getIcono');
Route::get('get-slider-imagen/{id}', 'SliderController@getImagen');
Route::get('categoria-ubicacion-has-many-ubicaciones/{id}', 'CategoriaUbicacionController@hasManyUbicaciones');
Route::get('get-categoria-icono/{id}', 'CategoriaController@getIcono');
Route::get('get-notificacion-imagen/{id}', 'NotificacionController@getImagen');
Route::get('get-paso-documento/{id}', 'PasoController@getDocumento');
Route::get('get-paso-imagen/{id}', 'PasoController@getImagen');
Route::get('get-ubicacion-imagen/{id}', 'UbicacionController@getImagen');
Route::get('get-imagen-imagen/{id}', 'ImagenController@getImagen');
Route::get('get-imagen-notificacion-imagen/{id}', 'ImagenNotificacionController@getImagen');

Route::get('ubicaciones/{id}/get-imagenes', 'UbicacionController@getImagenes');
Route::get('notificaciones/{id}/get-imagen-notificaciones', 'NotificacionController@getImagenNotificaciones');
Route::resource('sliders', 'SliderController', ['except'=>['index', 'show', 'create', 'edit']]);
Route::post('change-password/{id}', 'AuthController@changePassword');
Route::get('reset-password/{id}', 'AuthController@resetPassword');
Route::get('tramites/{id}/ubicacion', 'TramiteController@hasManyTramiteUbicacion');
/*Route::group(['middleware' => 'jwt-refresh-token'], function() { */
    Route::post('register', 'AuthController@register');

    Route::resource('categoria-ubicaciones', 'CategoriaUbicacionController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('ubicaciones', 'UbicacionController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('notificaciones', 'NotificacionController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('users', 'UserController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('tramites', 'TramiteController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('pasos', 'PasoController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('imagenes', 'ImagenController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('imagen-notificaciones', 'ImagenNotificacionController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('categorias', 'CategoriaController', ['except'=>['index', 'show', 'create', 'edit']]);
    Route::resource('emergentes', 'EmergenteController', ['except'=>['index', 'show', 'create', 'edit']]);

/*});*/
