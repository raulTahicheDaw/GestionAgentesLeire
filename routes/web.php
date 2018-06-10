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
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
});
Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    Route::group(['middleware' => ['General']], function () {
        Route::post('/logout','Auth\LoginController@logout')->name('logout');
        Route::get('nuevocliente', function () {
            return view('nuevocliente');
        });
        Route::get('user', 'UserController@index');
        Route::post('user/registrar', 'UserController@store');
        Route::put('user/actualizar', 'UserController@update');
        Route::put('user/desactivar', 'UserController@desactivar');
        Route::put('user/activar', 'UserController@activar');
        Route::get('agenda', 'AgendaController@index');
        Route::get('agenda/recuperaCita', 'AgendaController@recuperaCita');
        Route::post('agenda/registrar', 'AgendaController@store');
        Route::get('agenda/citasdia/{fecha}', 'AgendaController@citasHoy');
        Route::put('agenda/borrar', 'AgendaController@eliminar');
        Route::get('cliente', 'ClienteController@index');
        Route::post('cliente/registrar', 'ClienteController@store');
        Route::put('cliente/actualizar', 'ClienteController@update');
        Route::put('cliente/desactivar', 'ClienteController@desactivar');
        Route::put('cliente/activar', 'ClienteController@activar');
        Route::get('cliente/selectcliente', 'ClienteController@listarClientes');
        Route::get('cliente/listarpdf', 'ClienteController@listarpdf')->name('clientespdf');
        Route::get('cliente/informecliente', 'ClienteController@informeClientes');
        Route::get('cliente/informecliente/{desde}/{hasta}', 'ClienteController@informeClientesMeses');
        Route::get('referencia', 'ReferenciaController@index');
        Route::post('referencia/registrar', 'ReferenciaController@store');
        Route::put('referencia/actualizar', 'ReferenciaController@update');
        Route::put('referencia/desactivar', 'ReferenciaController@desactivar');
        Route::put('referencia/activar', 'ReferenciaController@activar');
        Route::get('referencia/listarpdf', 'ReferenciaController@listarpdf')->name('referenciapdf');
        Route::get('referencia/informereferencia', 'ReferenciaController@informeReferencias');
        Route::get('referencia/informereferencia/{desde}/{hasta}', 'ReferenciaController@informeReferenciasMeses');
        Route::get('categoria', 'CategoriaController@index');
        Route::get('categoria/selectcategoria', 'CategoriaController@listarCategorias');
        Route::post('categoria/registrar', 'CategoriaController@store');
        Route::put('categoria/actualizar', 'CategoriaController@update');
        Route::put('categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('categoria/activar', 'CategoriaController@activar');
        Route::get('ramo', 'RamoController@index');
        Route::get('ramo/selectramo', 'RamoController@listarRamos');
        Route::post('ramo/registrar', 'RamoController@store');
        Route::put('ramo/actualizar', 'RamoController@update');
        Route::put('ramo/desactivar', 'RamoController@desactivar');
        Route::put('ramo/activar', 'RamoController@activar');
        Route::get('producto', 'ProductoController@index');
        Route::get('producto/selectproducto', 'ProductoController@listarProductos');
        Route::post('producto/registrar', 'ProductoController@store');
        Route::put('producto/actualizar', 'ProductoController@update');
        Route::put('producto/desactivar', 'ProductoController@desactivar');
        Route::put('producto/activar', 'ProductoController@activar');
        Route::get('producto/listarpdf', 'ProductoController@listarpdf')->name('productopdf');
        Route::put('clientesproductos/addproducto', 'Clientes_ProductosController@addProducto');
        Route::get('clientesproductos/listarproductos/{id_cliente}', 'Clientes_ProductosController@listarProductosClientes');
        Route::get('vencimiento/{desde}/{hasta}', 'Clientes_ProductosController@listarVencimientos');
        Route::get('clientesproductos/informes', 'Clientes_ProductosController@informes');
        Route::get('clientesproductos/informes/{desde}/{hasta}', 'Clientes_ProductosController@informesFecha');
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectrol', 'RolController@selectRol');
    });
    Route::group(['middleware' => ['Administrador']], function () {
        Route::get('nuevocliente', function () {
            return view('nuevocliente');
        });
        Route::post('/logout','Auth\LoginController@logout')->name('logout');
        Route::get('user', 'UserController@index');
        Route::post('user/registrar', 'UserController@store');
        Route::put('user/actualizar', 'UserController@update');
        Route::put('user/desactivar', 'UserController@desactivar');
        Route::put('user/activar', 'UserController@activar');
        Route::get('agenda', 'AgendaController@index');
        Route::get('agenda/recuperaCita', 'AgendaController@recuperaCita');
        Route::post('agenda/registrar', 'AgendaController@store');
        Route::get('agenda/citasdia/{fecha}', 'AgendaController@citasHoy');
        Route::put('agenda/borrar', 'AgendaController@eliminar');
        Route::get('cliente', 'ClienteController@index');
        Route::post('cliente/registrar', 'ClienteController@store');
        Route::put('cliente/actualizar', 'ClienteController@update');
        Route::put('cliente/desactivar', 'ClienteController@desactivar');
        Route::put('cliente/activar', 'ClienteController@activar');
        Route::get('cliente/selectcliente', 'ClienteController@listarClientes');
        Route::get('cliente/listarpdf', 'ClienteController@listarpdf')->name('clientespdf');
        Route::get('cliente/informecliente', 'ClienteController@informeClientes');
        Route::get('cliente/informecliente/{desde}/{hasta}', 'ClienteController@informeClientesMeses');
        Route::get('referencia', 'ReferenciaController@index');
        Route::post('referencia/registrar', 'ReferenciaController@store');
        Route::put('referencia/actualizar', 'ReferenciaController@update');
        Route::put('referencia/desactivar', 'ReferenciaController@desactivar');
        Route::put('referencia/activar', 'ReferenciaController@activar');
        Route::get('referencia/listarpdf', 'ReferenciaController@listarpdf')->name('referenciapdf');
        Route::get('referencia/informereferencia', 'ReferenciaController@informeReferencias');
        Route::get('referencia/informereferencia/{desde}/{hasta}', 'ReferenciaController@informeReferenciasMeses');
        Route::get('categoria', 'CategoriaController@index');
        Route::get('categoria/selectcategoria', 'CategoriaController@listarCategorias');
        Route::post('categoria/registrar', 'CategoriaController@store');
        Route::put('categoria/actualizar', 'CategoriaController@update');
        Route::put('categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('categoria/activar', 'CategoriaController@activar');
        Route::get('ramo', 'RamoController@index');
        Route::get('ramo/selectramo', 'RamoController@listarRamos');
        Route::post('ramo/registrar', 'RamoController@store');
        Route::put('ramo/actualizar', 'RamoController@update');
        Route::put('ramo/desactivar', 'RamoController@desactivar');
        Route::put('ramo/activar', 'RamoController@activar');
        Route::get('producto', 'ProductoController@index');
        Route::get('producto/selectproducto', 'ProductoController@listarProductos');
        Route::post('producto/registrar', 'ProductoController@store');
        Route::put('producto/actualizar', 'ProductoController@update');
        Route::put('producto/desactivar', 'ProductoController@desactivar');
        Route::put('producto/activar', 'ProductoController@activar');
        Route::get('producto/listarpdf', 'ProductoController@listarpdf')->name('productopdf');
        Route::put('clientesproductos/addproducto', 'Clientes_ProductosController@addProducto');
        Route::get('clientesproductos/listarproductos/{id_cliente}', 'Clientes_ProductosController@listarProductosClientes');
        Route::get('vencimiento/{desde}/{hasta}', 'Clientes_ProductosController@listarVencimientos');
        Route::get('clientesproductos/informes', 'Clientes_ProductosController@informes');
        Route::get('clientesproductos/informes/{desde}/{hasta}', 'Clientes_ProductosController@informesFecha');
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectrol', 'RolController@selectRol');
    });
});
Route::get('/home', 'HomeController@index')->name('home');