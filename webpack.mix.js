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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// mix.js('resources/assets/sass/front/js/front.js', 'public/js')
//    .sass('resources/assets/sass/front/front.scss', 'public/css');

// mix.js('resources/assets/sass/adm/js/adm.js', 'public/js')
//    .sass('resources/assets/sass/adm/adm.scss', 'public/css');

mix
.copy('resources/assets/js/jquery.js', 'public/js')
.copy('resources/assets/js/bootstrap.min.js', 'public/js')
.copy('resources/assets/js/app.js', 'public/js')
.copy('resources/assets/js/wow.min.js', 'public/js')
.copy('resources/assets/js/custom.js', 'public/js')
.copy('resources/assets/js/grid.js', 'public/js')
.copy('resources/assets/js/jquery.nav.js', 'public/js')
.copy('resources/assets/js/jquery.scrollTo.min.js', 'public/js')
.copy('resources/assets/js/modernizr.custom.js', 'public/js')
.copy('resources/assets/js/stellar.js', 'public/js')
.sass('resources/assets/sass/app.scss', 'public/css');

   
mix.options({
   processCssUrls: false // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
});