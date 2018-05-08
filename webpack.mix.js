let mix = require('laravel-mix');

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

mix.styles([
    'resources/assets/plantillas/css/font-awesome.min.css',
    'resources/assets/plantillas/css/simple-line-icons.min.css',
    'resources/assets/plantillas/css/style.css'
], 'public/css/all.css')
.scripts([
    'resources/assets/plantillas/js/jquery.min.js',
    'resources/assets/plantillas/js/popper.min.js',
    'resources/assets/plantillas/js/bootstrap.min.js',
    'resources/assets/plantillas/js/pace.min.js',
    'resources/assets/plantillas/js/Chart.min.js',
    'resources/assets/plantillas/js/template.js',
], 'public/js/all.js');