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

mix.js('resources/assets/js/app.js', 'public/js')
    .js([
        'public/js/vendor/modernizr.js',
        'public/js/vendor/pace.min.js'
    ], 'public/js/top.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'public/css/vendor/base.css',
        'public/css/vendor/main.css',
        'public/css/vendor/vendor.css'
    ], 'public/css/all.css');
