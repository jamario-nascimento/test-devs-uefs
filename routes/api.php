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

Route::prefix('/autor')->group(function () {
    Route::get('/list', '\Modules\Autor\Controllers\AutorController@list')->name('listAutor');
    Route::post('/create', '\Modules\Autor\Controllers\AutorController@create')->name('createAutor');
    Route::put('/update', '\Modules\Autor\Controllers\AutorController@update')->name('updateAutor');
    Route::delete('/delete', '\Modules\Autor\Controllers\AutorController@delete')->name('deleteAutor');
});

Route::prefix('/assunto')->group(function () {
    Route::get('/list', '\Modules\Assunto\Controllers\AssuntoController@list')->name('listAssunto');
    Route::post('/create', '\Modules\Assunto\Controllers\AssuntoController@create')->name('createAssunto');
    Route::put('/update', '\Modules\Assunto\Controllers\AssuntoController@update')->name('updateAssunto');
    Route::delete('/delete', '\Modules\Assunto\Controllers\AssuntoController@delete')->name('deleteAssunto');
});

Route::prefix('/livro')->group(function () {
    Route::get('/list', '\Modules\Livro\Controllers\LivroController@list')->name('listLivro');
    Route::post('/create', '\Modules\Livro\Controllers\LivroController@create')->name('createLivro');
    Route::put('/update', '\Modules\Livro\Controllers\LivroController@update')->name('updateLivro');
    Route::delete('/delete', '\Modules\Livro\Controllers\LivroController@delete')->name('deleteLivro');
});
