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

mix.js("resources/js/app.js", "public/js")
    .copyDirectory(
        "node_modules/@fortawesome/fontawesome-free/webfonts",
        "public/webfonts"
    )
    .scripts(
        [
            // "resources/jquery-datatable/jquery.dataTables.js",
            // "resources/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js",
            "resources/jquery-datatable/extensions/export/dataTables.buttons.min.js",
            "resources/jquery-datatable/extensions/export/buttons.flash.min.js",
            "resources/jquery-datatable/extensions/export/jszip.min.js",
            "resources/jquery-datatable/extensions/export/pdfmake.min.js",
            "resources/jquery-datatable/extensions/export/vfs_fonts.js",
            "resources/jquery-datatable/extensions/export/buttons.html5.min.js",
            "resources/jquery-datatable/extensions/export/buttons.print.min.js",
            "node_modules/jquery-highlight/jquery.highlight.js",
            "resources/jquery-datatable/extensions/dataTables.searchHighlight.js",
            "resources/jquery-datatable/extensions/datatable.ellipsis.js"
        ],
        "public/js/plugins.js"
    )
    .sass("resources/sass/app.scss", "public/css");
