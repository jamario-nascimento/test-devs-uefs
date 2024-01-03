<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::prefix('/tag')->group(function () {
    Route::get('/', '\Modules\Tag\Controllers\TagController@index')->name('indexTag');
    Route::view('/cadastrar', 'tag/manter')->name('cadastrarTag');
    Route::get('/editar/{id?}','\Modules\Tag\Controllers\TagController@edit')->name('editarTag');
});

Route::prefix('/usuario')->group(function () {
    Route::get('/', '\Modules\Usuario\Controllers\UsuarioController@index')->name('indexUsuario');
    Route::view('/cadastrar', 'Usuario/manter')->name('cadastrarUsuario');
    Route::get('/editar/{id?}','\Modules\Usuario\Controllers\UsuarioController@edit')->name('editarUsuario');
});

Route::prefix('/post')->group(function () {
    Route::get('/', '\Modules\Post\Controllers\PostController@index')->name('indexPost');
    Route::get('/register', '\Modules\Post\Controllers\PostController@register')->name('cadastrarPost');
    Route::get('/editar/{id?}','\Modules\Post\Controllers\PostController@edit')->name('editarPost');
});
