const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .js(['resources/js/required.js'], 'public/js/required.js')
    .js(['resources/js/utils.js'], 'public/js/utils.js')
    .js('resources/js/autor/listarAutor.js', 'public/js/listarAutor.js')
    .js('resources/js/autor/manterAutor.js', 'public/js/manterAutor.js')
    .js('resources/js/assunto/listarAssunto.js', 'public/js/listarAssunto.js')
    .js('resources/js/assunto/manterAssunto.js', 'public/js/manterAssunto.js')
    .js('resources/js/livro/listarLivro.js', 'public/js/listarLivro.js')
    .js('resources/js/livro/manterLivro.js', 'public/js/manterLivro.js')
    .sass('resources/sass/app.scss', 'public/css');
