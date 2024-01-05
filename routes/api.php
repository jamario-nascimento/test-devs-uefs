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

Route::prefix('/tag')->group(function () {
    Route::get('/list', '\Modules\Tag\Controllers\TagController@list')->name('listTag');
    Route::post('/create', '\Modules\Tag\Controllers\TagController@create')->name('createTag');
    Route::put('/update', '\Modules\Tag\Controllers\TagController@update')->name('updateTag');
    Route::delete('/delete', '\Modules\Tag\Controllers\TagController@delete')->name('deleteTag');
});

Route::prefix('/usuario')->group(function () {
    Route::get('/list', '\Modules\Usuario\Controllers\UsuarioController@list')->name('listUsuario');
    Route::post('/create', '\Modules\Usuario\Controllers\UsuarioController@create')->name('createUsuario');
    Route::put('/update', '\Modules\Usuario\Controllers\UsuarioController@update')->name('updateUsuario');
    Route::delete('/delete', '\Modules\Usuario\Controllers\UsuarioController@delete')->name('deleteUsuario');
});

Route::prefix('/post')->group(function () {
    Route::get('/list', '\Modules\Post\Controllers\PostController@list')->name('listPost');
    Route::post('/create', '\Modules\Post\Controllers\PostController@create')->name('createPost');
    Route::put('/update', '\Modules\Post\Controllers\PostController@update')->name('updatePost');
    Route::delete('/delete', '\Modules\Post\Controllers\PostController@delete')->name('deletePost');
});
