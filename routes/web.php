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
Route::put('cliente/actualizar', 'ClienteController@update');
Route::put('cliente/desactivar', 'ClienteController@desactivar');
Route::put('cliente/activar', 'ClienteController@activar');

Route::get('referencia', 'ReferenciaController@index');
Route::post('referencia/registrar', 'ReferenciaController@store');
Route::put('referencia/actualizar', 'ReferenciaController@update');
Route::put('referencia/desactivar', 'ReferenciaController@desactivar');
Route::put('referencia/activar', 'ReferenciaController@activar');

Route::get('categoria', 'CategoriaController@index');
Route::get('categoria/selectcategoria', 'CategoriaController@listarCategorias');
Route::post('categoria/registrar', 'CategoriaController@store');
Route::put('categoria/actualizar', 'CategoriaController@update');
Route::put('categoria/desactivar', 'CategoriaController@desactivar');
Route::put('categoria/activar', 'CategoriaController@activar');
