const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var bowerDir = './resources/assets/bower/'

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
        .sass('./resources/assets/BO/sass/main.scss', 'public/BO/css')
        .styles([
            bowerDir + 'switchery/dist/switchery.css'
        ], 'public/BO/css/vendors.css')
        .scripts([
            bowerDir + 'jquery/dist/jquery.js',
            bowerDir + 'bootstrap-sass/assets/javascripts/bootstrap.js',
            bowerDir + 'switchery/dist/switchery.js',
        ], 'public/BO/js/vendor.js')
        .scripts('./resources/assets/BO/js/scripts.js', 'public/BO/js/scripts.js')
        .copy(bowerDir + 'font-awesome/fonts/**/*', 'public/BO/fonts')
        .copy('./resources/assets/BO/img/**/*', 'public/BO/img')
        .webpack('app.js');
})
;