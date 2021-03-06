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

mix.js([
    'resources/assets/js/app.js', 
    'node_modules/vue/dist/vue.min.js',
    'node_modules/chart.js/src/chart.js',
    'node_modules/jquery/src/jquery.js',
    'node_modules/semantic-ui/dist/semantic.min.js',
    'node_modules/semantic-ui/dist/components/dropdown.min.js',
], 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
