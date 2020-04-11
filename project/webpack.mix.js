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

/* указываем корневую директорию */
mix.config.publicPath = 'public_html';


/* разделяем js и css для модулей сайта и админки */
mix.js('resources/js/web/app.js', 'public_html/js/web')
    .js('resources/js/admin/app.js', 'public_html/js/admin');

mix.sass('resources/sass/web/app.scss', 'public_html/css/web')
    .sass('resources/sass/admin/app.scss', 'public_html/css/admin');
