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

mix.config.postCss = [
    require('postcss-easy-import')(),
    require('postcss-cssnext')({
        features: {
            // Mix takes care of this for us.
            autoprefixer: false,
        },
    }),
];

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css');
