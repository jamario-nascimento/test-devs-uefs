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
    .js('resources/js/tag/listarTag.js', 'public/js/listarTag.js')
    .js('resources/js/tag/manterTag.js', 'public/js/manterTag.js')
    .js('resources/js/usuario/listarUsuario.js', 'public/js/listarUsuario.js')
    .js('resources/js/usuario/manterUsuario.js', 'public/js/manterUsuario.js')
    .js('resources/js/post/listarPost.js', 'public/js/listarPost.js')
    .js('resources/js/post/manterPost.js', 'public/js/manterPost.js')
    .sass('resources/sass/app.scss', 'public/css');
