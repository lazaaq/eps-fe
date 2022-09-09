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

mix.js('resources/js/tryout.js', 'public/js')
    .js('resources/js/paket.js', 'public/js')
    .js('resources/js/starter.js', 'public/js')
    .js('resources/js/cart.js', 'public/js')
    .js('resources/js/paket-saya.js', 'public/js')
    .js('resources/js/transaksi.js', 'public/js')
    .js('resources/js/prepare-tryout.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css')
    .js(["resources/js/landing-page/jquery-ui.js",
        "resources/js/landing-page/popper.min.js",
        "resources/js/landing-page/bootstrap.min.js",
        "resources/js/landing-page/owl.carousel.min.js",
        "resources/js/landing-page/jquery.stellar.min.js",
        "resources/js/landing-page/bootstrap-datepicker.min.js",
        "resources/js/landing-page/jquery.easing.1.3.js",
        "resources/js/landing-page/jquery.fancybox.min.js",
        "resources/js/landing-page/main.js"], 'public/js/landing-page.js')
    .styles(["resources/css/landing-page/bootstrap.min.css",
        "resources/css/landing-page/jquery-ui.css",
        "resources/css/landing-page/owl.carousel.min.css",
        "resources/css/landing-page/owl.theme.default.min.css",
        "resources/css/landing-page/jquery.fancybox.min.css",
        "resources/css/landing-page/bootstrap-datepicker.css",
        "resources/css/landing-page/style.css"], "public/css/landing-page.css")
    .sourceMaps();
