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

mix.js(['node_modules/select2/dist/js/select2.js'], 'public/js/vendors.js')
.styles([
	
		'node_modules/select2/dist/css/select2.css',
	], 'public/css/vendors.css')
   .sass('resources/assets/sass/app.scss', 'public/css');
