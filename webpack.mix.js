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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

  /// mix css for frontend

    mix.styles([
        'resources/sass/frontend/assets/css/bootstrap.css',
        'resources/sass/frontend/assets/css/style.css',
    ], 'public/css/all.css');

    /// mix js for frontend
    mix.js([
        'resources/sass/frontend/assets/js/jquery.min.js',
        'resources/sass/frontend/assets/js/responsiveslides.min.js',
    ], 'public/js/all.js')
    .vue();

    mix.js('resources/js/app2.js', 'public/js/app2.js')
    .vue()

    mix.copyDirectory('resources/sass/frontend/assets/images','public/images');
