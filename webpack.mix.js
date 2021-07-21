const mix = require("laravel-mix");

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

// Front End
mix.styles(
    [
        "resources/css/frontend/bootstrap.min.css",
        "resources/css/frontend/font-awesome.min.css",
        "resources/css/frontend/owl.carousel.min.css",
        "resources/css/frontend/customdataTables.css",
        "resources/css/backend/responsive.bootstrap4.min.css",
        "resources/css/frontend/slicknav.min.css",
        "resources/css/frontend/ekko-lightbox.css",
        "resources/css/frontend/style.css"
    ],
    "public/css/front.css"
);

mix.scripts(
    [
        "resources/js/frontend/jquery-3.2.1.min.js",
        "resources/js/frontend/bootstrap.min.js",
        "resources/js/frontend/owl.carousel.min.js",
        "resources/js/frontend/jquery.slicknav.min.js",
        "resources/js/backend/jquery.dataTables.min.js",
        "resources/js/backend/dataTables.bootstrap4.min.js",
        "resources/js/backend/dataTables.responsive.min.js",
        "resources/js/frontend/ekko-lightbox.min.js",
        "resources/js/backend/jquery.inputmask.min.js",
        "resources/js/backend/inputmask.binding.js",
        "resources/js/frontend/main.js"
    ],
    "public/js/front.js"
);

// Back End
mix.styles(
    [
        "resources/css/nprogress.css",
        "resources/css/mfb.min.css",
        "resources/css/bootstrap.min.css",
        "resources/css/daterangepicker.css",
        "resources/css/dataTables.bootstrap4.min.css",
        "resources/css/searchBuilder.dataTables.min.css",
        "resources/css/buttons.bootstrap4.min.css",
        "resources/css/responsive.bootstrap4.min.css",
        "resources/css/select2.min.css",
        "resources/css/chocolat.css",
        "resources/css/bootstrap-tagsinput.css",
        "resources/css/style.css",
        "resources/css/summernote-bs4.css",
        "resources/css/components.css"
    ],
    "public/assets/style.css"
).version();

mix.scripts(
    [
        "resources/js/nprogress.js",
        "resources/js/mfb.min.js",
        "resources/js/daterangepicker.js",
        "resources/js/bootstrap.min.js",
        "resources/js/stisla.js",
        "resources/js/jquery.dataTables.min.js",
        "resources/js/dataTables.bootstrap4.min.js",
        "resources/js/dataTables.searchBuilder.min.js",
        "resources/js/dataTables.buttons.min.js",
        "resources/js/buttons.bootstrap4.min.js",
        "resources/js/buttons.flash.min.js",
        "resources/js/buttons.html5.min.js",
        "resources/js/buttons.print.min.js",
        "resources/js/buttons.colVis.min.js",
        "resources/js/dataTables.responsive.min.js",
        "resources/js/responsive.bootstrap4.min.js",
        "resources/js/Chart.min.js",
        "resources/js/bootstrap-tagsinput.js",
        "resources/js/select2.full.min.js",
        "resources/js/cleave.min.js",
        "resources/js/cleave-phone.id.js",
        "resources/js/jquery.chocolat.js",
        "resources/js/scripts.js",
        "resources/js/summernote-bs4.js"
    ],
    "public/assets/scripts.js"
).version();

mix.disableNotifications();
