let mix = require('laravel-mix');
mix.setPublicPath('../');
mix.setResourceRoot('../');


mix
//JS DÙNG CHUNG CHO FRONEND VÀ BACKEND
    .styles([
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'bower_components/fancybox/dist/jquery.fancybox.min.js',
    ], '../js/core.common.js')

    //CSS DÙNG CHUNG CHO FRONTEND VÀ BACKEND
    .styles([
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'bower_components/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css',
        'bower_components/Ionicons/css/ionicons.min.css',
        'bower_components/fancybox/dist/jquery.fancybox.min.css',
    ], '../css/core.common.css')

    //JS CORE FRONTEND
    .styles([
        'bower_components/nivo-slider/jquery.nivo.slider.pack.js',
    ], '../js/core.frontend.js')

    //CSS CORE FRONTEND
    .styles([
        'bower_components/nivo-slider/nivo-slider.css',
    ], '../css/core.frontend.css')

    .sass('resources/assets/sass/frontend.scss', '../css/frontend.css').options({processCssUrls: false})
    .styles('resources/assets/js/scripts.js', '../js/scripts.js')

    // .copy([
    //     'bower_components/font-awesome/web-fonts-with-css/webfonts/**'
    // ], '../webfonts')
    // .copy([
    //     'bower_components/nivo-slider/themes',
    // ], '../css/themes', false)




