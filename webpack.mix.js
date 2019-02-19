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
mix.scripts([
        'public/app-asset/vendor/jquery/jquery-3.2.1.min.js',
        'public/app-asset/vendor/animsition/js/animsition.min.js',
        'public/app-asset/vendor/bootstrap/js/popper.js',
        'public/app-asset/vendor/bootstrap/js/bootstrap.min.js',
        'public/app-asset/vendor/select2/select2.min.js',
        'public/app-asset/vendor/slick/slick.min.js',
        'public/app-asset/js/slick-custom.js',
        'public/app-asset/vendor/countdowntime/countdowntime.js',
        'public/app-asset/vendor/sweetalert/sweetalert.min.js',
        'public/app-asset/vendor/noui/nouislider.min.js',
        'public/app-asset/js/main.js',
        'public/app-asset/js/preload.js',
        'public/app-asset/js/contents/*.js'
    ], 'public/js/app.js')
    .styles([
        'public/app-asset/vendor/bootstrap/css/bootstrap.min.css',
        'public/app-asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'public/app-asset/fonts/themify/themify-icons.css',
        'public/app-asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
        'public/app-asset/fonts/elegant-font/html-css/style.css',
        'public/app-asset/vendor/animate/animate.css',
        'public/app-asset/vendor/css-hamburgers/hamburgers.min.css',
        'public/app-asset/vendor/animsition/css/animsition.min.css',
        'public/app-asset/vendor/select2/select2.min.css',
        'public/app-asset/vendor/daterangepicker/daterangepicker.css',
        'public/app-asset/vendor/slick/slick.css',
        'public/app-asset/vendor/lightbox2/css/lightbox.min.css',
        'public/app-asset/vendor/noui/nouislider.min.css',
        'public/app-asset/css/util.css',
        'public/app-asset/css/main.css'
    ], 'public/css/app.css');
