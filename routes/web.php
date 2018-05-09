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

Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('cliente', 'ClienteController@index');
Route::post('cliente/registrar', 'ClienteController@store');
Route::put('cliente/actulizar', 'ClienteController@update');
Route::put('cliente/desactivar', 'ClienteController@desactivar');
Route::put('cliente/activar', 'ClienteController@activar');
