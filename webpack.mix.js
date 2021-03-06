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
    'resources/assets/plantillas/css/style.css',
    'resources/assets/plantillas/css/default.css',
    'resources/assets/plantillas/css/holiday-us.css',
], 'public/css/all.css')
    .scripts(['resources/assets/plantillas/js/sweetalert2.all.js'
    ],'public/js/all.js')
    .js(['resources/assets/js/app.js'], 'public/js/app.js');