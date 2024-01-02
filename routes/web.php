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

Route::prefix('/autor')->group(function () {
    Route::get('/', '\Modules\Autor\Controllers\AutorController@index')->name('indexAutor');
    Route::view('/cadastrar', 'autor/manter')->name('cadastrarAutor');
    Route::get('/editar/{CodAu?}','\Modules\Autor\Controllers\AutorController@edit')->name('editarAutor');
});

Route::prefix('/assunto')->group(function () {
    Route::get('/', '\Modules\Assunto\Controllers\AssuntoController@index')->name('indexAssunto');
    Route::view('/cadastrar', 'assunto/manter')->name('cadastrarAssunto');
    Route::get('/editar/{CodAs?}','\Modules\Assunto\Controllers\AssuntoController@edit')->name('editarAssunto');
});

Route::prefix('/livro')->group(function () {
    Route::get('/', '\Modules\Livro\Controllers\LivroController@index')->name('indexLivro');
    Route::get('/register', '\Modules\Livro\Controllers\LivroController@register')->name('cadastrarLivro');
    Route::get('/editar/{Codl?}','\Modules\Livro\Controllers\LivroController@edit')->name('editarLivro');
});

Route::prefix('/relatorio')->group(function () {
    Route::get('/', '\Modules\relatorio\Controllers\RelatorioController@index')->name('indexRelatorio');
    Route::get('/exportar', '\Modules\relatorio\Controllers\RelatorioController@exportar')->name('exportarRelatorio');
});
